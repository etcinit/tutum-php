<?php

namespace Chromabits\TutumClient\Entities;

use Chromabits\Nucleus\Support\ArrayUtils;
use Chromabits\TutumClient\Interfaces\Arrayable;

/**
 * Class ContainerPort
 *
 * Represents a container port
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\TutumClient\Entities
 */
class ContainerPort implements Arrayable
{
    const PROTO_TCP = 'tcp';
    const PROTO_UDP = 'udp';

    /**
     * Protocol of the port
     *
     * Either TCP or UDP
     *
     * @var string
     */
    protected $protocol;

    /**
     * Inner port number
     *
     * @var int
     */
    protected $inner_port;

    /**
     * Outer port number
     *
     * @var int
     */
    protected $outer_port;

    /**
     * Whether the port is published to the public interface
     *
     * @var bool
     */
    protected $published;

    /**
     * Construct an instance of a ContainerPort
     *
     * @param int $innerPort
     * @param string $protocol
     * @param null $outerPort
     * @param null $published
     */
    public function __construct(
        $innerPort, $protocol = 'tcp',
        $outerPort = null,
        $published = null
    ) {
        $this->protocol = $protocol;

        $this->inner_port = $innerPort;

        if (!is_null($outerPort)) {
            $this->outer_port = $outerPort;
        }

        if (!is_null($published)) {
            $this->published = $published;
        }
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return int
     */
    public function getInnerPort()
    {
        return $this->inner_port;
    }

    /**
     * @param int $innerPort
     */
    public function setInnerPort($innerPort)
    {
        $this->inner_port = $innerPort;
    }

    /**
     * @return int
     */
    public function getOuterPort()
    {
        return $this->outer_port;
    }

    /**
     * @param int $outerPort
     */
    public function setOuterPort($outerPort)
    {
        $this->outer_port = $outerPort;
    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * Get an array version of this instance
     *
     * @return mixed
     */
    public function toArray()
    {
        return (new ArrayUtils())->filterNullValues(get_object_vars($this), [
            'protocol', 'inner_port', 'outer_port', 'published'
        ]);
    }
}
