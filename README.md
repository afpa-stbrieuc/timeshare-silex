[![Stories in Ready](https://badge.waffle.io/afpa-stbrieuc/timeshare-silex.png?label=ready&title=Ready)](https://waffle.io/afpa-stbrieuc/timeshare-silex)

[![Build Status](https://travis-ci.org/afpa-stbrieuc/timeshare-silex.svg?branch=master)](https://travis-ci.org/afpa-stbrieuc/timeshare-silex)

#timeshare-silex

##pre-requisite
php >5.4, mongo driver installed and enabled in php.ini http://php.net/manual/fr/mongo.installation.php

##install

```shell
  cd timeshare-silex
  npm install #this will install the required Grunt dependencies
  bower install #will load all client libraries
  composer install -d app/api #to install php apps dependencies

  npm install grunt-cli # to get grunt installed
```

##development

```shell
  grunt serve # to get a local running web server
```

##build
```shell
  grunt
```

## test api
```shell
 cd app
 php -S localhost:8080 -t . api/app-dev.php
 ```

# API

## Advert (Annonce)
It is an advert posted on the site
All fields are required
* name ## string
* user # the user having created the advert ## object
* description ## string
* location ## string
* category ## string
* dateValiditeDebut ## datetime (format: Y-m-d H:i:s)
* dateValiditeFin ## datetime (format: Y-m-d H:i:s)
* demande ## boolean

API REST for Annonce
* All the adverts
	GET: /api/annonces
* One advert by id
	GET: /api/annonces/{id}
* Delete on advert by id
	DELETE: /api/annonces/{id}
* Add an advert
	POST: /api/annonces
* Edit one advert by id
	PUT: /api/{id}
* Advert by category and location
	GET: /api/annonces/{category}/{location}

## User (utilisateur)
It is a user registered on the site to post advert
All fields are required
* pseudo ## string 
* password ## string
* surname ## string
* firstname ## string
* town ## string
* timebalance ## int (auto)
* address ## string
* email ## string 

## Services
It is created when a user answer to an advert.
All fields are required.
* time # the time that will be gained by the user answering the advert
* note # given by the user posting the advert
* debiteur # the user reference object posting the advert
* crediteur # the user answering the advert and to be credited the time
* annonce # a reference to the advert which is answered to


