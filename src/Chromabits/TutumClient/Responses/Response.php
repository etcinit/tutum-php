<?php

namespace Chromabits\TutumClient\Responses;

use GuzzleHttp\Message\Response as HttpResponse;

/**
 * Class Response
 *
 * Base response class
 *
 * @package Chromabits\TutumClient\Responses
 */
abstract class Response
{
    /**
     * @var HttpResponse
     */
    protected $httpResponse;

    /**
     * Get the raw response body
     *
     * @return \stdClass
     */
    public function getBody()
    {
        return $this->httpResponse->json();
    }

    /**
     * @param HttpResponse $response
     */
    protected function setHttpResponse(HttpResponse $response)
    {
        $this->httpResponse = $response;

        $this->parse();
    }

    /**
     * Parses the HttpResponse
     *
     * @return mixed
     */
    protected abstract function parse();
}
