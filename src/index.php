<?php

include __DIR__ . "/functions.php";

$oldUri = $_SERVER['REQUEST_URI'];
$newUri = convertUri($oldUri);
$userToken = getTokenFromUri($oldUri);
$urlForAuthorizeUser = 'auth.procvic.cz/lockdin/check-authorize?access_token=' . $userToken;

if (mustCheckTokenForUrl($oldUri)) {
	$userValidJson = (string) readContentFromUrl($urlForAuthorizeUser);
	$isUserLogIn = isValidUser($userValidJson);
	if (!$isUserLogIn) {
		renderAsJSON('{"error":"Unauthorize request."}');
		die;
	}
}

$content = (string) readContentFromUrl($newUri);
renderAsJSON($content);
