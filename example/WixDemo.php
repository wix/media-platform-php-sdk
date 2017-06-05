<?php
use Wix\Mediaplatform\Image\Image;
use Wix\Mediaplatform\MediaPlatform;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\FileImportJob;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Request\ExtractArchiveRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\ListFilesRequest;
use Wix\Mediaplatform\Model\Request\SearchJobsRequest;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 01/06/2017
 * Time: 12:47
 */
class WixDemo
{
    /**
     * @var MediaPlatform
     */
    private $mediaPlatform;

    public function __construct(MediaPlatform $mediaPlatform) {
        $this->mediaPlatform = $mediaPlatform;
    }

    public function importFile() {
        $importFileRequest = new ImportFileRequest();
        $destination = new Destination();
        $destination->setDirectory("/demo/import/" . uniqid())
            ->setAcl("public");
        $importFileRequest->setSourceUrl("https://static.wixstatic.com/media/f31d7d0cfc554aacb1d737757c8d3f1b.jpg")
            ->setDestination($destination);
        $job = $this->mediaPlatform->fileManager()->importFile($importFileRequest);

        $ready = false;
        $attempt = 0;

        while (!$ready && $attempt < 60) {
            $job = $this->mediaPlatform->jobManager()->getJob($job->getId());
            $attempt++;
            echo $attempt . " ";

            if ("success" === $job->getStatus() || "error" === $job->getStatus()) {
                $ready = true;
                echo PHP_EOL;
            }

            sleep(1);
        }


        $image = new Image($job->getResult()->getPayload());

        $url = $image->setHost("https://images-wixmp-410a67650b2f46baa5d003c6.wixmp.com")
            ->smartCrop(400, 300)
            ->toUrl();

        echo "SEE IMPORTED IMAGE @ " . $url . PHP_EOL;
    }

    function uploadImage() {
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, null);
        $image = new Image($files[0]);
        $image->setHost("https://images-wixmp-410a67650b2f46baa5d003c6.wixmp.com");

        $image->crop(200, 300, 0, 0, 2);
        echo "CROPPED IMAGE @ " . $image->toUrl() . PHP_EOL;

        $image->smartCrop(200, 300);
        echo "SMART CROPPED IMAGE @ " . $image->toUrl() . PHP_EOL;
    }

    function listFiles() {
        $listFilesRequest = new ListFilesRequest();
        $listFilesRequest->setPageSize(3);
        $res = $this->mediaPlatform->fileManager()->listFiles("/demo", $listFilesRequest);
        print_r($res);
    }

    function getImageMetadata() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, null);

        $fileId = $files[0]->getId();
        $res = $this->mediaPlatform->fileManager()->getFileMetadataById($fileId);
        print_r($res);
    }

    function getVideoMetadata() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/video.mp4", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".video.mp4","video/mp4", "video.mp4", $file, null);

        $fileId = $files[0]->getId();
        echo "Waiting for metadata (up to 60 seconds)...";
        $ready = false;
        $attempt = 0;

        while (!$ready && $attempt < 60) {
            $metadata = $this->mediaPlatform->fileManager()->getFileMetadataById($fileId);
            $attempt++;
            echo $attempt . " ";

            if (!is_null($metadata->getBasic())) {
                $ready = true;
                echo PHP_EOL;
            }

            sleep(1);
        }

        print_r($metadata);
    }

    function getDownloadUrl() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, null);

        $path = $files[0]->getPath();
        $res = $this->mediaPlatform->fileDownloader()->getDownloadUrl($path);
        echo "Download Url: " . $res . PHP_EOL;
    }

    function listJobs() {
        $searchJobsRequest = new SearchJobsRequest();
        $searchJobsRequest->setType(FileImportJob::$job_type)->setPageSize(3);
        $response = $this->mediaPlatform->jobManager()->searchJobs($searchJobsRequest);

        print_r($response);
    }

    function extractArchive() {

        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/document.xlsx.zip", "r");
        $fileDescriptor = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".document.xlsx.zip",
            "application/zip",
            "document.xlsx.zip",
            $file, "private")[0];

        $extractArchiveRequest = new ExtractArchiveRequest();

        $source = new Source();
        $source->setFileId($fileDescriptor->getId());

        $destination = new Destination();
        $destination->setAcl("public")->setDirectory("/demo/extracted");

        $extractArchiveRequest->setSource($source)
            ->setDestination($destination);

        $job = $this->mediaPlatform->archiveManager()->extractArchive($extractArchiveRequest);

        print_r($job);
    }
}