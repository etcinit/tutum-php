<?php

namespace Chromabits\TutumClient;

use Chromabits\TutumClient\Support\EnvUtils;
use Exception;

/**
 * Class ClientFactory
 *
 * Builds Tutum API clients
 *
 * @package Chromabits\TutumClient
 */
class ClientFactory
{
    /**
     * Build a client using configuration from the environment
     *
     * @return Client
     * @throws Exception
     */
    public function makeFromEnvironment()
    {
        $env = new EnvUtils();

        // Check that we have all variables we need
        if (!$env->hasBearerKey()) {
            throw new Exception('TUTUM_AUTH is not set. Unable to create from environment');
        }

        $client = new Client('', '');
        $client->setBearerKey($env->getBearerKey());

        return $client;
    }
}
