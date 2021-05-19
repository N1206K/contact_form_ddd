<?php
require_once('app/dispatcher.php');

// アプリのルート
const ROOT = __DIR__ . '/';

$dispatcher = new Dispatcher(include_once('app/routes.php'));

try {
    $dispatcher->dispatch();
} catch (InvalidArgumentException $e) {
    echo "404, Page Not Found\n";
    echo $e;
} catch (Exception $e) {
    echo "500, Internal Server Error\n";
    echo $e;
}
