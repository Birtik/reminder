# Reminder - example application with aws-bundle

## Description
This very small project is some kind of idea to use an aws-bundle.
First of all - the application is focus to monitoring activity of every day. 

Application allow to get data for all status of actual day for every activity. Also, we can change a single status of activity. 
The main functionality of aws-bundle is used in command logic.
- Application (for example ofc) should execute the Command every day on 11:59PM
- Command will send a message into SQS
- Prepared consumer (for concrete action of this message) will determine a status of day based on all activities and update this value into DynamoDb. 

Another features:
- Application configured to receive content of provided textFile. #S3
- Application by app:compare command try to provide useful of index. 

## First Steps
Setup and start application in dev mode
```shell script
docker-compose build
```

```shell script
docker-compose run --rm app composer install
docker-compose up
```

## Schema
```shell script
docker-compose exec app php bin/console d:s:u --force
```

## Data
```shell script
docker-compose exec app php bin/console d:m:m
```
