<?php

include __DIR__ . '/../src/functions.php';

assert_options(ASSERT_ACTIVE, 1);

assert(getTokenFromUri('/user/get-info/10') == '');
assert(getTokenFromUri('/user/get-info/10?access_token=abc123') == 'abc123');
assert(getTokenFromUri('/user/get-info/10?access_token=1234567890asdfghjkl') == '1234567890asdfghjkl');
