<?php

namespace Chromabits\TutumClient\Interfaces;

/**
 * Interface Arrayable
 *
 * Describes classes which can be represented as arrays instances
 *
 * @package Chromabits\TutumClient\Interfaces
 */
interface Arrayable
{
    /**
     * Get an array version of this instance
     *
     * @return mixed
     */
    public function toArray();
}
