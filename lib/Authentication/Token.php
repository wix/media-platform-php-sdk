<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:24
 */

namespace Wix\Mediaplatform\Authentication;


use Wix\Mediaplatform\Authentication\Jwt\Constants;

/**
 * Class Token
 * @package Wix\Mediaplatform\Authentication
 */
class Token
{
    /**
     * @var string
     */
    private $issuer;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $object;

    /**
     * @var array
     */
    private $verbs = array();

    /**
     * @var int
     */
    private $issuedAt;

    /**
     * @var int
     */
    private $expiration;

    /**
     * @var string
     */
    private $tokenId;

    /**
     * @var array
     */
    private $additionalClaims;


    /**
     * Token constructor.
     * @param array $claims
     */
    public function __construct($claims = array())
    {
        if (empty($claims)) {
            $this->issuedAt = time() - 10;
            $this->expiration = time() + 600;
            $this->tokenId = uniqid();
        } else {
            $this->issuer = ($claims[Constants::ISSUER] == null) ? null : $claims[Constants::ISSUER];
            $this->subject = ($claims[Constants::SUBJECT] == null) ? null : $claims[Constants::SUBJECT];
            $this->object = ($claims[Constants::OBJECT] == null) ? null : $claims[Constants::OBJECT];
            $this->verbs = ($claims[Constants::AUDIENCE] == null) ? array() : $claims[Constants::AUDIENCE];
            $this->issuedAt = ($claims[Constants::ISSUED_AT] == null) ? null : $claims[Constants::ISSUED_AT];
            $this->expiration = ($claims[Constants::EXPIRATION] == null) ? null : $claims[Constants::EXPIRATION];
            $this->tokenId = ($claims[Constants::IDENTIFIER] == null) ? null : $claims[Constants::IDENTIFIER];
        }
    }

    /**
     * @return string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @param string $issuer
     * @return Token
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Token
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param $object
     * @return Token
     */
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }

    /**
     * @return array
     */
    public function getVerbs()
    {
        return $this->verbs;
    }

    /**
     * @param array $verbs
     * @return Token
     */
    public function setVerbs($verbs)
    {
        $this->verbs = $verbs;
        return $this;
    }

    /**
     * @param string $verb
     * @return Token
     */
    public function addVerb($verb)
    {
        $this->verbs[] = $verb;
        return $this;
    }

    /**
     * @return int
     */
    public function getIssuedAt()
    {
        return $this->issuedAt;
    }

    /**
     * @param int $issuedAt
     * @return Token
     */
    public function setIssuedAt($issuedAt)
    {
        $this->issuedAt = $issuedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param int $expiration
     * @return Token
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * @param string $tokenId
     * @return Token
     */
    public function setTokenId($tokenId)
    {
        $this->tokenId = $tokenId;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdditionalClaims()
    {
        return $this->additionalClaims;
    }

    /**
     * @param array $additionalClaims
     * @return Token
     */
    public function setAdditionalClaims($additionalClaims)
    {
        $this->additionalClaims = $additionalClaims;
        return $this;
    }



    /**
     * @return array
     */
    public function toClaims()
    {
        $claims = array();
        $claims[Constants::SUBJECT] = $this->subject;
        $claims[Constants::ISSUER] = $this->issuer;
        $claims[Constants::EXPIRATION] = $this->expiration;
        $claims[Constants::ISSUED_AT] = $this->issuedAt;
        $claims[Constants::IDENTIFIER] = $this->tokenId;
        $claims[Constants::OBJECT] = $this->object;
        $claims[Constants::AUDIENCE] = $this->verbs;
        if (!empty($this->additionalClaims) && is_array($this->additionalClaims)) {
            $claims = array_merge($claims, $this->additionalClaims);
        }

        return $claims;
    }
}