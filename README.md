# NYPL Mail Listener

This package is intended to be used as a Lambda-based Node.js/PHP Listener to listen to a Kinesis Stream. 

It uses the 
[NYPL PHP Microservice Starter](https://github.com/NYPL/php-microservice-starter).

This package adheres to [PSR-1](http://www.php-fig.org/psr/psr-1/), 
[PSR-2](http://www.php-fig.org/psr/psr-2/), and [PSR-4](http://www.php-fig.org/psr/psr-4/) 
(using the [Composer](https://getcomposer.org/) autoloader).

## Requirements

* Node.js 6.10.2
* PHP >=7.0 

Homebrew is highly recommended for PHP:
  * `brew install php71`  

## Installation

1. Clone the repo.
2. Install required dependencies.
   * Run `npm install` to install Node.js packages.
   * Run `composer install` to install PHP packages.
3. Setup local [configuration](#configuration) file.
   * Copy `config/local.env.sample` to `config/local.env` and update any necessary values using `config/development.env` as an example.
     * _Note: Values should be unencrypted._

## Configuration

Various files are used to configure and deploy the Lambda.

### .env

`.env` is used by `node-lambda` for deploying to and configuring Lambda in *all* environments. 

You should use this file to configure the common settings for the Lambda (e.g. timeout, Node version). 

### package.json

Configures `npm run` commands for each environment for deployment and testing. Deployment commands may also set the proper AWS Lambda VPC, security group, and role.
 
~~~~
"scripts": {
    "deploy-development": ...
    "deploy-qa": ...
    "deploy-production": ...
},
~~~~

### config/global.env

Configures (non-secret) environment variables common to *all* environments.

### config/*environment*.env

Configures environment variables specific to each environment.

### config/event_sources_*environment*.json

Configures Lambda event sources (triggers) specific to each environment.

Secrets *MUST* be encrypted using KMS.

## Usage

### Process a Lambda Event

To use `node-lambda` to process the sample event(s), run:

~~~~
npm run test-send-email
~~~~

## Deployment

Travis CI is configured to run our build and deployment process on AWS.

Our Travis CI/CD pipeline will execute the following steps for each deployment trigger:

* Run unit test coverage
* Build Lambda deployment packages
* Execute the `deploy` hook only for `development`, `qa` and `master` branches to adhere to our `node-lambda` deployment process
* Developers _do not_ need to manually deploy the application unless an error occurred via Travis
