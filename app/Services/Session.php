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

    public static function getInstance(): Session
    {
        return Registry::get('session');
    }

    public static function userId(): int
    {
        return (int) self::getInstance()->get('userId');
    }

    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {

            session_name($this->name);

            session_set_cookie_params([
                'lifetime' => $this->lifetime,
                'path' => $this->baseUri,
                'domain' => $this->domain,
                'secure' => $this->secure,
                'httponly' => !$this->secure,
                'samesite' => $this->sameSite
            ]);

            YafSession::getInstance()->start();
        }
    }

    public function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    public function get(string $key): mixed
    {
        return YafSession::getInstance()->get($key);
    }

    public function set(string $key, mixed $value): void
    {
        YafSession::getInstance()->set($key, $value);
    }
}
