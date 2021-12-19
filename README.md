# ![Laravel Circle Link Test](logo.png)



----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.0/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@github.com:kombolewis/circle-link-test.git

Switch to the repo folder

    cd circle-link-test

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeder 

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000. --  default login: admin@admin.com/password

**TL;DR command list**

    git clone git@github.com:kombolewis/circle-link-test.git
    cd circle-link-test
    composer install
    cp .env.example .env
    php artisan key:generate
 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan db:seed
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, patients, roles, bpobservations,  This can help you to quickly start testing the application.**

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

## Application testing

**The application utilizes laravel dusk and phpunit for its testsuite**

Run the following commands

    php artisan dusk
    vendor/bin/phpunit

----------
