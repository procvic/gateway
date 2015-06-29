test-unit:
	php -f test/functions.php
	php -f test/isValidUser.php
	php -f test/getTokenFromUri.php
	php -f test/mustCheckTokenForUrl.php
