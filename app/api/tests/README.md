#Documentation Manual tests
------------------

##run server
make sure that you've downloaded all required libs: (`composer install -d api` from app directory )
`php -S localhost:8080 -t public api/app-dev.php`


##User api tests:
###get list of users
`curl --GET http://localhost:8080/api/user/`

###get user by id `56975e3079135746910dbc8a`
`curl --GET http://localhost:8080/api/user/56975e3079135746910dbc8a`

###delete user with id `56979c4f5c47938e1b8b4571`
`curl -XDELETE http://localhost:8080/api/user/56979c4f5c47938e1b8b4571`

###create user
`curl -H "Content-Type: application/json" -X POST -d '{"surname" : "A3","firstname" : "B3","town" : "C3","timebalance" : 200}' http://localhost:8080/api/user/`

###update user `56979c4f5c47938e1b8b4571`
`curl -H "Content-Type: application/json" -X POST -d '{"surname" : "A3333","firstname" : "B3","town" : "C3","timebalance" : 200}' http://localhost:8080/api/user/56979c4f5c47938e1b8b4571`
