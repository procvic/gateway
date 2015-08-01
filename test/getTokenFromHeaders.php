<?php

include __DIR__ . '/../src/functions.php';

assert_options(ASSERT_ACTIVE, 1);

$headersInArray = [
	'Key' => 'value',
];
assert(getTokenFromHeaders($headersInArray) == '');

$headersInArray = [
	'Access_token' => 'abcd12345',
];
assert(getTokenFromHeaders($headersInArray) == 'abcd12345');
