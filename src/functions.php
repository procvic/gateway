<?php

function getServiceNameFromUri($uri)
{
	preg_match('/^\/([a-z]+)\/.*/', $uri, $match);
	return $match[1];
}
