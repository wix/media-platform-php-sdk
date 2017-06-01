# Wix Media Platform

[Wix Media Platform][wixmp-url] is a collection of services for storing, serving, uploading, and managing media files and any files in general

# PHP SDK

This artifact is a PHP library, compatible with PHP 5.4+ and PHP 7.

## Installation

```xml
<dependency>
    <groupId>com.wix</groupId>
    <artifactId>media-platform-java-sdk</artifactId>
    <version>[5.0,6.0)</version>
</dependency>
```

## JavaScript SDK

The respective JavaScript (for the Browser and Node.js) package can be found [here.][npm-url]

## Instantiating the Media Platform

First, if you haven't done so yet, register at [Wix Media Platform][wixmp-url], create your organization, project and application.

```java
MediaPlatform mediaPlatform = new MediaPlatform(
    "<project host as appears in the application page>",
    "<application id as appears in the application page>",
    "<shared secret as appears in the application page>"
);
```

## File Upload

```java
File file = new File(...);
FileDescriptor[] files = mediaPlatform.fileManager().uploadFile("/destination_path/file_name.ext", "mime_type", "file_name.ext", file, "private||public");
```

### Get Upload URL

Generates a signed URL and token, required for uploading from the browser

```java
GetUploadUrlResponse getUploadUrlResponse = mediaPlatform.fileManager().getUploadUrl();
```

## Jobs

The Jobs API forms the basis for all long running asynchronous operations in the platform.

### Job Lifecycle

A job is created by a service that performs a long running operation, such as video transcode or file import.

1. On job creation it is queued for execution and assumes the 'pending' status.
2. When the job execution commences, the job status changes to 'working'
3. On job completion the job assumes one of the following statuses: 'success' or 'error' and the 'result' property is populated

### Get Job

```java
job = mediaPlatform.jobManager().getJob("job id");
```

## File Import

```java
ImportFileRequest importFileRequest = new ImportFileRequest()
        .setSourceUrl("from URL")
        .setDestination(new Destination()
                .setPath("/to/file.ext")
                .setAcl("private||public"));
Job job = mediaPlatform.fileManager().importFile(importFileRequest);
```

## Secure File URL

File access can be restricted by setting the acl to 'private', in order to access them a secure URL must be generated

```java
String signedUrl = mediaPlatform.fileDownloader().getDownloadUrl("path/to/file.ext");
```

## Image Consumption

The SDK provides a programmatic facility to generate image URLs

```java
Image image = new Image(fileDescriptor).setHost("images service host");

image.crop(width, height, x, y, scale);

String url = image.toUrl(); 
```

## File Metadata & Management

Wix Media Platform exposes a comprehensive set of APIs tailored for the management of files.

### List Files

```java
ListFilesResponse response = mediaPlatform.fileManager().listFiles("directory path");
```

### Get File Metadata

```java
FileMetadata fileMetadata = mediaPlatform.fileManager().getFileMetadataById("file id");
```

### Delete File

```java
mediaPlatform.fileManager().deleteFileById("file id");
```

## Archive Extraction

Instead of uploading numerous files one by one, it is possible to upload a single zip file
and order the Media Platform to extract its content to a destination directory. 

```java
ExtractArchiveRequest extractArchiveRequest = new ExtractArchiveRequest()
        .setSource(new Source().setFileId("file id"))
        .setDestination(new Destination().setAcl("public").setDirectory("/demo/extracted"));
Job job = mediaPlatform.archiveManager().extractArchive(extractArchiveRequest);
```

## Reporting Issues

Please use [the issue tracker](https://github.com/wix/media-platform-java-sdk/issues) to report issues related to this library, or to the Wix Media Platform API in general.

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
[mvn-image]: https://img.shields.io/maven-central/v/com.wix/media-platform-java-sdk.svg
[mvn-url]: https://mvnrepository.com/artifact/com.wix/media-platform-java-sdk
[npm-url]: https://npmjs.org/package/media-platform-js-sdk
