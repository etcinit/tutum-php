<?php

namespace Chromabits\TutumClient\Modules;

use Chromabits\TutumClient\Responses\ContainerResponse;

/**
 * Class ContainerModule
 *
 * Client module for querying container resources
 * (everything under /api/v1/container/)
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\TutumClient\Modules
 */
class ContainerModule
{
    use ModuleTrait;

    /**
     * Fetch information about a container
     *
     * @param $uuid
     *
     * @return ContainerResponse
     */
    public function show($uuid)
    {
        $response = $this->httpClient->get($this->getResourceUrl($uuid));

        return ContainerResponse::createFromHttpResponse($response);
    }

    /**
     * Get the URL for a container resource based on a UUID
     *
     * @param $uuid
     *
     * @return string
     */
    protected function getResourceUrl($uuid)
    {
        return 'container/' . $uuid . '/';
    }
}
