<?php

namespace Chromabits\TutumClient\Support;

/**
 * Class ArrayUtils
 *
 * Array utility functions
 *
 * @package Chromabits\TutumClient\Support
 */
class ArrayUtils
{
    /**
     * Get an array of object properties which are set
     *
     * @param $properties
     * @param array $allowed
     * @return array
     */
    public function filterIfNotSet($properties, array $allowed = null)
    {
        // If provided, only use allowed properties
        if (!is_null($allowed)) {
            $properties = array_filter($properties, function ($key) use ($allowed) {
                return in_array($key, $allowed);
            }, ARRAY_FILTER_USE_KEY);
        }

        return array_filter($properties, function ($value) {
            return isset($value);
        });
    }

    /**
     * Get array elements that are not null
     *
     * @param $properties
     * @param array $allowed
     * @return array
     */
    public function filterIfNotNull($properties, array $allowed = null)
    {
        // If provided, only use allowed properties
        if (!is_null($allowed)) {
            $properties = array_filter($properties, function ($key) use ($allowed) {
                return in_array($key, $allowed);
            }, ARRAY_FILTER_USE_KEY);
        }

        return array_filter($properties, function ($value) {
            return !is_null($value);
        });
    }

    /**
     * Set properties of an object by only calling setters of array keys that are set
     * in the input array. Useful for parsing API responses into entities.
     *
     * @param $object
     * @param array $input
     * @param array $allowed
     */
    public function callSettersIfNotSet($object, array $input, array $allowed = null)
    {
        $filtered = $input;

        if (!is_null($allowed)) {
            $filtered = array_filter($input, function ($key) use ($allowed) {
                return in_array($key, $allowed);
            }, ARRAY_FILTER_USE_KEY);
        }

        foreach ($filtered as $key => $value) {
            $setterName = 'set' . Str::studly($key);

            $object->$setterName($value);
        }
    }
}
