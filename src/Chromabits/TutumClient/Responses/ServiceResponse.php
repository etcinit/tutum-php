<?php

namespace Chromabits\TutumClient\Responses;

use Chromabits\Nucleus\Support\ArrayUtils;
use Chromabits\TutumClient\Entities\Service;
use GuzzleHttp\Message\Response as HttpResponse;

/**
 * Class ServiceResponse
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\TutumClient\Responses
 */
class ServiceResponse extends Response
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * Create a new response instance out of an http response from Guzzle
     *
     * @param HttpResponse $response
     *
     * @return ContainerResponse
     */
    public static function createFromHttpResponse(HttpResponse $response)
    {
        $containerResponse = new ServiceResponse();

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

        $service = new Service();

        (new ArrayUtils())->callSetters(
            $service,
            $json,
            [
                'autodestroy', 'autorestart', 'bindings', 'container_envvars',
                'container_ports', 'containers', 'cpu_shares',
                'current_num_containers', 'deployed_datetime',
                'deployment_strategy', 'destroyed_datetime', 'entrypoint',
                'image_name', 'image_tag', 'link_variables',
                'linked_from_service', 'memory', 'name', 'privileged',
                'public_dns', 'resource_uri', 'roles', 'run_command',
                'running_num_containers', 'sequential_deployment',
                'started_datetime', 'state', 'stopped_datetime',
                'stopped_num_containers', 'tags', 'target_num_containers',
                'unique_name', 'uuid', 'webhook'
            ]
        );

        $this->service = $service;
    }

    /**
     * Get the service entity
     *
     * @return Service
     */
    public function get()
    {
        return $this->service;
    }
}
