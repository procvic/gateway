# Functions of service


## 1. Detect and redirect requests
- input URL `http://gateway.procvic.cz/name-of-service/path?param=123`
- redirect to `http://name-of-service.services.procvic.cz/path?param=123`
- all GET and POST data are forward
- HTTP status code is forward too


## 2. Authentization users for step 1.
- a request contain access token
	- a GET parameter in URL `URL/?access_token=secret`
	- or in the headers (Access_token: secret)
- the access_token is validate in **auth microservice**
- step 1. is execute only if is the access_token valid
- exception: all reguests for microservice auth are not validate
