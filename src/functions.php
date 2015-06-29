<?php

function getServiceNameFromUri($uri)
{
	preg_match('/^\/([a-z]+)\/.*/', $uri, $match);
	return $match[1];
}


function getEndOfPath($uri)
{
	preg_match('/^\/[a-z]+\/(.*)/', $uri, $match);
	return $match[1];
}


function convertUri($inputUri)
{
	$outputUri = 'http://';
	$outputUri .= getServiceNameFromUri($inputUri);
	if (getServiceNameFromUri($inputUri) != 'auth') {
		$outputUri .= '.services';
	}
	$outputUri .= '.procvic.cz/';
	$outputUri .= getEndOfPath($inputUri);
	return $outputUri;
}


function getTokenFromUri($inputUri)
{
	$search = '?access_token=';
	$accessTokenPosition = strpos($inputUri, $search);
	if ($accessTokenPosition === false) {
		return '';
	}
	$accessToken = substr($inputUri, $accessTokenPosition+strlen($search));
	return $accessToken;
}


function isValidUser($jsonInString)
{
	if ($jsonInString == '{"is-authorize":true}') {
		return true;
	}
	return false;
}


function mustCheckTokenForUrl($inputUri)
{
	if (getServiceNameFromUri($inputUri) == 'auth') {
		return false;
	}
	return true;
}


/**
 * @todo missing test
 */
function renderAsJSON($jsonInString)
{
	header("Content-Type: text/javascript");
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	echo $jsonInString;
}


/**
 * @todo missing test
 */
function readContentFromUrl($sourceURL)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $sourceURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	if (!empty($_POST)) {
		curl_setopt($ch, CURLOPT_POST, count($_POST));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
	}
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
