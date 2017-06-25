<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:16
 */

namespace Wix\Mediaplatform\Model\Request;
use Wix\Mediaplatform\Model\Request\Enum\OrderBy;
use Wix\Mediaplatform\Model\Request\Enum\OrderDirection;


/**
 * Class ListFileRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class ListFilesRequest extends BaseRequest
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
     * ListFileRequest constructor.
     * @param string $nextPageToken
     * @param int $pageSize
     * @param string $orderBy
     * @param string $orderDirection
     */
    public function __construct($nextPageToken = null, $pageSize = null, $orderBy = null, $orderDirection = null)
    {
        $this->nextPageToken = $nextPageToken;
        $this->pageSize = $pageSize;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
    }

    /**
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * @param string $nextPageToken
     * @return ListFilesRequest
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return ListFilesRequest
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @return OrderBy
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param OrderBy $orderBy
     * @return ListFilesRequest
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return OrderDirection
     */
    public function getOrderDirection()
    {
        return $this->orderDirection;
    }

    /**
     * @param OrderDirection $orderDirection
     * @return ListFilesRequest
     */
    public function setOrderDirection($orderDirection)
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @return array
     */
    public function toParams() {
        $params = array();

        if($this->nextPageToken != null) {
            $params["nextPageToken"] = $this->nextPageToken;
        }

        if($this->pageSize != null) {
            $params["pageSize"] = $this->pageSize;
        }

        if($this->orderBy != null) {
            $params["orderBy"] = $this->orderBy;
        }

        if($this->orderDirection != null) {
            $params["orderDirection"] = $this->orderDirection;
        }

        return $params;
    }

}