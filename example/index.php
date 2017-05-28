<?php

require_once("vendor/autoload.php");

$mediaPlatformClient = new Wix\Mediaplatform\MediaPlatform(
    "wixmp-48ebb26d76afb87830f1fcb2.appspot.com",
    "eb137171f9244fe5a1bbdbcc49183c16",
    "5b08fc2715efc16da1719d2da5f4bffa"
);

/*$uploadUrlRequest = new Wix\Mediaplatform\Model\Request\UploadUrlRequest();
$uploadUrlRequest->setPath("/leon/test.mp4");
$uploadUrlRequest->setMimeType("video/mp4");

$uploadUrlResponse = $mediaPlatformClient->fileManager()->getUploadUrl($uploadUrlRequest);*/

$fileUploadResponse = $mediaPlatformClient->fileManager()->uploadFile(
    "/leon/test1.mp4",
        'video/mp4',
    'test1.mp4',
    fopen('/var/www/remoteclip_0_attxhexj_1409086235_2.mp4', 'r')
    );

var_dump($uploadUrlResponse);
