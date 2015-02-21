<?php

namespace Chromabits\TutumClient\Support;

use Exception;
use GuzzleHttp\Url;

/**
 * Class EnvUtils
 *
 * various utility functions for getting Tutum-specific
 * environment information out of environment variables inside the container
 *
 * Note: For this to work, this PHP code must be executed on the process
 * ran inside the container. This won't work on a regular web server
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\TutumClient\Support
 */
class EnvUtils
{
    /**
     * Return whether or not we can figure out the bearer key
     *
     * @return bool
     */
    public function hasBearerKey()
    {
        return $this->hasEnvVariable('TUTUM_AUTH');
    }

    /**
     * Return whether or not an environment variable is defined
     *
     * @param $variable
     *
     * @return bool
     */
    protected function hasEnvVariable($variable)
    {
        return (getenv($variable) !== false);
    }

    /**
     * Get the Tutum API Bearer key
     *
     * @return mixed
     */
    public function getBearerKey()
    {
        return str_replace('Bearer ', '', getenv('TUTUM_AUTH'));
    }

    /**
     * Return whether or not we can figure out the Tutum Container UUID
     *
     * @return bool
     */
    public function hasContainerUuid()
    {
        return $this->hasEnvVariable('TUTUM_CONTAINER_API_URL');
    }

    /**
     * Get the Tutum Container UUID
     *
     * @return mixed
     */
    public function getContainerUuid()
    {
        return $this->getUuidFromUrl(
            Url::fromString(getenv('TUTUM_CONTAINER_API_URL'))
        );
    }

    /**
     * Extract the last part of a URL
     *
     * which in Tutum's case is usually the UUID
     *
     * @param Url $url
     *
     * @return mixed
     * @throws Exception
     */
    protected function getUuidFromUrl(Url $url)
    {
        $segments = $url->getPathSegments();

        if (count($segments) < 1) {
            throw new Exception('Invalid UUID');
        }

        if (count($segments) < 2) {
            return $segments[0];
        }

        return $segments[count($segments) - 2];
    }

    /**
     * Return whether or we can figure out the Tutum Service UUID
     *
     * @return bool
     */
    public function hasServiceUuid()
    {
        return $this->hasEnvVariable('TUTUM_SERVICE_API_URL');
    }

    /**
     * Get the Tutum Service UUID
     *
     * @return mixed
     */
    public function getServiceUuid()
    {
        return $this->getUuidFromUrl(
            Url::fromString(getenv('TUTUM_SERVICE_API_URL'))
        );
    }

    /**
     * Return whether or not we can figure out the container hostname
     *
     * @return bool
     */
    public function hasHostname()
    {
        return $this->hasEnvVariable('TUTUM_CONTAINER_HOSTNAME');
    }

    /**
     * Get the container hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return getenv('TUTUM_CONTAINER_HOSTNAME');
    }
}
