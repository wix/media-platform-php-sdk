# Wix Media Platform

[![Build Status](https://travis-ci.com/panda-os/media-platform-php-sdk.svg?token=BhxEHXNqvvH2jy6qiBFa&branch=master)](https://travis-ci.com/panda-os/media-platform-php-sdk)

[Wix Media Platform][wixmp-url] is a collection of services for storing, serving, uploading, and managing media files and any files in general

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

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/wix/media-platform-php-sdk.git"
    }
  ],
  "require": {
    "wix/media-platform-php-sdk": "*"
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

First, if you haven't done so yet, register at [Wix Media Platform][wixmp-url], create your organization, project and application.

```php
    $mediaPlatform = new \Wix\Mediaplatform\MediaPlatform(
    "<project host as appears in the application page>",
    "<application id as appears in the application page>",
    "<shared secret as appears in the application page>"
);
```

## File Upload

```php
$file = fopen("...path to file...", "r");
$files = $mediaPlatform->fileManager()->uploadFile("/destination_path/file_name.ext", "mime_type", "file_name.ext", file, "private||public");
```

### Get Upload URL

Generates a signed URL and token, required for uploading from the browser

```php
$getUploadUrlResponse = $mediaPlatform->fileManager()->getUploadUrl();
```

## Jobs

The Jobs API forms the basis for all long running asynchronous operations in the platform.

### Job Lifecycle

A job is created by a service that performs a long running operation, such as video transcode or file import.

1. On job creation it is queued for execution and assumes the 'pending' status.
2. When the job execution commences, the job status changes to 'working'
3. On job completion the job assumes one of the following statuses: 'success' or 'error' and the 'result' property is populated

### Get Job

```php
$job = $mediaPlatform->jobManager()->getJob("job id");
```

## File Import

```php
$importFileRequest = new \Wix\Mediaplatform\Model\Request\ImportFileRequest();

$destination = new \Wix\Mediaplatform\Model\Job\Destination();
$destination->setPath("/to/file.ext")
              ->setAcl("private||public")
              
$importFileRequest->setSourceUrl("from URL")
                    ->setDestination($destination);
        
$job = $mediaPlatform->fileManager()->importFile($importFileRequest);
```

## Secure File URL

File access can be restricted by setting the acl to 'private', in order to access them a secure URL must be generated

```php
$signedUrl = $mediaPlatform->fileDownloader()->getDownloadUrl("path/to/file.ext");
```

## Image Consumption

The SDK provides a programmatic facility to generate image URLs

```php
$image = new \Wix\Mediaplatform\Image\Image($fileDescriptor);
$image->setHost("images service host");
$image->crop($width, $height, $x, $y, $scale);

$url = $image->toUrl(); 
```

## File Metadata & Management

Wix Media Platform exposes a comprehensive set of APIs tailored for the management of files.

### List Files

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

## Archive Extraction

Instead of uploading numerous files one by one, it is possible to upload a single zip file
and order the Media Platform to extract its content to a destination directory. 

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
