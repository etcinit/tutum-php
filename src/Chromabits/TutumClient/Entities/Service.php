<?php

namespace Chromabits\TutumClient\Entities;

use Chromabits\Nucleus\Support\ArrayUtils;
use Chromabits\TutumClient\Interfaces\Arrayable;
use GuzzleHttp\Url;

/**
 * Class Service
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\TutumClient\Entities
 */
class Service implements Arrayable
{
    const AUTODESTROY_OFF = 'OFF';
    const AUTODESTROY_ON_FAILURE = 'ON_FAILURE';
    const AUTODESTROY_ALWAYS = 'ALWAYS';

    const AUTORESTART_OFF = 'OFF';
    const AUTORESTART_ON_FAILURE = 'ON_FAILURE';
    const AUTORESTART_ALWAYS = 'ALWAYS';

    const ROLES_GLOBAL = 'global';

    const STATE_INIT = 'Init';
    const STATE_STARTING = 'Starting';
    const STATE_RUNNING = 'Running';
    const STATE_PARTLY_RUNNING = 'Partly running';
    const STATE_SCALING = 'Scaling';
    const STATE_REDEPLOYING = 'Redeploying';
    const STATE_STOPPING = 'Stopping';
    const STATE_STOPPED = 'Stopped';
    const STATE_TERMINATING = 'Terminating';
    const STATE_TERMINATED = 'Terminated';
    const STATE_NOT_RUNNING = 'Not running';

    /**
     * UUID of the service
     *
     * @var string
     */
    protected $uuid;

    /**
     * API Resource URI
     *
     * @var Url
     */
    protected $resource_uri;

    /**
     * Name of the Docker image used by this service
     *
     * @var string
     */
    protected $image_name;

    /**
     * Tag of the Docker image used by this service
     *
     * @var string
     */
    protected $image_tag;

    /**
     * Name of the service
     *
     * @var string
     */
    protected $name;

    /**
     * Unique name of the service
     *
     * @var string
     */
    protected $unique_name;

    /**
     * @var
     */
    protected $public_dns;

    /**
     * @var
     */
    protected $state;

    /**
     * @var
     */
    protected $deployed_datetime;

    /**
     * @var
     */
    protected $started_datetime;

    /**
     * @var
     */
    protected $stopped_datetime;

    /**
     * @var
     */
    protected $destroyed_datetime;

    /**
     * @var
     */
    protected $deployment_strategy;

    /**
     * @var
     */
    protected $target_num_containers;

    /**
     * @var
     */
    protected $current_num_containers;

    /**
     * @var
     */
    protected $running_num_containers;

    /**
     * @var
     */
    protected $stopped_num_containers;

    /**
     * @var
     */
    protected $containers;

    /**
     * @var
     */
    protected $container_ports;

    /**
     * @var
     */
    protected $container_envvars;

    /**
     * @var
     */
    protected $entrypoint;

    /**
     * @var
     */
    protected $run_command;

    /**
     * @var
     */
    protected $sequential_deployment;

    /**
     * @var
     */
    protected $cpu_shares;

    /**
     * @var
     */
    protected $memory;

    /**
     * @var
     */
    protected $linked_from_service;

    /**
     * @var
     */
    protected $linked_to_service;

    /**
     * @var
     */
    protected $bindings;

    /**
     * @var
     */
    protected $autorestart;

    /**
     * @var
     */
    protected $autodestroy;

    /**
     * @var
     */
    protected $roles;

    /**
     * @var
     */
    protected $actions;

    /**
     * @var
     */
    protected $link_variables;

    /**
     * @var
     */
    protected $privileged;

    /**
     * @var
     */
    protected $tags;

    /**
     * @var
     */
    protected $webhooks;

    /**
     * Get an array version of this instance
     *
     * @return mixed
     */
    public function toArray()
    {
        return (new ArrayUtils())
            ->filterNullValues($this, ['name', 'image_name']);
    }

    /**
     * Get the service UUID
     *
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
     * @return Url
     */
    public function getResourceUri()
    {
        return $this->resource_uri;
    }

    /**
     * @param Url $resource_uri
     */
    public function setResourceUri($resource_uri)
    {
        $this->resource_uri = $resource_uri;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->image_name;
    }

