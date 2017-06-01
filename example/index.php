<?php

require_once("vendor/autoload.php");
require_once("WixDemo.php");

$mediaPlatform = new Wix\Mediaplatform\MediaPlatform(
    "wixmp-410a67650b2f46baa5d003c6.appspot.com",
    "48fa9aa3e9d342a3a33e66af08cd7fe3",
    "fad475d88786ab720b04f059ac674b0e"
);

$demo = new WixDemo($mediaPlatform);

$demo->importFile();

$demo->uploadImage();

$demo->listJobs();

$demo->extractArchive();
