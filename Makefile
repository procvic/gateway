tests: test-unit test-integration


test-unit:
	php -f test/unit/functions.php
	php -f test/unit/isValidUser.php
	php -f test/unit/getToken.php
	php -f test/unit/getTokenFromUri.php
	php -f test/unit/getTokenFromHeaders.php
	php -f test/unit/mustCheckTokenForUrl.php


test-integration:
	php -f test/integration/authorizeRequest.php
	php -f test/integration/redirectRequest.php
