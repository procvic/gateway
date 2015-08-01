<?php

include __DIR__ . '/../src/functions.php';

assert_options(ASSERT_ACTIVE, 1);

$headersInArray = [
	'Key' => 'value',
];
$requestUri = '/user/get-info/10';
assert(getToken($requestUri, $headersInArray) == '');

$headersInArray = [
	'Key' => 'value',
];
$requestUri = '/user/get-info/10?access_token=abc123';
assert(getToken($requestUri, $headersInArray) == 'abc123');

$headersInArray = [
	'Access_token' => 'abcd12345',
];
$requestUri = '/user/get-info/10?access_token=abc123';
assert(getToken($requestUri, $headersInArray) == 'abc123');

$headersInArray = [
	'Access_token' => 'abcd12345',
];
$requestUri = '/user/get-info/10';
assert(getToken($requestUri, $headersInArray) == 'abcd12345');
