<?php

namespace Chromabits\TutumClient\Modules;

use Chromabits\TutumClient\Entities\Service;
use Chromabits\TutumClient\Requests\CreateServiceRequest;
use Chromabits\TutumClient\Responses\ServiceResponse;
use Chromabits\TutumClient\Responses\ServicesResponse;
use Chromabits\Nucleus\Support\ArrayUtils;

/**
 * Class ServiceModule
 *
 * @package Chromabits\TutumClient\Modules
 */
class ServiceModule
{
    use ModuleTrait;

    /**
     * Create a new service
     *
     * @param CreateServiceRequest $serviceRequest
     * @return \Chromabits\TutumClient\Responses\ServiceResponse
     */
    public function create(CreateServiceRequest $serviceRequest)
    {
        $response = $this->httpClient->post(
            'service/',
            [
                'body' => json_encode($serviceRequest->toArray())
            ]
        );

        return ServiceResponse::createFromHttpResponse($response);
    }

    /**
     * Start a service
     *
     * @param string|Service $uuid
     * @return \Chromabits\TutumClient\Responses\ServiceResponse
     */
    public function start($uuid)
    {
        if ($uuid instanceof Service) {
            $uuid = $uuid->getUuid();
        }

        $response = $this->httpClient->post(
            $this->getResourceUrl($uuid) . 'start/',
            []
        );

        return ServiceResponse::createFromHttpResponse($response);
    }

    /**
     * Get the URL for a service resource based on a UUID
     *
     * @param $uuid
     * @return string
     */
    protected function getResourceUrl($uuid)
    {
        return 'service/' . $uuid . '/';
    }

    /**
     * Stop a service
     *
     * @param string|Service $uuid
     * @return \Chromabits\TutumClient\Responses\ServiceResponse
     */
    public function stop($uuid)
    {
        if ($uuid instanceof Service) {
            $uuid = $uuid->getUuid();
        }

        $response = $this->httpClient->post(
            $this->getResourceUrl($uuid) . 'stop/',
            []
        );

        return ServiceResponse::createFromHttpResponse($response);
    }

    /**
     * Redeploy a service
     *
     * @param string|Service $uuid
     * @return \Chromabits\TutumClient\Responses\ServiceResponse
     */
    public function redeploy($uuid)
    {
        if ($uuid instanceof Service) {
            $uuid = $uuid->getUuid();
        }

        $response = $this->httpClient->post(
            $this->getResourceUrl($uuid) . 'redeploy/',
            []
        );

        return ServiceResponse::createFromHttpResponse($response);
    }

    /**
     * Get a service
     *
     * @param string|Service $uuid
     * @return \Chromabits\TutumClient\Responses\ServiceResponse
     */
    public function show($uuid)
    {
        if ($uuid instanceof Service) {
            $uuid = $uuid->getUuid();
        }

        $response = $this->httpClient->get(
            $this->getResourceUrl($uuid),
            []
        );

        return ServiceResponse::createFromHttpResponse($response);
    }

    /**
     * Terminate a service
     *
     * @param string|Service $uuid
     * @return \Chromabits\TutumClient\Responses\ServiceResponse
     */
    public function terminate($uuid)
    {
        if ($uuid instanceof Service) {
            $uuid = $uuid->getUuid();
        }

        $response = $this->httpClient->delete(
            $this->getResourceUrl($uuid),
            []
        );

        return ServiceResponse::createFromHttpResponse($response);
    }

    /**
     * Get all services
     *
     * @param string $state Filter by state
     * @param string $name Filter by name
     * @param string $unique_name Filter by unique name
     * @return \Chromabits\TutumClient\Responses\ServicesResponse
     */
    public function index($state = null, $name = null, $unique_name = null)
    {
        $response = $this->httpClient->get(
            'service/',
            [
                'query' => (new ArrayUtils())->filterNullValues(
                    [
                        'state' => $state,
                        'name' => $name,
                        'unique_name' => $unique_name
                    ]
                )
            ]
        );

        return ServicesResponse::createFromHttpResponse($response);
    }
}
