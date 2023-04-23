<?php

namespace App\Services;

use Yaf\Application;
use Yaf\Registry;
use Yaf\Session as YafSession;

final class Session
{
    public function __construct(
        protected string $name,
        protected string $domain,
        protected string $baseUri,
        protected int $lifetime,
        protected bool $secure,
        protected string $sameSite
    ) {}

    public static function get(string $key): mixed
    {
        return YafSession::getInstance()->get($key);
    }

    public static function set(string $key, mixed $value): void
    {
        YafSession::getInstance()->set($key, $value);
    }

    public static function sessionId(): int
    {
        return (int) session_id();
    }

    public static function userId(): int
    {
        return (int) self::get('userId');
    }

    public static function setUserId(int $userId): void
    {
        self::set('userId', $userId);
    }

    public function start(): self
    {
        if (session_status() === PHP_SESSION_NONE) {

            session_name($this->name);

            session_set_cookie_params([
                'lifetime' => $this->lifetime,
                'path' => $this->baseUri,
                'domain' => $this->domain,
                'secure' => $this->secure,
                'httponly' => false,
                'samesite' => $this->sameSite
            ]);

            YafSession::getInstance()->start();
        }

        return $this;
    }

    public function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
