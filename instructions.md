# Instructions

I have created a command line app to show the string checking functionality working.

The project also includes automated unit, command and benchmarking tests which are worth checking out.

The latest test coverage report can be found in `tests/Reports`

## System Requirements

* Docker Compose
* Docker Desktop (recommended)

This project was built using the symfony-docker, instructions and full details can be found here https://github.com/dunglas/symfony-docker. My instructions will assume you are using docker desktop, but feel free to open the bash in your own terminal if thats your prefered way of accessing containers.

## Setting up the project

Firstly clone the github repo
> git clone git@github.com:TomButts/jadu-technical-test.git


In your terminal change directory so that you are in the jadu-technical-test project. If you ran git clone in the dir your terminal path is at, the command will be:
> cd jadu-technical-test/

The commands to launch the containers are described in the [symfony-docker](https://github.com/dunglas/symfony-docker) template repository. For more configuration options do visit and examine their `README.md`

> docker compose build --no-cache
> docker compose up --pull always -d --wait

You should now be able to see containers running in Docker Desktop named jadu-technical-test
Go to the php-1 container and open the exec tab

Optional: executing the following allows using up arrow to cycle command history
> /bin/bash

You should be in the `/app` directory at this point and http://localhost should show the fresh symfony install welcome page (after accepting certs are insecure in browser)

## Running the command

The console command name is ‘app:string-checker’

I recommend running the help command first to get information on all the arguments and how to use them
> php bin/console app:string-checker -h

### Examples

To check a palindrome you could run
> php bin/console app:string-checker palindrome anna

> php bin/console app:string-checker palindrome "an nan na"

To check an anagram
> php bin/console app:string-checker anagram "my anagram" "yam nam gar"

Use quotes around phrases you want to use as an argument as mentioned on -h display.

## Running Tests

To run the tests I would expect to go into the production pipelines:
> php bin/phpunit --exclude-group=benchmarks

I have left my benchmarking tests in for easier examination. I would usually take these out as they are unstable and not suitable for a pipeline, and also slow.

Execute the following to run the benchmark tests
> php bin/phpunit tests/Stress

The last coverage report does exist in `/app/tests/Reports` directory. You can view the index.html in a browser or html viewer of choice out of the box.

You can also re-run coverage yourself

First turn on xdebug - included out of box in symfony-docker
> export XDEBUG_MODE=coverage

Then run
> php bin/phpunit --exclude-group=benchmarks --coverage-html=tests/Reports

## Thought Process

You can see notes on my approach to the problem in the `time.md` file at the root of the project.