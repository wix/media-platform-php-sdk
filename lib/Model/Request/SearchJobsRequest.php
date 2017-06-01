<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:41
 */

namespace Wix\Mediaplatform\Model\Request;


use Wix\Mediaplatform\Model\Request\Enum\OrderBy;
use Wix\Mediaplatform\Model\Request\Enum\OrderDirection;

/**
 * Class SearchJobsRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class SearchJobsRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $nextPageToken;

    /**
     * @var int
     */
    protected $pageSize;

    /**
     * @var OrderBy
     */
    protected $orderBy;

    /**
     * @var OrderDirection
     */
    protected $orderDirection;

    /**
     * @var string
     */
    protected $issuer;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $fileId;

    /**
     * @var string
     */
    protected $path;

    /**
     * SearchJobsRequest constructor.
     * @param string $nextPageToken
     * @param string $pageSize
     * @param OrderBy $orderBy
     * @param OrderDirection $orderDirection
     */
    public function __construct($nextPageToken = null, $pageSize = null, $orderBy = null, $orderDirection = null)
    {
        $this->nextPageToken = $nextPageToken;
        $this->pageSize = $pageSize;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
    }

    /**
     * @param string $nextPageToken
     * @return SearchJobsRequest
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @param int $pageSize
     * @return SearchJobsRequest
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @param OrderBy $orderBy
     * @return SearchJobsRequest
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param OrderDirection $orderDirection
     * @return SearchJobsRequest
     */
    public function setOrderDirection($orderDirection)
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @param string $issuer
     * @return SearchJobsRequest
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
        return $this;
    }

    /**
     * @param string $type
     * @return SearchJobsRequest
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $status
     * @return SearchJobsRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $groupId
     * @return SearchJobsRequest
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @param string $fileId
     * @return SearchJobsRequest
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
        return $this;
    }

    /**
     * @param string $path
     * @return SearchJobsRequest
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }


    /**
     * @return array
     */
    public function toParams()
    {
        $params = array();

        if ($this->nextPageToken != null) {
            $params["nextPageToken"] = $this->nextPageToken;
        }

        if ($this->pageSize != null) {
            $params["pageSize"] = $this->pageSize;
        }

        if ($this->orderBy != null) {
            $params["orderBy"] = $this->orderBy;
        }

        if ($this->orderDirection != null) {
            $params["orderDirection"] = $this->orderDirection;
        }

        if ($this->issuer != null) {
            $params["issuer"] = $this->issuer;
        }

        if ($this->type != null) {
            $params["type"] = $this->type;
        }

        if ($this->status != null) {
            $params["status"] = $this->status;
        }

        if ($this->groupId != null) {
            $params["groupId"] = $this->groupId;
        }

        if ($this->fileId != null) {
            $params["fileId"] = $this->fileId;
        }

        if ($this->path != null) {
            $params["path"] = $this->path;
        }

        return $params;
    }
}