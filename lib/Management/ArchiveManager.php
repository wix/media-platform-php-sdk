<?php
namespace Wix\Mediaplatform\Management;


use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
use Wix\Mediaplatform\Model\Job\CreateArchiveJob;
use Wix\Mediaplatform\Model\Job\ExtractArchiveJob;
use Wix\Mediaplatform\Model\Request\CreateArchiveRequest;
use Wix\Mediaplatform\Model\Request\ExtractArchiveRequest;

class ArchiveManager
{

    /**
     * @var Configuration $configuration
     */
    private $configuration;

    /**
     * @var AuthenticatedHTTPClient $authenticatedHTTPClient
     */
    private $authenticatedHTTPClient;

    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(Configuration $configuration, AuthenticatedHTTPClient $authenticatedHTTPClient) {
        $this->configuration = $configuration;
        $this->authenticatedHTTPClient = $authenticatedHTTPClient;

        $this->baseUrl = "https://" . $this->configuration->getDomain() . "/_api";
    }


    /**
     * @param CreateArchiveRequest
     * @return CreateArchiveJob
     */
    public function createArchive(CreateArchiveRequest $createArchiveRequest) {
        $restResponse = $this->authenticatedHTTPClient->post(
            $this->baseUrl . "/archive/create",
            $createArchiveRequest
        );

        return new CreateArchiveJob($restResponse->getPayload());
    }

    /**
     * @param ExtractArchiveRequest
     * @return ExtractArchiveJob
     */
    public function extractArchive(ExtractArchiveRequest $extractArchiveRequest) {
        $restResponse = $this->authenticatedHTTPClient->post(
            $this->baseUrl . "/archive/extract",
            $extractArchiveRequest
        );

        return new ExtractArchiveJob($restResponse->getPayload());
    }
}