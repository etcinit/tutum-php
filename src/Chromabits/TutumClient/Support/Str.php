<?php

namespace Chromabits\TutumClient\Support;

/**
 * Class Str
 *
 * String utilities (from Laravel)
 *
 * @package Chromabits\TutumClient\Support
 */
class Str
{
    /**
     * The cache of snake-cased words.
     *
     * @var array
     */
    protected static $snakeCache = [];

    /**
     * The cache of camel-cased words.
     *
     * @var array
     */
    protected static $camelCache = [];

    /**
     * The cache of studly-cased words.
     *
     * @var array
     */
    protected static $studlyCache = [];

    /**
     * Convert a value to camel case.
     *
     * @param string $value
     * @return string
     */
    public static function camel($value)
    {
        if (isset(static::$camelCache[$value]))
        {
            return static::$camelCache[$value];
        }
        return static::$camelCache[$value] = lcfirst(static::studly($value));
    }

    /**
     * Convert a string to snake case.
     *
     * @param string $value
     * @param string $delimiter
     * @return string
     */
    public static function snake($value, $delimiter = '_')
    {
        if (isset(static::$snakeCache[$value.$delimiter]))
        {
            return static::$snakeCache[$value.$delimiter];
        }
        if ( ! ctype_lower($value))
        {
            $value = strtolower(preg_replace('/(.)(?=[A-Z])/', '$1'.$delimiter, $value));
        }
        return static::$snakeCache[$value.$delimiter] = $value;
    }

    /**
     * Convert a value to studly caps case.
     *
     * @param string $value
     * @return string
     */
    public static function studly($value)
    {
        if (isset(static::$studlyCache[$value]))
        {
            return static::$studlyCache[$value];
        }
        $value = ucwords(str_replace(array('-', '_'), ' ', $value));
        return static::$studlyCache[$value] = str_replace(' ', '', $value);
    }
}
