<?php

namespace Chromabits\TutumClient\Modules;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Message\Response;

/**
 * Trait ModuleTrait
 *
 * Defines a client module should behave
 */
trait ModuleTrait
{
    /**
     * Internal http client
     *
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Set reference to internal http client
     *
     * @param HttpClient $client
     */
    public function setHttpClient(HttpClient $client)
    {
        $this->httpClient = $client;
    }

    /**
     * Parse the response into an stdClass object
     *
     * @param Response $response
     * @return mixed
     */
    protected function parseResponse(Response $response)
    {
        return json_decode($response->getBody());
    }
}
