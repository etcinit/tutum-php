<?php

namespace Chromabits\TutumClient\Responses;

use Chromabits\TutumClient\Entities\Service;
use Chromabits\Nucleus\Support\ArrayUtils;
use GuzzleHttp\Message\Response as HttpResponse;

/**
 * Class ServicesResponse
 *
 * @package Chromabits\TutumClient\Responses
 */
class ServicesResponse extends Response
{
    /**
     * @var Service[]
     */
    protected $services;

    /**
     * Create a new response instance out of an http response from Guzzle
     *
     * @param HttpResponse $response
     * @return ContainerResponse
     */
    public static function createFromHttpResponse(HttpResponse $response)
    {
        $containerResponse = new ServicesResponse();

        $containerResponse->setHttpResponse($response);

        return $containerResponse;
    }

    /**
     * Parses the HttpResponse
     *
     * @return mixed
     */
    protected function parse()
    {
        $json = $this->httpResponse->json();

        $this->services = [];

        foreach($json['objects'] as $serviceJson) {
            $this->services[] = $this->parseService($serviceJson);
        }
    }

    /**
     * Parse a single service
     *
     * @param $json
     * @return Service
     */
    protected function parseService($json)
    {
        $service = new Service();

        (new ArrayUtils())->callSetters(
            $service,
            $json,
            [
                'autodestroy', 'autorestart', 'bindings', 'container_envvars', 'container_ports',
                'containers', 'cpu_shares', 'current_num_containers', 'deployed_datetime',
                'deployment_strategy', 'destroyed_datetime', 'entrypoint', 'image_name',
                'image_tag', 'link_variables', 'linked_from_service', 'memory', 'name',
                'privileged', 'public_dns', 'resource_uri', 'roles', 'run_command',
                'running_num_containers', 'sequential_deployment', 'started_datetime',
                'state', 'stopped_datetime', 'stopped_num_containers', 'tags',
                'target_num_containers', 'unique_name', 'uuid', 'webhook'
            ]
        );

        return $service;
    }

    /**
     * Get the service entities
     *
     * @return Service[]
     */
    public function get()
    {
        return $this->services;
    }
}
