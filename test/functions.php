<?php

include __DIR__ . '/../src/functions.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

assert(getServiceNameFromUri('/categories/subjects') === 'categories');
assert(getServiceNameFromUri('/user/get-info/10') === 'user');
