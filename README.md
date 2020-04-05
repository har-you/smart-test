# Steps to follow to run project

## clone the project

    $ git clone https://github.com/har-you/smart-test.git


## install dependencies

    $ composer install


## create the database

 `$ php bin/console doctrine:schema:create:database`
 

## update schema with doctrine migrations bundle
`php bin/console doctrine bin/console doctrine:migrations:migrate
`
## API

###Create Question
`
   POST http://{host}/create`

### Update Question
`PUT http://{host}/edit/{id}`