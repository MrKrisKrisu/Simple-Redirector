<?php

require_once './config.php';

$request = key($_GET);

if ($request == '') {
    $data = explode('/', $_SERVER['REQUEST_URI']);
    $data = array_reverse($data);
    $request = $data[0] == '' ? $data[1] : $data[0];
}

if (!isset($links[$request])) {
    header('Location: ' . $redirectUri);
    die();
}

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
