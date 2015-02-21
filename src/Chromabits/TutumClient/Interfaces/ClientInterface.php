<?php

namespace Chromabits\TutumClient\Interfaces;

use GuzzleHttp\Client as HttpClient;

/**
 * Interface ClientInterface
 *
 * Main client class for talking to the Tutum API
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\TutumClient
 */
interface ClientInterface
{
    /**
     * Get the value of the Authorization header
     *
     * @return string
     */
    public function getAuthorizationHeader();

    /**
     * Replace the internal http client
     *
     * @param HttpClient $client
     */
    public function setHttpClient(HttpClient $client);

    /**
     * Get the internal http client
     *
     * @return HttpClient
     */
    public function getHttpClient();

    /**
     * Get base URL
     *
     * @return string
     */
    public function getBaseUrl();

    /**
     * Get the bearer key
     *
     * @return string
     */
    public function getBearerKey();

    /**
     * Set the bearer key
     *
     * This will override the apiKey
     *
     * @param string $bearerKey
     */
    public function setBearerKey($bearerKey);
}
