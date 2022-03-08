# Banner Package

## Objective
This is a PHP package to manage banners. The code can be installed and accessed through a local code base. 
Optionally, this code can serve as the foundation upon which a microservice is built, making these calls available
through an API server. 

## Requirements
- PHP version: This software was developed using PHP version 8.1.3. It has not been tested on previous version.
- Composer: This package manager is required. It can be found at https://getcomposer.org/
- PHPUnit: This package is used for all testing and can be found at https://phpunit.de/ It is set as a dependency in 
composer.json and so should not need to be downloaded manually. 

## Details
A simple package has been built around the following classes. (Details can be seen in the PHPDoc.)
- Banner: Used to define a banner.
- BannerManager: The entry point for all external calls.
- DAO: Interface for reading and writing Banner objects and (optionally) persisting to a data store.


## Tests
Testing of major functionality is included at /tests/BannerTest.php and can be run from the command line as:

`php vendor/bin/phpunit tests/BannerTest.php`

## Considerations
### Weight
Each banner has a weight value, indicating the relative frequency with which it will be returned. 
The current implementation requires a weighting of precision 1 where 0 < precision <= 1. This gives a display 
ratio of 10:1 which seems adequate. If greater variation or granularity is required, the code must be 
updated accordingly.

### Time Zones
All dates and times are stored as unix timestamps which use the UTC time zone. In order to provide accurate results, 
the consumer of the service must convert the unix timestamp to their time zone of interest. Since code is often 
deployed to different geographical locations  and the consumer of the service may likewise be anywhere in the world, 
we do not rely on default time zones or make assumptions about the time zone of interest.

### IP Address
For method calls whose results depend upon IP Address, it is the responsibility of the **caller** to pass this in. 
We do not attempt to guess the IP Address of the caller for various reasons. Though a web application using this code
may want to capture the IP address of the client.

### Uniqueness
Banner names are required to be unique and as such, act as a primary key. Ideally, a UID would be used instead.

### Data Persistence
The current implementation does not persist data. In order to do so, an object implementing the DAO interface should be
created with calls to a data store or caching mechanism. 

### Data Validation
All public methods include some validation of arguments but may require further scrutiny.

