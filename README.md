# Kayne West quotes

## Description

The Rest API service fetches Kayne West quotes from (https://kanye.rest/) and shows 5 random 


## Installation and Setup

To install and setup the project please follow the further steps:

```bash

git clone git@github.com:{user}/laravel_kanye.git ./

composer install

./vendor/bin/sail up -d
```


After the environment is built up migrate the database:

```bash
./vendor/bin/sail artisan migrate
```

Fetch quotes and import into the database:

all:

```bash
./vendor/bin/sail artisan app:quote
```

partial:

```bash
./vendor/bin/sail artisan app:quote --count={integer}
```

Add predefined API Token to .env:

```bash
API_TOKEN={token}
```

## Read Kayne West 5 random quotes

Visit your browser and fetch quotes:

```bash
http://localhost/api/quotes?api_token={token}
```
or in cli:
```bash
curl http://localhost/api/quotes?api_token=1234567
```

You will then see 5 random quotes, which will contain new quotes randomly every time you update

For Example:
```angular2html
{
    "data": [
        {
            "quote": "I'll say things that are serious and put them in a joke form so people can enjoy them. We laugh to keep from crying."
        },
        {
            "quote": "I'm the best"
        },
        {
            "quote": "I need an army of angels to cover me while I pull this sword out of the stone"
        },
        {
            "quote": "Speak God's truth to power"
        },
        {
            "quote": "So many of us need so much less than we have especially when so many of us are in need"
        }
    ]
}
```


## Testing

Execute the following command:

```bash
./vendor/bin/sail artisan test
```


## Methodology

### kanye.rest API service

Upon examining the kanye.rest API, it was discovered that it returns a single quotation in JSON format.
Accessing the API involves a simple GET request to the endpoint https://api.kanye.rest. 
The response from the API adheres to the following structure:

```json
{
    "quote": "I need an army of angels to cover me while I pull this sword out of the stone"
}
```

The task at hand is to develop a basic quote API that provides Kanye West quotes.
This API should randomly retrieve 5 quotes, with the capability to refresh and obtain 5 more random quotes.

Initially, this presents a challenge as the kanye.rest service only furnishes one quote per request.

To address this issue, I propose implementing a command that can be executed during application setup to populate 
a database with quotes fetched from the kanye.rest API. This approach enables the API to furnish 5 random quotes. 
Additionally, the command can be scheduled to run at regular intervals, ensuring the database remains updated with new quotes.

The API must also facilitate the refreshment of the 5 randomly retrieved quotes, which is essentially 
the purpose of the endpoint for fetching quotes and thus will be treated as the refresh function.

To optimize the retrieval process, caching is permitted in this task. Therefore, I intend to utilize caching to store 
the quotes retrieved from the database, enhancing the speed of quote retrieval.

### Authentication

The task needs securing the API with authentication, without using a pre-existing packages.

To achieve this, the API will be safeguarded using a straightforward API token.

I will incorporate an API_TOKEN entry in the env file, which will be utilized in the authentication configuration file.

A Middleware will be implemented to verify the API token for each request made to the API. 
This Middleware will authenticate the token against the configuration and permit the request to proceed if the token is valid. 
Otherwise, a 401 response will be issued, indicating unauthorized access.

### API Client

As per the task requirements, the utilization of Laravel's Manager Pattern is encouraged. 
Hence, I will employ this pattern while developing the API Client. This approach will facilitate 
the extensibility of the API Client, enabling seamless integration with other APIs in the future.
