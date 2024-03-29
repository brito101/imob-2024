<?php

namespace App\Helpers;

/**
 * Class Cookie
 */
class Cookie
{

    /**
     * @param string $name
     * @param mixed $value
     * @param int $minutes
     * @param string|null $path
     * @param bool $encrypt
     * @return bool
     */
    public static function set(string $name, mixed $value, int $minutes, ?string $path = null, bool $encrypt = true): bool
    {
        // check if the cookie value is an array to save in json
        if (is_array($value)) {
            $cookie = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $value = $encrypt ? self::encrypt($cookie) : $cookie;
        } else {
            $value = $encrypt ? self::encrypt($value) : $value;
        }
        return self::setCookie($name, $value, self::expire($minutes), $path);
    }

    /**
     * @param string $name
     * @param string|null $path
     * @return bool
     */
    public static function destroy(string $name, ?string $path = null): bool
    {
        return self::setCookie($name, null, -1, $path);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param bool $encrypt
     * @return bool
     */
    public static function has(string $name, ?string $value = null, bool $encrypt = true): bool
    {
        $getCookie = self::getCookie($name);
        if (!$value) {
            if ($getCookie) {
                return true;
            }
            return false;
        } else {
            if ($getCookie == ($encrypt ? self::encrypt($value) : $value)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $name
     * @return mixed|string|null
     */
    public static function get(string $name): mixed
    {
        if (self::has($name)) {
            $cookie = self::decrypt(self::getCookie($name));
            if ($cookie) {
                if ($decode = json_decode($cookie, true)) {
                    return $decode;
                }
                return $cookie;
            }
            return null;
        }
        return null;
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param int $expire
     * @param string|null $path
     * @return bool
     */
    private static function setCookie(string $name, ?string $value, int $expire, ?string $path = null): bool
    {
        return setcookie($name, $value, $expire, ($path ?? '/'));
    }

    /**
     * @param string $name
     * @return mixed
     */
    private static function getCookie(string $name): mixed
    {
        return filter_input(INPUT_COOKIE, $name);
    }

    /**
     * @param int $minutes
     * @return int
     */
    private static function expire(int $minutes): int
    {
        return time() + (60 * $minutes);
    }

    /**
     * @param string $value
     * @return string
     */
    private static function encrypt(string $value): string
    {
        return base64_encode($value);
    }

    /**
     * @param string $value
     * @return string
     */
    private static function decrypt(string $value): string
    {
        return base64_decode($value);
    }
}
