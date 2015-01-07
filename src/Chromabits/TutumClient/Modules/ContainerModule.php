<?php

namespace Chromabits\TutumClient\Modules;

use Chromabits\TutumClient\Responses\ContainerResponse;

class ContainerModule
{
    use ModuleTrait;

    public function show($uuid)
    {
        $response = $this->httpClient->get($this->getResourceUrl($uuid));

        return ContainerResponse::createFromHttpResponse($response);
    }

    protected function getResourceUrl($uuid)
    {
        return 'container/' . $uuid . '/';
    }
}
