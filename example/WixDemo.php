<?php
use Wix\Mediaplatform\Image\Image;
use Wix\Mediaplatform\MediaPlatform;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\FileImportJob;
use Wix\Mediaplatform\Model\Job\ImageOperationSpecification;
use Wix\Mediaplatform\Model\Job\QualityRange;
use Wix\Mediaplatform\Model\Job\Resolution;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Job\TranscodeJob;
use Wix\Mediaplatform\Model\Job\TranscodeSpecification;
use Wix\Mediaplatform\Model\Job\VideoCodec;
use Wix\Mediaplatform\Model\Job\VideoSpecification;
use Wix\Mediaplatform\Model\Request\CreateArchiveRequest;
use Wix\Mediaplatform\Model\Request\ExtractArchiveRequest;
use Wix\Mediaplatform\Model\Request\ImageOperationRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\ListFilesRequest;
use Wix\Mediaplatform\Model\Request\SearchJobsRequest;
use Wix\Mediaplatform\Model\Request\TranscodeRequest;

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

    function updateFileAcl() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, 'private');

        $fileId = $files[0]->getId();
        $res = $this->mediaPlatform->fileManager()->updateFileAcl(null, $fileId, 'public');
        print_r($res);
    }

    function getFileDigest() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, 'private');

        $filePath = $files[0]->getPath();
        $res = $this->mediaPlatform->fileManager()->getFileDigest($filePath);
        print_r($res);
    }

    function getImageFeatures() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, null);

        $fileId = $files[0]->getId();
        $imageFeaturesRequest = new \Wix\Mediaplatform\Model\Request\ExtractImageFeaturesRequest();
        $imageFeaturesRequest->setFileId($fileId);
        $imageFeaturesRequest->setFeatures(array(
            \Wix\Mediaplatform\Model\Request\Enum\ImageFeatureExtractors::COLOR_DETECTION,
            \Wix\Mediaplatform\Model\Request\Enum\ImageFeatureExtractors::EXPLICIT_CONTENT_DETECTION,
            \Wix\Mediaplatform\Model\Request\Enum\ImageFeatureExtractors::FACIAL_DETECTION,
            \Wix\Mediaplatform\Model\Request\Enum\ImageFeatureExtractors::LABEL_DETECTION,
        ));

        $res = $this->mediaPlatform->imageManager()->extractFeatures($imageFeaturesRequest);
        print_r($res);
    }

    function executeImageOperation() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, null);

        $fileId = $files[0]->getId();

        $source = new Source();
        $source->setFileId($fileId);

        $destination = new Destination();
        $destination->setPath('/demo/fit-image-100-100.jpg');
        $destination->setAcl('public');

        $image = new Image();

        $image->fit(100, 100);
        $specification = new ImageOperationSpecification();
        $specification->setCommand($image);
        $specification->setDestination($destination);

        $imageOperationRequest = new ImageOperationRequest();
        $imageOperationRequest->setSource($source);
        $imageOperationRequest->setSpecification($specification);

        $fileDescriptor = $this->mediaPlatform->imageManager()->imageOperation($imageOperationRequest);

        print_r($fileDescriptor);
    }

    function executeImageOperationOnPrivateFile() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/golan.jpg", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".golan.jpg","image/jpeg", "golan.jpg", $file, "private");

        $fileId = $files[0]->getId();

        $source = new Source();
        $source->setFileId($fileId);

        $destination = new Destination();
        $destination->setPath('/demo/fit-image-100-100.jpg');
        $destination->setAcl('public');

        $image = new Image();

        $image->fit(100, 100);
        $specification = new ImageOperationSpecification();
        $specification->setCommand($image);
        $specification->setDestination($destination);

        $imageOperationRequest = new ImageOperationRequest();
        $imageOperationRequest->setSource($source);
        $imageOperationRequest->setSpecification($specification);

        $fileDescriptor = $this->mediaPlatform->imageManager()->imageOperation($imageOperationRequest);

        print_r($fileDescriptor);
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

    function createArchive() {

        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/document.xlsx", "r");
        $fileDescriptor = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".document.xlsx",
            "application/vnd.ms-excel",
            "document.xlsx",
            $file, "private")[0];

        $createArchiveRequest = new CreateArchiveRequest();

        $source = new Source();
        $source->setFileId($fileDescriptor->getId());

        $destination = new Destination();
        $destination->setAcl("public")->setPath("/demo/archived/document.xlsx.zip");

        $createArchiveRequest->addSource($source)
            ->setDestination($destination)
            ->setArchiveType('zip');

        $job = $this->mediaPlatform->archiveManager()->createArchive($createArchiveRequest);

        print_r($job);
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

    function transcodeVideo() {
        echo "uploading file..." . PHP_EOL;
        $id = uniqid();

        $file = fopen(__DIR__ .  DIRECTORY_SEPARATOR . "resources/video.mp4", "r");
        $files = $this->mediaPlatform->fileManager()
            ->uploadFile("/demo/upload/" . $id . ".video.mp4","video/mp4", "video.mp4", $file, null);

        $fileId = $files[0]->getId();
        echo "Waiting for transcode (up to 10 minutes)...";
        $ready = false;
        $attempt = 0;

        // transcode job
        $transcodeJobRequest = TranscodeRequest::factory();
        $source = Source::factory()->setPath($files[0]->getPath());

        $videoSpecification1 = VideoSpecification::factory()
            ->setFrameRate(30)
            ->setResolution(
                Resolution::factory()->setHeight(480)
            )->setCodec(
                VideoCodec::factory()
                    ->setProfile("high")
                    ->setName("h.264")
                    ->setLevel("2.2")
                    ->setMaxRate(3000)
                    ->setCrf(26)
            );

        $videoSpecification2 = VideoSpecification::factory()
            ->setFrameRate(30)
            ->setResolution(
                Resolution::factory()->setHeight(240)
            )->setCodec(
                VideoCodec::factory()
                    ->setProfile("baseline")
                    ->setName("h.264")
                    ->setLevel("2.2")
                    ->setMaxRate(3000)
                    ->setCrf(26)
            );


        $specifications = array(
            TranscodeSpecification::factory()
                ->setDestination(
                    Destination::factory()
                        ->setDirectory("/demo/encodes/$id/")
                        ->setAcl("public")
                )->setQualityRange(
                    QualityRange::factory()
                    ->setMinimum("240p")
                    ->setMaximum("1440p")
                )
            );

        $transcodeJobRequest->addSource($source)
            ->setSpecifications($specifications);

        $transcodeResult = $this->mediaPlatform->transcodeManager()->transcodeVideo($transcodeJobRequest);

        echo PHP_EOL . "Checking job group " . $transcodeResult->getGroupId() . PHP_EOL;
        while (!$ready && $attempt < 300) {
            $attempt++;
            echo $attempt . ". " . PHP_EOL;

            $jobGroup = $this->mediaPlatform->jobManager()->getJobGroup($transcodeResult->getGroupId());

            $success = false;
            /**
             * @var $job TranscodeJob
             */
            foreach($jobGroup as $job) {
                echo $job->getId() . ": " . $job->getStatus() . PHP_EOL;
                if($job->getStatus() == "success") {
                    $success = true;
                } else {
                    $success = false;
                    break;
                }
            }

            if ($success) {
                $ready = true;
                echo PHP_EOL;
            }

            sleep(2);
        }

    }

}