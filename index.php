<?php

require_once './config.php';

$request = key($_GET);

if (!isset($links[$request]))
    die('Seite nicht gefunden.');

$stats = json_decode(file_get_contents('log.json'));

if (isset($stats->$request))
    $stats->$request->clicks++;
else
    $stats->$request->clicks = 1;
$stats->$request->lastClicked = time();

$handle = fopen('log.json', 'w+');
fwrite($handle, json_encode($stats));
fclose($handle);

header('Location: ' . $links[$request]);
