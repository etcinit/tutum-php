<?php

namespace Chromabits\TutumClient\Requests;

use Chromabits\TutumClient\Entities\ContainerPort;
use Chromabits\TutumClient\Entities\Service;
use Chromabits\TutumClient\Interfaces\Arrayable;
use Chromabits\Nucleus\Support\ArrayUtils;
use Exception;

/**
 * Class CreateServiceRequest
 *
 * Represents a request for creating a new service
 *
 * @package Chromabits\TutumClient\Requests
 */
class CreateServiceRequest implements Arrayable
{
    /**
     * Image to be used by this service
     *
     * Format: username/image:tag
     *
     * @var string
     */
    protected $image;

    /**
     * Name of the service
     *
     * @var string
     */
    protected $name;

    /**
     * Target number of containers to launch
     *
     * @var int
     */
    protected $target_num_containers;

    /**
     * Container run command
     *
     * @var string
     */
    protected $run_command;

    /**
     * Container entry point
     *
     * @var string
     */
    protected $entrypoint;

    /**
     * Container ports
     *
     * @var string[]
     */
    protected $container_ports;

    /**
     * Environment variables set for the container
     *
     * @var string[]
     */
    protected $container_envvars;

    /**
     * Service links
     *
     * @var Array
     */
    protected $linked_to_service;

    /**
     * Automatically restart containers
     *
     * @var string
     */
    protected $autorestart;

    /**
     * Automatically destroy containers
     *
     * @var string
     */
    protected $autodestroy;

    /**
     * Sequentially deploy containers one by one
     *
     * @var bool
     */
    protected $sequential_deployment;

    /**
     * API roles
     *
     * @var string[]
     */
    protected $roles;

    /**
     * Should the container run privileged
     *
     * @var bool
     */
    protected $privileged;

    /**
     * Service tags
     *
     * @var string[]
     */
    protected $tags;

    /**
     * Get an array version of this instance
     *
     * @return mixed
     */
    public function toArray()
    {
        return (new ArrayUtils())->filterNullValues(get_object_vars($this), [
            'image', 'name', 'target_num_containers', 'run_command', 'entrypoint',
            'container_ports', 'container_envvars', 'linked_to_service',
            'autorestart', 'autodestroy', 'sequential_deployment', 'roles',
            'privileged', 'tags'
        ]);
    }

    /**
     * Set the image name to use for the service
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Set the service name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set target number of containers
     *
     * @param int $target_num_containers
     */
    public function setTargetNumContainers($target_num_containers)
    {
        $this->target_num_containers = $target_num_containers;
    }

    /**
     * Add a tag to the service
     *
     * @param $tag
     */
    public function addTag($tag)
    {
        $this->tags[] = [
            'name' => $tag
        ];
    }

    /**
     * Set container environment variable
     *
     * @param $name
     * @param $value
     */
    public function setEnvironment($name, $value)
    {
        $this->container_envvars[] = [
            'key' => $name,
            'value' => $value
        ];
    }

    /**
     * Add a port in the container
     *
     * @param ContainerPort $port
     */
    public function addPort(ContainerPort $port)
    {
        $this->container_ports[] = $port->toArray();
    }

    /**
     * @param string $entrypoint
     */
    public function setEntrypoint($entrypoint)
    {
        $this->entrypoint = $entrypoint;
    }

    /**
     * @param string $run_command
     */
    public function setRunCommand($run_command)
    {
        $this->run_command = $run_command;
    }

    /**
     * @param boolean $autorestart
     * @throws Exception
     */
    public function setAutorestart($autorestart)
    {
        if (!in_array($autorestart, ['OFF', 'ALWAYS', 'ON_FAILURE'])) {
            throw new Exception('Unknown autodestroy value');
        }

        $this->autorestart = $autorestart;
    }

    /**
     * @param boolean $autodestroy
     * @throws Exception
     */
    public function setAutodestroy($autodestroy)
    {
        if (!in_array($autodestroy, ['OFF', 'ALWAYS', 'ON_FAILURE'])) {
            throw new Exception('Unknown autodestroy value');
        }

        $this->autodestroy = $autodestroy;
    }

    /**
     * @param boolean $sequential_deployment
     */
    public function setSequentialDeployment($sequential_deployment)
    {
        $this->sequential_deployment = $sequential_deployment;
    }

    /**
     * @param boolean $privileged
     */
    public function setPrivileged($privileged)
    {
        $this->privileged = $privileged;
    }

    /**
     * Add a role
     *
     * @param $role
     * @throws Exception
     */
    public function addRole($role)
    {
        if (!in_array($role, ['global'])) {
            throw new Exception('Unknown role');
        }

        $this->roles[] = $role;
    }

    /**
     * Add a service to link to this service
     *
     * @param Service $service
     * @param string $name
     */
    public function linkTo(Service $service, $name = null)
    {
        $link = [
            'to_service' => $service->getResourceUri()
        ];

        if (!is_null($name)) {
            $link['name'] = $name;
        }

        $this->linked_to_service[] = $link;
    }
}
