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
All field are required
* name ## string
* user # the user having created the advert ## object
* description ## string
* location ## string
* category ## string
* dateValiditeDebut ## datetime (format: Y-m-d H:i:s)
* dateValiditeFin ## datetime (format: Y-m-d H:i:s)
* demande ## boolean

## User (utilisateur)
All field are required
* pseudo ## string 
* password ## string
* surname ## string
* firstname ## string
* town ## string
* timebalance ## int (auto)
* address ## string
* email ## string 



