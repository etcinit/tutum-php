<?php

namespace Chromabits\TutumClient\Entities;

use Exception;
use GuzzleHttp\Url;

/**
 * Class ContainerLink
 *
 * Represents a link between two containers
 *
 * @package Chromabits\TutumClient\Entities
 */
class ContainerLink
{
    /**
     * Name of the link
     *
     * @var string
     */
    protected $name;

    /**
     * Endpoints
     *
     * @var array
     */
    protected $endpoints;

    /**
     * UUID of the from container
     *
     * @var string
     */
    protected $from;

    /**
     * UUID of the to container
     *
     * @var string
     */
    protected $to;

    /**
     * Construct an instance of a ContainerLink
     *
     * @param $name
     * @param $from
     * @param $to
     * @param array $endpoints
     */
    public function __construct($name, $from, $to, $endpoints = [])
    {
        $this->name = $name;

        $this->from = Container::parseUriToUuid($from);
        $this->to = Container::parseUriToUuid($to);

        $this->endpoints = [];

        // Parse endpoints if any where provided
        if (count($endpoints) > 0) {
            foreach ($endpoints as $port => $endpoint) {
                $this->addEndpoint($port, $endpoint);
            }
        }
    }

    /**
     * Add an endpoint
     *
     * @param string $port
     * @param string $endpoint
     */
    public function addEndpoint($port, $endpoint)
    {
        $this->endpoints[$port] = $endpoint;
    }

    /**
     * Get all endpoints as strings
     *
     * @return array
     */
    public function getEndpoints()
    {
        return $this->endpoints;
    }

    /**
     * Get all endpoints as URLs
     *
     * @return Url[]
     */
    public function getEndpointsAsUrls()
    {
        return array_map(function ($endpoint) {
            return Url::fromString($endpoint);
        }, $this->endpoints);
    }

    /**
     * Try to get a single endpoint as a Url
     *
     * @param $port
     * @param string $protocol
     * @return Url
     * @throws Exception
     */
    public function getEndpointAsUrl($port, $protocol = 'tcp')
    {
        if (!$this->hasEndpoint($port, $protocol)) {
            throw new Exception('Endpoint is not available');
        }

        $key = $port . '/' . $protocol;

        return Url::fromString($this->endpoints[$key]);
    }

    /**
     * Return whether or not an endpoint exists
     *
     * @param $port
     * @param string $protocol
     * @return bool
     */
    public function hasEndpoint($port, $protocol = 'tcp')
    {
        $key = $port . '/' . $protocol;

        return array_key_exists($key, $this->endpoints);
    }

    /**
     * Get name of the container linked
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get UUID of FROM container
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get UUID of TO container
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }
}
