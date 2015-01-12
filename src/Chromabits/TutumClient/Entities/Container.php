<?php

namespace Chromabits\TutumClient\Entities;

/**
 * Class Container
 *
 * Represents a Container resource on the Tutum API
 *
 * @package Chromabits\TutumClient\Entities
 */
class Container
{
    /**
     * Docker Container UUID
     *
     * @var string
     */
    protected $uuid;

    /**
     * Docker Container Name
     *
     * @var string
     */
    protected $uniqueName;

    /**
     * Array of container links
     *
     * @var ContainerLink[]
     */
    protected $links;

    /**
     * Extracts the UUID from a URI
     *
     * /api/v1/container/4c037a97-49bd-495b-b5b2-cc58b3255690/
     * into just
     * 4c037a97-49bd-495b-b5b2-cc58b3255690
     *
     * @param $uri
     * @return mixed
     */
    public static function parseUriToUuid($uri)
    {
        $uriTokens = explode('/', trim($uri, '/'));

        return $uriTokens[count($uriTokens) - 1];
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getUniqueName()
    {
        return $this->uniqueName;
    }

    /**
     * @param string $uniqueName
     */
    public function setUniqueName($uniqueName)
    {
        $this->uniqueName = $uniqueName;
    }

    /**
     * Add a container link
     *
     * @param ContainerLink $link
     */
    public function addLink(ContainerLink $link)
    {
        $this->links[] = $link;
    }

    /**
     * Get all container links
     *
     * @return ContainerLink[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Find linked services that match a certain criteria
     *
     * @param string $serviceName
     * @param int[] $tcpPorts
     * @param int[] $udpPorts
     * @return ContainerLink[]
     */
    public function findLinks($serviceName, $tcpPorts = [], $udpPorts = [])
    {
        // First match names
        $matching = [];
        $encodedName = $this->encodeServiceName($serviceName);

        $regex = '/^' . $encodedName . '_([0-9]+)$/';

        foreach ($this->links as $link) {
            if (preg_match($regex, $link->getName())) {
                $matching[] = $link;
            }
        }

        // Find those that match TCP ports
        $matching = array_filter($matching, function (ContainerLink $link) use ($tcpPorts) {
            foreach ($tcpPorts as $tcpPort) {
                if (!$link->hasEndpoint($tcpPort, 'tcp')) {
                    return false;
                }
            }

            return true;
        });

        // Reduce even more by finding those that match UDP ports
        $matching = array_filter($matching, function (ContainerLink $link) use ($udpPorts) {
            foreach ($udpPorts as $udpPort) {
                if (!$link->hasEndpoint($udpPort, 'udp')) {
                    return false;
                }
            }

            return true;
        });

        return $matching;
    }

    /**
     * Get the name of a service encoded in link format
     *
     * Ex:
     * My Super Service
     * converts to
     * MY_SUPER_SERVICE
     *
     * @param $name
     * @return string
     */
    protected function encodeServiceName($name)
    {
        return strtoupper(str_replace(['', '-'], '_', $name));
    }
}
