<?php

include __DIR__ . "/functions.php";

$oldUri = $_SERVER['REQUEST_URI'];
$newUri = convertUri($oldUri);
$content = (string) readContentFromUrl($newUri);
renderAsJSON($content);
