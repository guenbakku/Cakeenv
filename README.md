# Cakeenv

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require guenbakku/cakeenv
```

## Usage

### 1/ Load plugin into CakePHP

Open and modify file `config/bootstrap.php` like following:

Before:

~~~ php
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}
~~~

After:

~~~ php
try {
    Configure::config('default', new PhpConfig());
    Plugin::load('Guenbakku/Cakeenv', ['bootstrap' => false, 'routes' => false]);
    Guenbakku\Cakeenv\Environment::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}
~~~

### 2/ Create directory for containing each environment's `app.php`

> Note:  
> Name of each environment directory can be set to anything you want.

~~~
config
    |--- environments
        |--- development
            |--- app.php
        |--- production
            |--- app.php
        |--- stagging
            |--- app.php
        |--- env
~~~

### 3/ Switch to environment you want

Open file `config/environments/env`, set environment name you want in the first line and save it. That's all.

Example:

~~~
development
~~~ 

## Development

> Note:  
> Following is the memo for developing this plugin.
> End-user can skip this section.

```bash
# 1. Build docker image for developing (first time only)
$ docker-compose build  

# 2. Composer installing (first time only)
$ docker-compose run --rm php composer install

# 3. Execute phpunit
$ docker-compose run --rm php vendor/bin/phpunit