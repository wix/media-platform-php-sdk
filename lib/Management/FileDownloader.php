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
use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Model\Request\DownloadUrlRequest;
use Wix\Mediaplatform\Model\Request\SignedDownloadUrlRequest;

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

    /**
     * @param $path
     * @param DownloadUrlRequest|null $downloadUrlRequest
     * @deprecated use getSignedUrl
     * @return string
     */
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

	/**
	 * @param $path
	 * @return string
	 */
	public function getSignedUrl( $path, SignedDownloadUrlRequest $signedDownloadUrlRequest = null) {
		$additionalClaims = array();
		$token = new Token();

		$saveAs = "";

		if ($signedDownloadUrlRequest != null) {
			if ($signedDownloadUrlRequest->getTtl() != null) {
				$token->setExpiration(time() + $signedDownloadUrlRequest->getTtl());
			}
			if ($signedDownloadUrlRequest->getOnExpireRedirectTo() != null) {
				$additionalClaims["red"] = $signedDownloadUrlRequest->getOnExpireRedirectTo();
			}
			if ($signedDownloadUrlRequest->getAttachment() != null) {
				if ($signedDownloadUrlRequest->getAttachment()->getFilename() != null) {
					$saveAs = sprintf("&filename=%s", $signedDownloadUrlRequest->getAttachment()->getFilename());
				}
			}
		}

		$object = array(
			"path" => $path
		);

		$token->setIssuer( NS::APPLICATION . $this->configuration->getAppId())
		      ->setSubject(NS::APPLICATION . $this->configuration->getAppId())
		      ->addVerb(VERB::FILE_DOWNLOAD)
		      ->setObject(
		      	array(
			      array(
				      $object
			      )
		        )
		      )
		      ->setAdditionalClaims($additionalClaims);

		$signedToken = $this->authenticator->encode($token);

		$hostname = preg_replace( "/\.appspot\.com/",
			".wixmp.com",
			$this->configuration->getDomain() );

		return sprintf("https://%s%s?token=%s%s",
			$hostname,
			$path,
			$signedToken,
			$saveAs
		);
	}
}