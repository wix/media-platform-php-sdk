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

## Image Features

The SDK enables extracting an image's features, which includes face detection, labeling, explicit content detection and color-hinting:

```php
$extractFeaturesRequest = new Wix\Mediaplatform\Model\Request\ExtractImageFeaturesRequest();
                            ->setPath('/test.jpg')
                            ->setFeatures({FACIAL_DETECTION, LABEL_DETECTION, COLOR_DETECTION, EXPLICIT_CONTENT_DETECTION});

$imageFeatures = $mediaPlatform->imageManager()->extractFeatures($extractFeaturesRequest);
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
