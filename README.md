# Banner Package

## Objective
This is a PHP package to manage banners. The code can be installed and accessed through a local code base. 
Optionally, this code can serve as the foundation upon which a microservice is built, making these calls available
through an API server. 

## Requirements
PHP version: This software was developed using PHP version 8.1.3. It has not been tested on previous version.

Composer: This package manager is required. It can be found at https://getcomposer.org/

PHPUnit: This package is used for all testing and can be found at https://phpunit.de/ It is set as a dependency in 
composer.json and so should not need to be downloaded manually. 

## Details

## Considerations
### Time zones
All dates and times are stored as unix timestamps which use the UTC time zone. In order to provide accurate results, 
the consumer of the service must specify their time zone of interest. Since code is often deployed to different 
geographical locations  and the consumer of the service may likewise be anywhere in the world, we do not rely on 
default time zones or make assumptions about the time zone of interest.

### IP Address
For method calls whose results depend upon IP Address, it is the responsibility of the caller to pass this in. 
We do not attempt to guess the IP Address of the caller for various reasons. 

## Tests

