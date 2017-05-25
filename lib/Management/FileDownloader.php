<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 20:41
 */

namespace Wix\Mediaplatform\Management;


use Wix\Mediaplatform\Authentication\Authenticator;
use Wix\Mediaplatform\Authentication\NS;
use Wix\Mediaplatform\Authentication\Token;
use Wix\Mediaplatform\Authentication\VERB;
use Wix\Mediaplatform\Configuration;
use Wix\Mediaplatform\Model\Request\DownloadUrlRequest;

class FileDownloader
{
    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * FileDownloader constructor.
     * @param Configuration $configuration
     * @param Authenticator $authenticator
     */
    public function __construct(Configuration $configuration, Authenticator $authenticator) {
        $this->authenticator = $authenticator;
        $this->configuration = $configuration;
    }

    public function getDownloadUrl($path, DownloadUrlRequest $downloadUrlRequest = null) {
        $payload = array();
        $payload["path"] = $path;
        $token = new Token();
        if ($downloadUrlRequest != null) {
            if ($downloadUrlRequest->getTtl() != null) {
                $token->setExpiration(time() + $downloadUrlRequest->getTtl());
            }
            if ($downloadUrlRequest->getOnExpireRedirectTo() != null) {
                $payload["onExpireRedirectTo"] = $downloadUrlRequest->getOnExpireRedirectTo();
            }
            if ($downloadUrlRequest->getAttachment() != null) {
                $attachment = array();
                if ($downloadUrlRequest->getAttachment()->getFilename() != null) {
                    $attachment["filename"] = $downloadUrlRequest->getAttachment()->getFilename();
                }
                $payload["attachment"] = $attachment;
            }
        }

        $additionalClaims = array();
        $additionalClaims["payload"] = $payload;
        $token->setIssuer(NS::APPLICATION . $this->configuration->getAppId())
            ->setSubject(NS::APPLICATION . $this->configuration->getAppId())
            ->addVerb(VERB::FILE_DOWNLOAD)
            ->setAdditionalClaims($additionalClaims);

        $signedToken = $this->authenticator->encode($token);

        return "https://" .
            $this->configuration->getDomain() .
            "/_api/download/file?downloadToken=" .
            $signedToken;
    }
}