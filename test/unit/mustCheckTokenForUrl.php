<?php

include __DIR__ . '/../../src/functions.php';

assert_options(ASSERT_ACTIVE, 1);

assert(mustCheckTokenForUrl('/auth/token/') === false);
assert(mustCheckTokenForUrl('/categories/token/') === true);
