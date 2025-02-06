FROM quay.io/rockylinux/rockylinux:9
RUN dnf install -y epel-release && \
    crb enable && \
    dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm && \
    dnf module enable -y \
        composer:2 \
        php:remi-8.4 \
      && \
    curl -fsSL -o /etc/yum.repos.d/jp3cki.repo https://rpm.fetus.jp/jp3cki.repo && \
    dnf config-manager --enable jp3cki-h2o-rolling && \
    dnf distro-sync -y && \
    dnf install -y \
        composer \
        git \
        h2o \
        php-cli \
        php-fpm \
        php-gd \
        php-intl \
        php-mbstring \
        sudo \
        supervisor \
      && \
    mkdir /run/php-fpm && \
    useradd -d /app app && \
    useradd --system -d /etc/h2o -s /sbin/nologin h2o && \
    chown app:h2o /app && \
    chmod 750 /app && \
    sudo -u app mkdir -p /app/php/session /app/php/wsdlcache /app/php/opcache && \
    sudo -u app git clone --depth=1 https://github.com/statink/jdenticon.stat.ink.git /app/src && \
    sudo -u app bash -c 'cd /app/src && composer install --no-cache --prefer-dist --no-dev && touch .production' && \
    sudo -u app rm -rf /app/src/.git /app/.cache && \
    sed -i 's/expose_php = On/expose_php = Off/' /etc/php.ini && \
    sed -i 's/nodaemon=false/nodaemon=true/' /etc/supervisord.conf && \
    dnf remove -y \
        epel-release \
        git \
        remi-release \
      && \
    dnf clean all && \
    rm -rf /var/cache/dnf/* /etc/yum.repos.d/jp3cki.repo

COPY ./docker/etc/php-fpm.d/www.conf /etc/php-fpm.d/
COPY ./docker/etc/h2o/h2o.conf /etc/h2o/
COPY ./docker/etc/supervisord.d/*.ini /etc/supervisord.d/

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
EXPOSE 80
