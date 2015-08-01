<?php

include __DIR__ . "/functions.php";

$oldUri = $_SERVER['REQUEST_URI'];
$newUri = convertUri($oldUri);
$userToken = getToken($oldUri, getallheaders());
$urlForAuthorizeUser = 'auth.procvic.cz/authorize?access_token=' . $userToken;

if (mustCheckTokenForUrl($oldUri)) {
	$userValidJson = readContentFromUrl($urlForAuthorizeUser);
	$isUserLogIn = isValidUser($userValidJson['data']);
	if (!$isUserLogIn) {
		renderAsJSON([
			'data' => '{"error":"Unauthorize request."}',
			'status-code' => 401,
		]);
		die;
	}
}

$content = readContentFromUrl($newUri);
renderAsJSON($content);
