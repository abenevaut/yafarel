<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;

final class LoggerProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $config = $this->dispatcher->getApplication()->getConfig();

        $this->singleton(Logger::class, static function () use ($config) {
            $hit = uniqid();

            return (new Logger('default'))
                ->setTimezone(
                    new \DateTimeZone($config->get('application')->get('timezone'))
                )
                ->pushHandler(
                    (new RotatingFileHandler(
                        $config->get('logger')->get('directory'),
                        $config->get('logger')->get('maxFiles'),
                        Level::fromName($config->get('logger')->get('level'))
                    ))
                        ->setFormatter(new LineFormatter(
                            "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
                            'Y-m-d H:i:s'
                        ))
                )
                ->pushProcessor(function ($record) use ($hit) {
                    $record->extra['hit'] = $hit;

                    return $record;
                })
            ;
        });

        return $this;
    }
}
