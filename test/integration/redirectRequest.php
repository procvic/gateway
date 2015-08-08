<?php

// This test check redirect request to service
// and this request is not authorize in gateway

assert_options(ASSERT_ACTIVE, 1);

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://gateway.procvic.cz/auth/authorize?access_token=bad-token'
]);
$resp = curl_exec($curl);
assert(curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200);
curl_close($curl);

assert($resp == '{"is-authorize":false}');
