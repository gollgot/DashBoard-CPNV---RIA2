# DashBoard-CPNV
The DashBoard-CPNV is a single web page created with Slim php contains a dashboard which shows some figures about the CPNV school.
All figures will be get from social network APIs, etc.

# Table of Contents
1. [Getting started](#getting-started)

    1.1 [Prerequisites](#prerequisites)

    1.2 [Composer](#composer)

    1.3 [Installation](#installation)

    1.4 [Run the project](#run-the-project)

2. [Project structure](#project-structure)

    2.1 [App](#app)
    
    2.2 [Public](#public)
    
3. [Configuration](#configuration)
    
    3.1 [App parameters](#app-parameters)
    
    3.2 [dev/prod mode](#dev/prod-mode)
    
4. [Libraries used](#libraries-used)

    4.1 [Slim](#slim)
    
    4.2 [Twig-view](#twig-view)
    
    4.3 [Graph-sdk by Facebook](#graph-sdk-by-facebook)
    
    4.4 [Yaml by Symfony](#yaml-by-symfony)
    
    4.5 [Twitteroauth](#twitteroauth)

## Getting started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites 
 - php >= 7.0
 - php_curl extension enable
 - composer
 
### Composer
*Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and
it will manage (install/update) them for you.*

If you don't have composer installed, execute the following commands to do so :

``` php
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

More info about the installation [here](https://getcomposer.org/download/).

### Installation
1. First of all you need to clone the project on your local machine. You can either [download](https://github.com/gollgot/DashBoard-CPNV-RIA2/archive/master.zip) the zip or use the git commands.
`$ git clone https://github.com/gollgot/DashBoard-CPNV-RIA2.git`.

2. Now you need to install all the dependencies of the project. So you have to be in the dashboard-project/src folder and run this command :
`$ composer install`.

3. Set up the configuration file with your api credentials, follow the instructions [here](#app-parameters).

So there, now you're up and running and you can start messing arround with the project.

### Run the project
Now the installation is finished, you can access to the application with this url : `yourWebServer/dashboard-project/src/public/index.php/`

*Don't forget to type the last "/" after the index.php !*

## Project structure
- /src
  - app
    - config
    - controllers
    - routes
    - views
  - public
    - css
    - img
    - js
  - vendor
  
### app
This folder contains all controllers, routes, views and also the configuration.

There is also a file in this folder called "container.php", this is a dependency container to prepare, manage, and inject application dependencies, more info about that [here](https://www.slimframework.com/docs/v3/concepts/di.html).

### public
This folder contains all public files like the css, js and images.

There is also the index.php file, this is the entry point of the web application.

## Configuration

### App parameters
You can find all the app parameters in the file : `dashboard-project/src/app/config/parameters.yml`.

This file must be private because it will contains all your api credentials, so don't push it in your repository !

You can find a structure example called `parameters.yml.dist`, copy it and rename as `parameters.yml` and fill it to complete your configuration.

*I already put a real parameters.yml with real credentials, this is temporary and it will be deleted after my project time development*

### dev/prod mode

The project is in development mode, it means that the application will displays all the errors. You can easily pass the app in production mode :

Open the file : `dashboard-project/src/public/index.php` and set the "displayErrorDetails" key to false.

Example  here :
``` php
$app = new \Slim\App([
    "settings" => [
        "displayErrorDetails" => false
    ]
]);
```

## Libraries used

### Slim
This is the slim framework php I used to create the web application.

Official web site : [here](https://www.slimframework.com/)

### Twig-view
This is a Slim Framework view helper built on top of the Twig templating component.

Github url : [here](https://github.com/slimphp/Twig-View)

### Graph-sdk by Facebook
This is the open source PHP SDK that allows you to access the Facebook Platform from your PHP app.

Github url : [here](https://github.com/facebook/php-graph-sdk)

### Yaml by Symfony
This is a Symfony component that allow us to parses YAML strings to convert them to PHP arrays. It is also able to convert PHP arrays to YAML strings.

*Symfony component can be used outside a Symfony app*

Github url : [here](https://github.com/symfony/yaml)

### Twitteroauth
This is a really popular PHP library for Twitter's OAuth REST API.

Official web site : [here](https://twitteroauth.com/)

Github url : [here](https://github.com/abraham/twitteroauth)
