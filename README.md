# Tutum PHP

A partial PHP wrapper of the Tutum API

---

## About

This is a simple library for querying and discovering container links in Tutum
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
