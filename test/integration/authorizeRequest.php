<?php

// This test check authorize request

assert_options(ASSERT_ACTIVE, 1);

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://gateway.procvic.cz/users/me?access_token=bad-token'
]);
$resp = curl_exec($curl);
assert(curl_getinfo($curl, CURLINFO_HTTP_CODE) == 401);
curl_close($curl);

assert($resp == '{"error":"Unauthorize request."}');
