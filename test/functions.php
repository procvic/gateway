<?php

include __DIR__ . '/../src/functions.php';

assert_options(ASSERT_ACTIVE, 1);

assert(getServiceNameFromUri('/categories/subjects') === 'categories');
assert(getServiceNameFromUri('/user/get-info/10') === 'user');

assert(getEndOfPath('/categories/subjects') === 'subjects');
assert(getEndOfPath('/user/get-info/10') === 'get-info/10');

assert(convertUri('/auth/token') === 'http://auth.procvic.cz/token');
assert(convertUri('/categories/subjects') === 'http://categories.services.procvic.cz/subjects');
assert(convertUri('/user/get-info/10') === 'http://user.services.procvic.cz/get-info/10');

assert(!isJson('test data in string'));
assert(isJson('{"key": "value"}'));
