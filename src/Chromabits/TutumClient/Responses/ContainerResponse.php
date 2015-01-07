<?php

namespace Chromabits\TutumClient\Responses;

use Chromabits\TutumClient\Entities\Container;
use Chromabits\TutumClient\Entities\ContainerLink;
use GuzzleHttp\Message\Response as HttpResponse;

class ContainerResponse extends Response
{
    /**
     * @var Container
     */
    protected $container;

    public static function createFromHttpResponse(HttpResponse $response)
    {
        $containerResponse = new ContainerResponse();

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

        $container = new Container();

        // Parse some basic info
        $container->setUuid($json['uuid']);
        $container->setUniqueName($json['unique_name']);

        // Parse links
        foreach($json['linked_to_container'] as $rawLink) {
            $link = new ContainerLink(
                $rawLink['name'],
                $rawLink['from_container'],
                $rawLink['to_container'],
                $rawLink['endpoints']
            );

            $container->addLink($link);
        }

        $this->container = $container;
    }

    /**
     * Get the container entity
     *
     * @return Container
     */
    public function get()
    {
        return $this->container;
    }
}