<?php

namespace Chromabits\TutumClient;

use Chromabits\TutumClient\Modules\ContainerModule;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Client
 *
 * Main client class for talking to the Tutum API
 *
 * @package Chromabits\TutumClient
 */
class Client
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
     * Construct an instance of a Client
     *
     * @param string $username
     * @param string $apiKey
     * @param string $baseUrl
     */
    public function __construct($username, $apiKey, $baseUrl = 'https://dashboard.tutum.co/api/v1/')
    {
        // Copy credentials
        $this->username = $username;
        $this->apiKey = $apiKey;

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

        $this->httpClient->setDefaultOption('headers/Authorization', $this->getAuthorizationHeader());
        $this->httpClient->setDefaultOption('headers/Accepts', 'application/json');
        $this->httpClient->setDefaultOption('base_url', $this->baseUrl);

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
     * Set the base URL for all API call
     *
     * @param $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        $this->httpClient->setDefaultOption('base_url', $baseUrl);
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

    protected function bootModules()
    {
        $this->container = new ContainerModule();

        $this->container->setHttpClient($this->httpClient);
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
    }
}
