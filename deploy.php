<?php

declare(strict_types=1);

namespace Deployer;

require 'recipe/yii.php';

set('repository', 'git@github.com:statink/jdenticon.stat.ink.git');
set('shared_files', []);
set('shared_dirs', [
    'runtime/cache',
    'runtime/logs',
]);
set('writable_dirs', []);

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
