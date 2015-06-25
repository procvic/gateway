<?php

include __DIR__ . '/../src/functions.php';

assert_options(ASSERT_ACTIVE, 1);

assert(isValidUser('{"is-authorize":true}') === true);
assert(isValidUser('{"is-authorize":false}') === false);
