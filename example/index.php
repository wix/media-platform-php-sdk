<?php

require_once("vendor/autoload.php");
require_once("WixDemo.php");

$mediaPlatform = new Wix\Mediaplatform\MediaPlatform(
    "wixmp-410a67650b2f46baa5d003c6.appspot.com",
    "48fa9aa3e9d342a3a33e66af08cd7fe3",
    "fad475d88786ab720b04f059ac674b0e"
);

$mediaPlatform = new Wix\Mediaplatform\MediaPlatform(
    "wixmp-25bdf5f65589f47f02e7e962.appspot.com",
    "b9cbd75c35264b329559be9abf5d2251",
    "241261212058a2ed1f0427494505374a"
);

$demo = new WixDemo($mediaPlatform);

$command = !empty($argv[1]) ? $argv[1] : null;

if($command && $command != "help" && ( method_exists($demo, $command) || $command == 'all')) {
    if($command == 'all') {
        foreach(get_class_methods(get_class($demo)) as $method) {
            if($method != "__construct") {
                $demo->$method();
            }
        }
    } else {
        $demo->$command();
    }
} else {
    echo "Method not found. List of valid methods:" . PHP_EOL;
    echo "all" . PHP_EOL;
    echo "help" . PHP_EOL;
    foreach(get_class_methods(get_class($demo)) as $method) {
        if($method != "__construct") {
            echo $method . PHP_EOL;
        }
    }
}
