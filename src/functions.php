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


function getToken($requestUri, $headersInArray)
{
	if (getTokenFromUri($requestUri) != '') {
		return getTokenFromUri($requestUri);
	}
	return getTokenFromHeaders($headersInArray);
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


function getTokenFromHeaders($headersInArray)
{
	if (!isset($headersInArray['Access_token'])) {
		return '';
	}
	return $headersInArray['Access_token'];
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
	if (getServiceNameFromUri($inputUri) == 'users' && getEndOfPath($inputUri) == 'add/') {
		return false;
	}
	return true;
}


/**
 * @internal this function has only an integration test
 */
function renderAsJSON($data)
{
	header("Content-Type: text/javascript");
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	http_response_code($data['status-code']);
	echo $data['data'];
}


/**
 * @internal this function has only an integration test
 */
function readContentFromUrl($sourceURL)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $sourceURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$dataFromRequest = readDataFromRequest();
	if (!empty($dataFromRequest)) {
		curl_setopt($ch, CURLOPT_POST, count($dataFromRequest));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataFromRequest));
	}
	$data = curl_exec($ch);
	$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return [
		'data' => (string) $data,
		'status-code' => $statusCode,
	];
}


/**
 * @internal this function has only an integration test
 */
function readDataFromRequest()
{
	$dataInString = file_get_contents('php://input');
	if (empty($dataInString)) {
		return [];
	} else if (isJson($dataInString)) {
		return json_decode($dataInString);
	} else {
		parse_str($dataInString, $data);
		return $data;
	}
}


function isJson($dataInString)
{
	if (json_decode($dataInString) === NULL) {
		return FALSE;
	}
	return TRUE;
}
