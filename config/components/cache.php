<?php

declare(strict_types=1);

use yii\caching\FileCache;

return (function (): array {
    $revisionFilePath = __DIR__ . '/../../REVISION';

    $cachePath = '@runtime/cache';
    if (file_exists($revisionFilePath) && is_readable($revisionFilePath)) {
        $realpath = @realpath(__DIR__ . '/../..');
        if (is_string($realpath)) {
            $releaseNumber = filter_var(basename($realpath), FILTER_VALIDATE_INT);
            if (is_int($releaseNumber)) {
                $cachePath .= '/release-' . (string)$releaseNumber;
            }
        }
    }

    return [
        'class' => FileCache::class,

        'cachePath' => $cachePath,
        'directoryLevel' => 1,
        'gcProbability' => 0,
    ];
})();
