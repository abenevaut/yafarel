<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Facades\Session;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;

final class LoggerProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $this->singleton('log', function () {
            $hit = uniqid();
            $config = $this->dispatcher->getApplication()->getConfig();

            return (new Logger('default'))
                ->setTimezone(
                    new \DateTimeZone($config->get('application.timezone'))
                )
                ->pushHandler(
                    (new RotatingFileHandler(
                        $config->get('logger.directory'),
                        $config->get('logger.maxFiles'),
                        Level::fromName($config->get('logger.level'))
                    ))
                        ->setFormatter(new LineFormatter(
                            "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
                            'Y-m-d H:i:s'
                        ))
                )
                ->pushProcessor(function ($record) use ($hit) {
                    $record->extra['sessionId'] = Session::sessionId();
                    $record->extra['userId'] = Session::userId();
                    $record->extra['hit'] = $hit;

                    return $record;
                })
            ;
        });

        return $this;
    }
}
