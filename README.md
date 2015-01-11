# Tutum PHP

A partial PHP wrapper of the Tutum API

---

## About

This is a simple library for querying and discovering container links and managing services in Tutum
However, it could be expanded to a full client in the future

## Install

Add the following dependency to your composer.json:

```js
{
    "require": {
        "chromabits/tutum-php": "dev-master"
    },
    "minimum-stability": "dev"
}
```

## Usage within a container:

Example for getting all the links of a container:

```php
require_once(__DIR__ . '/vendor/autoload.php');

use \Chromabits\TutumClient\ClientFactory;
use \Chromabits\TutumClient\Support\EnvUtils;

$client = (new ClientFactory())->makeFromEnvironment();
$env = new EnvUtils();

$response = $client->container->show($env->getContainerUuid());

$container = $response->get();

var_dump($container->findLinks('some-other-service'));
```

## Deploying a service:

It is possible to programatically deploy services in Tutum using PHP:

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Chromabits\TutumClient\Client;
use Chromabits\TutumClient\Requests\CreateServiceRequest;
use Chromabits\TutumClient\Entities\ContainerPort;

$client = new Client('someuser', 'vfjsblkdhbhkfhkajshkfj');

$nexusRequest = new CreateServiceRequest();

$nexusRequest->setName('nexus-staging');
$nexusRequest->setImage('eduard44/nexus:latest');
$nexusRequest->setTargetNumContainers(1);

$nexusRequest->addTag('staging');
$nexusRequest->addPort(new ContainerPort(80, ContainerPort::PROTO_TCP, 80, true));

$nexusRequest->setEnvironment('DB_DIALECT', 'mysql');
$nexusRequest->setEnvironment('DB_NAME', 'nexus');
$nexusRequest->setEnvironment('DB_USERNAME', 'nexus');
$nexusRequest->setEnvironment('DB_PASSWORD', 'suchSecretVarySafe');
$nexusRequest->setEnvironment('DB_HOST', 'some.host.hack');

$nexus = $client->service->create($nexusRequest)->get();

$client->service->start($nexus);
```

Other service actions are also supported:

```php
$client->service->stop($nexus);

$client->service->redeploy($nexus);

$client->service->terminate($nexus);
```

## Getting all services

The `service->index()` call lets you query current services on your Tutum account:

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Chromabits\TutumClient\Client;
use Chromabits\TutumClient\Entities\Service;

$client = new Client('someuser', 'vfjsblkdhbhkfhkajshkfj');

// Get all services
$response = $client->service->index();

// Get only services which have the state "Init"
$response = $client->service->index(Service::STATE_INIT);

// Get services by name
$response = $client->service->index(null, 'wordpress');
```