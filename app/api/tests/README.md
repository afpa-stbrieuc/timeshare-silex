Documentation test
------------------

webservices Branch user tests:
GET
curl --GET http://localhost:8080/api/user/

GET by id
curl --GET http://localhost:8080/api/user/56975e3079135746910dbc8a

DELETE by id
curl -XDELETE http://localhost:8080/api/user/56979c4f5c47938e1b8b4571

POST
curl -H "Content-Type: application/json" -X POST -d '{"surname" : "A3","firstname" : "B3","town" : "C3","timebalance" : 200}' http://localhost:8080/api/user/

PUT
curl -H "Content-Type: application/json" -X POST -d '{"surname" : "A3333","firstname" : "B3","town" : "C3","timebalance" : 200}' http://localhost:8080/api/user/56979c4f5c47938e1b8b4571
