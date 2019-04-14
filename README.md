# Wix Media Platform

[![Build Status][travis-image]][travis-url]

[Wix Media Platform][wixmp-url] is an end-to-end solution for all modern web media management, handling images, video and audio in the most efficient way on the market. From upload, storage, metadata management and all the way to delivery, Wix Media Platform takes care of all possible media workflows.


# PHP SDK

This artifact is a PHP library, compatible with PHP 5.6+ and PHP 7.

## Additional Platforms

The respective JavaScript (for the Browser and Node.js) package can be found [here.][npm-url]

The respective Java package can be found [here.][java-url]

## Requirements

PHP 5.6 and later.

[Guzzle HTTP Client](http://docs.guzzlephp.org/en/latest/overview.html#installation)

[PHP CURL Extension](http://php.net/manual/en/book.curl.php)

[PHP JSON Extension](http://php.net/manual/en/book.json.php)

[PHP MBString Extension](http://php.net/manual/en/book.mbstring.php)

[Firebase PHP JWT (JSON Web Tokens)](https://github.com/firebase/php-jwt)

## Installation
### Composer

To install the bindings via [Composer](http://getcomposer.org/) run the following command
```bash
composer require wix/media-platform-php-sdk
```

Or add the following to `composer.json`:

```
{
  "require": {
    "wix/media-platform-php-sdk": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/sdk/media-platform-php-sdk/autoload.php');
```

## Instantiating the Media Platform

First, if you haven't done so yet, register at [Wix Media Platform][wixmp-url], create your [organization, project][org-and-project-start] and [application][application-start].

```php
    $mediaPlatform = new \Wix\Mediaplatform\MediaPlatform(
    "<project host as appears in the application page>",
    "<application id as appears in the application page>",
    "<shared secret as appears in the application page>"
);
```

## File Upload
[File Upload API Documentation](https://support.wixmp.com/en/article/file-management#upload-file)

```php
$file = fopen("...path to file...", "r");
$files = $mediaPlatform->fileManager()->uploadFile("/destination_path/file_name.ext", "mime_type", "file_name.ext", file, "private||public");
```

### Get Upload URL

Generates a signed URL and token, required for uploading from the browser

```php
$getUploadUrlResponse = $mediaPlatform->fileManager()->getUploadUrl();
```

## File Import
[File Import API documentation](https://support.wixmp.com/en/article/file-import)

```php
$importFileRequest = new \Wix\Mediaplatform\Model\Request\ImportFileRequest();

$destination = new \Wix\Mediaplatform\Model\Job\Destination();
$destination->setPath("/to/file.ext")
              ->setAcl("private||public")
              
$importFileRequest->setSourceUrl("from URL")
                    ->setDestination($destination);
        
$job = $mediaPlatform->fileManager()->importFile($importFileRequest);
```

## Download a Secure File
[File Download API documentation](https://support.wixmp.com/en/article/file-download)

File access can be restricted by setting the acl to 'private'. In order to access these files, a secure URL must be generated:

```php
$signedUrl = $mediaPlatform->fileDownloader()->getDownloadUrl("path/to/file.ext");
```

## Jobs

The [Jobs API][jobs-api] forms the basis for all long running asynchronous operations in the platform.

### Job Lifecycle

A job is created by a service that performs a long running operation, such as video transcode or file import.

1. When a job is created, it is queued for execution, and its status is initially set to 'pending'.
2. Once the job execution commences, the job status is updated to 'working'.
3. On job completion, the job status is updated to either 'success' or 'error', and the 'result' property is populated (prior to the job's completion, the 'result' field is null).

### Get Job

```php
$job = $mediaPlatform->jobManager()->getJob("job id");
```

### Get Job Group

```php
$jobGroup = $mediaPlatform->jobManager()->getJobGroup("job group id");
```

## Image Consumption

The SDK provides a programmatic facility to generate image URLs

```php
$image = new \Wix\Mediaplatform\Image\Image($fileDescriptor);
$image->setHost("images service host");
$image->crop($width, $height, $x, $y, $scale);

$url = $image->toUrl(); 
```

## Image Watermark Manifest Creation

It's possible to create a watermark manifest, and later apply it in any image manipulation url.
Adding a watermark manifest to secured (private) files will make these files available publicly via the image API, only after the watermark manifest is created for the specific image, and only if the wm_{manifestId} parameter is present.

```php
        // define the source image
        $source = new Source();
        $source->setPath("/image/path/file.jpg");

        // define the source for the watermark image
        $watermarkSource = new Source();
        $watermarkSource->setPath("/image/watermark/file.png");

        // define the watermark specification options
        $specification = new ImageWatermarkSpecification();
        $specification->setWatermark($watermarkSource);
        $specification->setPosition(ImageWatermarkPosition::CENTER);
        $specification->setOpacity(90);
        $specification->setScale(0);

        // issue the request
        $watermarkRequest = new ImageWatermarkRequest();
        $watermarkRequest->setSource($source);
        $watermarkRequest->setSpecification($specification);

        $watermarkManifest =  self::$imageManager->createWatermarkManifest($watermarkRequest);
        
        // example: get a watermarked image url using the watermark manifest
        $image = new Image();
        $imageUrl = $image->setPath('/image/path/file.jpg')
            ->setFilename('watermarked.jpg')
            ->fill(100, 100)
            ->watermark( $watermarkManifest->getId() )
            ->toUrl();
        // $imageUrl will be: '/image/path/file.jpg/v1/fill/w_100,h_100,wm_abcdefghijklmnop/watermarked.jpg'

```

## Serving Watermarked Images with the token (without Manifest Creation)

It's possible to serve a secured (private) image with a watermark via the image API, without creating the Watermark Manifest. This action requires a token.

```php
        // your wixmp application id
        $appId = "<insert_app_id>";
        
        // your wixmp app secret (keep it hidden)
        $appSecret = "<insert_app_secret>";
        
        // path to the private file we want to resize and serve
        $filePath = "/image/path/file.jpg"
        
        // define the source for the watermark image
        $watermarkPath = "/image/watermark/file.png";
        
        // maximum watermarked image width that we allow to serve from our private file
        $imageWidth = 640;
        
        // maximum watermarked image height that we allow to serve from our private file
        $imageHeight = 480;
        
        // define the watermark specification options
        $specification = new ImageWatermarkSpecification();
        $specification->setWatermark($watermarkSource);
        $specification->setPosition(ImageWatermarkPosition::CENTER);
        $specification->setOpacity(90);
        $specification->setScale(0);
        
        // generate watermark jwt token
        $token = Wix\Mediaplatform\Image\Auth\Token::createWatermarkToken($appId, $appSecret, $filePath, $watermarkPath, $imageHeight, $imageWidth, $opacity, $position, $scale);
    
        // create the image url
        $image = new Image();
        $imageUrl = $image->setPath('/image/path/file.jpg')
            ->setFilename('watermarked.jpg')
            ->fill(200, 200)
            ->watermark( 'wm_token' )
            ->token($token)
            ->toUrl();
                
        // $imageUrl will be: /image/path/file.jpg/v1/fill/w_100,h_100,wm_token/watermarked.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

## Serving resized versions of private images

It is possible to serve a resized version of a private image, by attaching a special token to the image url
To generate the token and attach it to the image url, please use the following example below:

```php
    // your wixmp application id
    $appId = "<insert_app_id>";
    
    // your wixmp app secret (keep it hidden)
    $appSecret = "<insert_app_secret>";
    
    // path to the private file we want to resize and serve
    $filePath = "/image/path/file.jpg"
    
    // maximum image width that we allow to serve from our private file
    $imageWidth = 200;
    
    // maximum image height that we allow to serve from our private file
    $imageHeight = 200;
    
    // generate jwt token
    $token = Wix\Mediaplatform\Image\Auth\Token::createImageToken($appId, $appSecret, $filePath, $imageHeight, $imageWidth);

    // create the image url
    $image = new Image();
    $imageUrl = $image->setPath('/image/path/file.jpg')
        ->setFilename('file.jpg')
        ->fill(200, 200)
        ->token($token)
        ->toUrl();
```

## Serving original versions of private images

It is possible to serve an original version of a private image, by attaching a special token to the image url
To generate the token and attach it to the image url, please use the following example below:

```php
    // your wixmp application id
    $appId = "<insert_app_id>";
    
    // your wixmp app secret (keep it hidden)
    $appSecret = "<insert_app_secret>";
    
    // path to the private file we want to resize and serve
    $filePath = "/image/path/file.jpg"
    
    // generate jwt token
    $token = Wix\Mediaplatform\Image\Auth\Token::createOriginalImageToken($appId, $appSecret, $filePath);

    // create the image url
    $image = new Image();
    $imageUrl = $image->setPath('/image/path/file.jpg')
        ->setFilename('file.jpg')
        ->token($token)
        ->toUrl();
```

## Image Features

The SDK enables extracting an image's features, which includes face detection, labeling, explicit content detection and color-hinting:

```php
$extractFeaturesRequest = new Wix\Mediaplatform\Model\Request\ExtractImageFeaturesRequest()
                            ->setPath('/test.jpg')
                            ->setFeatures({FACIAL_DETECTION, LABEL_DETECTION, COLOR_DETECTION, EXPLICIT_CONTENT_DETECTION});

$imageFeatures = $mediaPlatform->imageManager()->extractFeatures($extractFeaturesRequest);
```

### Execute an image operation and save it to a remote destination
```php
        // define the source
        $source = new Source();
        $source->setPath("/test.jpg");

        // define the destination
        $destination = new Destination();
        $destination->setPath('/image/file/outputs/first.jpg');
        $destination->setAcl('public');

        // create an empty image object
        $image = new Image();

        // perform an image operation
        $image->fit(100, 100);
        
        // create specification object
        $specification = new ImageOperationSpecification();
        $specification->setCommand($image);
        $specification->setDestination($destination);

        // prepare the image operation request
        $imageOperationRequest = new ImageOperationRequest();
        $imageOperationRequest->setSource($source);
        $imageOperationRequest->setSpecification($specification);

        // execute the request and fetch the file descriptor
        $fileDescriptor = self::$imageManager->imageOperation($imageOperationRequest);
```

## File Metadata & Management
[File Management API Documentation](https://support.wixmp.com/en/article/file-management)

[File Metadata API Documentation](https://support.wixmp.com/en/article/file-metadata)

Wix Media Platform provides a comprehensive set of APIs tailored for management of previously uploaded files.

### List Files in a Directory

```php
$response = $mediaPlatform->fileManager()->listFiles("directory path");
```

### Get File Metadata

```php
$fileMetadata = $mediaPlatform->fileManager()->getFileMetadataById("file id");
```

### Delete File

```php
$mediaPlatform->fileManager()->deleteFileById("file id");
```

### Update File ACL

```php
// mandatory: one of $path or $file
// mandatory: $acl ('private' or 'public'
$fileDescriptor = $mediaPlatform->fileManager()->updateFileAcl($path, $fileId, $acl);
```

### Get File Digest (Basic Metadata)
In order to get the basic uploaded file metadata synchronously, it's possible to call the digest API

```php
        $filePath = "/path/to/some/file.jpg";
        $fileMetadataResponse = $mediaPlatform->fileManager()->getFileDigest($filePath);
```

## Archive Functions
[Archive API Documentation](https://support.wixmp.com/en/article/archive-service)

### Archive Creation

Create an archive from several files:

```php
$createArchiveRequest = new \Wix\Mediaplatform\Model\Request\CreateArchiveRequest();

$source = new \Wix\Mediaplatform\Model\Job\Source();
$source->setFileId("file id");

$destination = new \Wix\Mediaplatform\Model\Job\Destination();
$destination->setAcl("public")
            ->setPath("/demo/file.zip");

$createArchiveRequest
        ->addSource($source)
        ->setDestination($destination)
        ->setArchiveType('zip');
        
$job = $mediaPlatform->archiveManager()->createArchive($createArchiveRequest);
```

### Archive Extraction

Instead of uploading numerous files one by one, you can upload a single zip file
and instruct the Media Platform to extract its content to a destination directory. 

```php
$extractArchiveRequest = new \Wix\Mediaplatform\Model\Request\ExtractArchiveRequest();

$source = new \Wix\Mediaplatform\Model\Job\Source();
$source->setFileId("file id");

$destination = new \Wix\Mediaplatform\Model\Job\Destination();
$destination->setAcl("public")
               ->setDirectory("/demo/extracted");

$extractArchiveRequest
        ->setSource($source)
        ->setDestination($destination);
        
$job = $mediaPlatform->archiveManager()->extractArchive($extractArchiveRequest);
```
## Transcoding

[Transcode API Documentation](https://support.wixmp.com/en/article/video-transcoding-5054232)

To initiate a transcode request:

```php
$transcodeRequest = new TranscodeRequest();

$specifications = array(
    TranscodeSpecification::factory()
        ->setDestination(
            Destination::factory()
                ->setDirectory("/test/output1.mp4")
                ->setAcl("public")
        )->setQualityRange(
            QualityRange::factory()
                ->setMinimum("240p")
                ->setMaximum("1440p")
        )
);

$source = Source::factory()->setPath("/test/file.mp4");

$transcodeRequest->addSource($source)
    ->setSpecifications($specifications);

$transcodeResponse = $mediaPlatform->transcodeManager()->transcodeVideo($transcodeRequest);
```

## Reporting Issues

Please use [the issue tracker](https://github.com/wix/media-platform-php-sdk/issues) to report issues related to this library, or to the Wix Media Platform API in general.

## License

We use a custom license, see [LICENSE.md](LICENSE.md).

## About Wix

[Wix.com][wix-url] is a leading cloud-based web development platform with more than 100 million registered users worldwide. 
Our powerful technology makes it simple for everyone to create a beautiful website and grow their business online.

## About Google Cloud Platform

[Google Cloud Platform](https://cloud.google.com/) enables developers to build, test and deploy applications on Google’s reliable infrastructure.
It offers computing, storage and application services for web, mobile and backend solutions.


[wix-url]: https://www.wix.com/
[wixmp-url]: https://gcp.wixmp.com/
[java-url]: https://npmjs.org/package/media-platform-java-sdk
[npm-url]: https://npmjs.org/package/media-platform-js-sdk
[travis-image]: https://travis-ci.org/wix/media-platform-php-sdk.svg?branch=master
[travis-url]: https://travis-ci.org/wix/media-platform-php-sdk
[org-and-project-start]: https://support.wixmp.com/en/article/creating-your-organization-and-project
[application-start]: https://support.wixmp.com/en/article/creating-your-first-application
[jobs-api]: https://support.wixmp.com/en/article/jobs
