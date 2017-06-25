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
    Plugin::load('Cakeenv');
    Cakeenv\Environment::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}
~~~

### 2/ Create directory for containing each environment's `app.php`

NOTE: name of each environment directory can be set to anything you want.

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
