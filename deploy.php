<?php

declare(strict_types=1);

namespace Deployer;

require 'recipe/yii.php';

set('repository', 'git@github.com:statink/jdenticon.stat.ink.git');
add('shared_files', []);
add('shared_dirs', ['runtime/logs']);
add('writable_dirs', ['runtime', 'web/assets']);

host('img2')
    ->set('hostname', '2401:2500:10a:1004::22')
    ->set('deploy_path', '~/app.dep')
    ->set('http_user', 'jdenticon')
    ->set('keep_releases', 3)
    ->set('remote_user', 'jdenticon');

// disable DB migration
task('deploy:migrate', function () {
});

after('deploy:failed', 'deploy:unlock');
