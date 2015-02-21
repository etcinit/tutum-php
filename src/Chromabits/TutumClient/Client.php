<?php

namespace Chromabits\TutumClient;

use Chromabits\TutumClient\Interfaces\ClientInterface;
use Chromabits\TutumClient\Modules\ContainerModule;
use Chromabits\TutumClient\Modules\ServiceModule;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Client
 *
 * Main client class for talking to the Tutum API
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\TutumClient
 */
class Client implements ClientInterface
{
    /**
     * Tutum username
     *
     * @var string
     */
    protected $username;

    /**
     * Tutum API authentication key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Bearer authentication key
     *
     * @var string
     */
    protected $bearerKey;

    /**
     * Base URL for all API requests
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * @var ContainerModule
     */
    public $container;

    /**
     * @var ServiceModule
     */
    public $service;

    /**
     * Construct an instance of a Client
     *
     * @param string $username
     * @param string $apiKey
     * @param string $baseUrl
     */
    public function __construct(
        $username,
        $apiKey,
        $baseUrl = 'https://dashboard.tutum.co/api/v1/'
    ) {
        // Copy credentials
        $this->username = $username;
        $this->apiKey = $apiKey;
        $this->bearerKey = null;

        $this->baseUrl = $baseUrl;

        // Initialize http client
        $this->httpClient = new HttpClient([
            // Define request defaults
            'base_url' => $this->baseUrl,
            'defaults' => [
                'headers' => [
                    'Authorization' => $this->getAuthorizationHeader(),
                    'Accepts' => 'application/json'
                ]
            ]
        ]);

        $this->bootModules();
    }

    /**
     * Get the value of the Authorization header
     *
     * @return string
     */
    public function getAuthorizationHeader()
    {
        if (!is_null($this->bearerKey)) {
            return 'Bearer ' . $this->bearerKey;
        }

        return 'ApiKey ' . $this->username . ':' . $this->apiKey;
    }

    /**
     * Replace the internal http client
     *
     * @param HttpClient $client
     */
    public function setHttpClient(HttpClient $client)
    {
        $this->httpClient = $client;

        $this->httpClient->setDefaultOption(
            'headers/Authorization',
            $this->getAuthorizationHeader()
        );
        $this->httpClient->setDefaultOption(
            'headers/Accepts',
            'application/json'
        );

        $this->bootModules();
    }

    /**
     * Get the internal http client
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Get base URL
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Boot all client modules
     */
    protected function bootModules()
    {
        // Create instances
        $this->container = new ContainerModule();
        $this->service = new ServiceModule();

        // Pass HttpClient instance reference
        $this->container->setHttpClient($this->httpClient);
        $this->service->setHttpClient($this->httpClient);
    }

    /**
     * Get the bearer key
     *
     * @return string
     */
    public function getBearerKey()
    {
        return $this->bearerKey;
    }

    /**
     * Set the bearer key
     *
     * This will override the apiKey
     *
     * @param string $bearerKey
     */
    public function setBearerKey($bearerKey)
    {
        $this->bearerKey = $bearerKey;

        $this->httpClient->setDefaultOption(
            'headers/Authorization',
            $this->getAuthorizationHeader()
        );
    }
}
