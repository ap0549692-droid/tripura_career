<?php
putenv('CACHE_STORE=array');
putenv('CACHE_DRIVER=array');
putenv('SESSION_DRIVER=array');
putenv('SESSION_STORE=array');
putenv('QUEUE_CONNECTION=sync');
putenv('BROADCAST_CONNECTION=log');
putenv('FILESYSTEM_DISK=public');

$_ENV['CACHE_STORE'] = 'array';
$_ENV['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array';
$_ENV['QUEUE_CONNECTION'] = 'sync';

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
return $app->handleRequest(Illuminate\Http\Request::capture());