    /**
     * @param string $image_name
     */
    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }

    /**
     * @return string
     */
    public function getImageTag()
    {
        return $this->image_tag;
    }

    /**
     * @param string $image_tag
     */
    public function setImageTag($image_tag)
    {
        $this->image_tag = $image_tag;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUniqueName()
    {
        return $this->unique_name;
    }

    /**
     * @param string $unique_name
     */
    public function setUniqueName($unique_name)
    {
        $this->unique_name = $unique_name;
    }

    /**
     * @return mixed
     */
    public function getPublicDns()
    {
        return $this->public_dns;
    }

    /**
     * @param mixed $public_dns
     */
    public function setPublicDns($public_dns)
    {
        $this->public_dns = $public_dns;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getDeployedDatetime()
    {
        return $this->deployed_datetime;
    }

    /**
     * @param $deployed_datetime
     */
    public function setDeployedDatetime($deployed_datetime)
    {
        $this->deployed_datetime = $deployed_datetime;
    }

    /**
     * @return mixed
     */
    public function getStartedDatetime()
    {
        return $this->started_datetime;
    }

    /**
     * @param mixed $started_datetime
     */
    public function setStartedDatetime($started_datetime)
    {
        $this->started_datetime = $started_datetime;
    }

    /**
     * @return mixed
     */
    public function getStoppedDatetime()
    {
        return $this->stopped_datetime;
    }

    /**
     * @param mixed $stopped_datetime
     */
    public function setStoppedDatetime($stopped_datetime)
    {
        $this->stopped_datetime = $stopped_datetime;
    }

    /**
     * @return mixed
     */
    public function getDestroyedDatetime()
    {
        return $this->destroyed_datetime;
    }

    /**
     * @param $destroyed_datetime
     */
    public function setDestroyedDatetime($destroyed_datetime)
    {
        $this->destroyed_datetime = $destroyed_datetime;
    }

    /**
     * @return mixed
     */
    public function getDeploymentStrategy()
    {
        return $this->deployment_strategy;
    }

    /**
     * @param mixed $deployment_strategy
     */
    public function setDeploymentStrategy($deployment_strategy)
    {
        $this->deployment_strategy = $deployment_strategy;
    }

    /**
     * @return mixed
     */
    public function getTargetNumContainers()
    {
        return $this->target_num_containers;
    }

    /**
     * @param mixed $target_num_containers
     */
    public function setTargetNumContainers($target_num_containers)
    {
        $this->target_num_containers = $target_num_containers;
    }

    /**
     * @return mixed
     */
    public function getCurrentNumContainers()
    {
        return $this->current_num_containers;
    }

    /**
     * @param $current_num_containers
     */
    public function setCurrentNumContainers($current_num_containers)
    {
        $this->current_num_containers = $current_num_containers;
    }

    /**
     * @return mixed
     */
    public function getRunningNumContainers()
    {
        return $this->running_num_containers;
    }

    /**
     * @param mixed $running_num_containers
     */
    public function setRunningNumContainers($running_num_containers)
    {
        $this->running_num_containers = $running_num_containers;
    }

    /**
     * @return mixed
     */
    public function getStoppedNumContainers()
    {
        return $this->stopped_num_containers;
    }

    /**
     * @param mixed $stopped_num_containers
     */
    public function setStoppedNumContainers($stopped_num_containers)
    {
        $this->stopped_num_containers = $stopped_num_containers;
    }

    /**
     * @return mixed
     */
    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * @param $containers
     */
    public function setContainers($containers)
    {
        $this->containers = $containers;
    }

    /**
     * @return mixed
     */
    public function getContainerPorts()
    {
        return $this->container_ports;
    }

    /**
     * @param $container_ports
     */
    public function setContainerPorts($container_ports)
    {
        $this->container_ports = $container_ports;
    }

    /**
     * @return mixed
     */
    public function getContainerEnvvars()
    {
        return $this->container_envvars;
    }

    /**
     * @param $envvars
     */
    public function setContainerEnvVars($envvars)
    {
        $this->container_envvars = $envvars;
    }

    /**
     * @return mixed
     */
    public function getEntrypoint()
    {
        return $this->entrypoint;
    }

    /**
     * @param $entrypoint
     */
    public function setEntrypoint($entrypoint)
    {
        $this->entrypoint = $entrypoint;
    }

    /**
     * @return mixed
     */
    public function getRunCommand()
    {
        return $this->run_command;
    }

    /**
     * @param mixed $run_command
     */
    public function setRunCommand($run_command)
    {
        $this->run_command = $run_command;
    }

    /**
     * @return mixed
     */
    public function getSequentialDeployment()
    {
        return $this->sequential_deployment;
    }

    /**
     * @param mixed $sequential_deployment
     */
    public function setSequentialDeployment($sequential_deployment)
    {
        $this->sequential_deployment = $sequential_deployment;
    }

    /**
     * @return mixed
     */
    public function getCpuShares()
    {
        return $this->cpu_shares;
    }

    /**
     * @param $cpu_shares
     */
    public function setCpuShares($cpu_shares)
    {
        $this->cpu_shares = $cpu_shares;
    }

    /**
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param mixed $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }

    /**
     * @return mixed
     */
    public function getLinkedFromService()
    {
        return $this->linked_from_service;
    }

    /**
     * @param mixed $linked_from_service
     */
    public function setLinkedFromService($linked_from_service)
    {
        $this->linked_from_service = $linked_from_service;
    }

    /**
     * @return mixed
     */
    public function getLinkedToService()
    {
        return $this->linked_to_service;
    }

    /**
     * @param mixed $linked_to_service
     */
    public function setLinkedToService($linked_to_service)
    {
        $this->linked_to_service = $linked_to_service;
    }

    /**
     * @return mixed
     */
    public function getBindings()
    {
        return $this->bindings;
    }

    /**
     * @param $bindings
     */
    public function setBindings($bindings)
    {
        $this->bindings = $bindings;
    }

    /**
     * @return mixed
     */
    public function getAutorestart()
    {
        return $this->autorestart;
    }

    /**
     * @param $autorestart
     *
     * @throws \Exception
     */
    public function setAutoRestart($autorestart)
    {
        $this->autorestart = $autorestart;
    }

    /**
     * @return mixed
     */
    public function getAutodestroy()
    {
        return $this->autodestroy;
    }

    /**
     * @param $autodestroy
     *
     * @throws \Exception
     */
    public function setAutoDestroy($autodestroy)
    {
        $this->autodestroy = $autodestroy;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param mixed $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * @return mixed
     */
    public function getLinkVariables()
    {
        return $this->link_variables;
    }

    /**
     * @param mixed $link_variables
     */
    public function setLinkVariables($link_variables)
    {
        $this->link_variables = $link_variables;
    }

    /**
     * @return mixed
     */
    public function getPrivileged()
    {
        return $this->privileged;
    }

    /**
     * @param mixed $privileged
     */
    public function setPrivileged($privileged)
    {
        $this->privileged = $privileged;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getWebhooks()
    {
        return $this->webhooks;
    }

    /**
     * @param mixed $webhooks
     */
    public function setWebhooks($webhooks)
    {
        $this->webhooks = $webhooks;
    }
}
