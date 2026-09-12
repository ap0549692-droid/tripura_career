<?php
putenv('CACHE_STORE=array');
putenv('CACHE_DRIVER=array');
putenv('SESSION_DRIVER=array');
putenv('QUEUE_CONNECTION=sync');
putenv('BROADCAST_CONNECTION=log');
putenv('FILESYSTEM_DISK=public');
$_ENV['CACHE_STORE']='array';
$_ENV['SESSION_DRIVER']='array';
require __DIR__ . '/../public/index.php';
