<?php

declare(strict_types=1);

namespace app\actions\jdenticon;

use Jdenticon\Color;
use Jdenticon\Identicon;
use Yii;
use app\helpers\TypeHelper;
use yii\base\Action;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use function compact;
use function gmdate;
use function hash_file;
use function implode;
use function in_array;
use function preg_match;
use function strlen;
use function substr;

final class GenerateAction extends Action
{
    private const PUBLIC_CACHE_DURATION = 30 * 86400;
    private const PRIVATE_CACHE_DURATION = 90 * 86400;

    public function run(string $hash, string $ext): Response
    {
        if (
            !preg_match('/\A[0-9a-f]{32,}\z/', $hash) ||
            !in_array($ext, ['png', 'svg'], true)
        ) {
            throw new NotFoundHttpException(
                Yii::t('yii', 'Page not found.'),
            );
        }

        if (strlen($hash) > 32) {
            return TypeHelper::instanceOf($this->controller, Controller::class)
                ->redirect(['jdenticon/generate',
                    'hash' => substr($hash, 0, 32),
                    'ext' => $ext,
                ]);
        }

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->set(
            'Content-Type',
            match ($ext) {
                'png' => 'image/png',
                'svg' => 'image/svg+xml',
            },
        );
        $response->headers->set(
            'Cache-Control',
            implode(', ', [
                'immutable',
                'max-age=' . self::PUBLIC_CACHE_DURATION,
                'must-understand',
                'no-transform',
                'public',
                's-maxage=' . self::PUBLIC_CACHE_DURATION,
                'stale-if-error',
                'stale-while-revalidate=' . self::PUBLIC_CACHE_DURATION,
            ]),
        );
        $response->headers->set(
            'Expires',
            // phpcs:ignore SlevomatCodingStandard.Variables.DisallowSuperGlobalVariable
            gmdate('D, d M Y H:i:s \G\M\T', $_SERVER['REQUEST_TIME'] + self::PUBLIC_CACHE_DURATION),
        );
        $response->data = $this->renderIcon($hash, $ext);
        return $response;
    }

    /**
     * @param 'svg'|'png' $ext
     */
    private function renderIcon(string $hash, string $ext): string
    {
        $cacheKey = [
            __METHOD__,
            compact('hash', 'ext'),
            hash_file('sha256', (string)Yii::getAlias('@app/composer.lock')),
        ];

        return Yii::$app->cache->getOrSet(
            $cacheKey,
            fn (): string => $this->renderIconUncached($hash, $ext),
            self::PRIVATE_CACHE_DURATION,
        );
    }

    private function renderIconUncached(string $hash, string $ext): string
    {
        $renderer = Identicon::fromHash(hash: $hash, size: 500);
        $renderer->getStyle()
            ->setBackgroundColor(
                Color::fromRgb(
                    red: 255,
                    green: 255,
                    blue: 255,
                ),
            );

        return $renderer->getImageData($ext);
    }
}
