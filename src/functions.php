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
	$outputUri .= '.services.procvic.cz/';
	$outputUri .= getEndOfPath($inputUri);
	return $outputUri;
}
