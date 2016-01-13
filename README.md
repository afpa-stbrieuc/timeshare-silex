#timeshare-silex

##pre-requisite
php >5.4, mongo driver and enabled in php.ini http://php.net/manual/fr/mongo.installation.php

##install

```shell
  git clone https://github.com/afpa-stbrieuc/silex-angular-bootstrap
  cd silex-angular-bootstrap
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

