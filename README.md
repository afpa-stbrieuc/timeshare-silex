#timeshare-silex

[![Build Status](https://travis-ci.org/afpa-stbrieuc/timeshare-silex.svg?branch=master)](https://travis-ci.org/afpa-stbrieuc/timeshare-silex)

##pre-requisite
php >5.4, mongo driver and enabled in php.ini http://php.net/manual/fr/mongo.installation.php

##install

```shell
  npm install
  bower install
  composer install -d app/api
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
`php -S localhost:8080 -t . api/app-dev.php`

