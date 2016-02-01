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
```

##development

```shell
  grunt serve
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

