<?php


namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class CreateArchiveSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class CreateArchiveSpecification extends BaseModel
{
    /**
     * @var array
     */
    protected $sources = array();

    /**
     * @var Destination
     */
    protected $destination;
    /**
     * @var string
     */
    protected $archiveType;

    /**
     * CreateArchiveSpecification constructor.
     */
    public function __construct(Array $payload)
    {
        parent::__construct($payload);
        if(!empty($payload['sources']) && count($payload['sources'])) {
            foreach($payload['sources'] as $source) {
                $this->sources[] = new Source($source);
            }
        }

        $this->destination = new Destination($payload['destination']);

        $this->archiveType = $payload['archiveType'];
    }


    /**
     * @return array
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @return Destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return mixed|string
     */
    public function getArchiveType() {
        return $this->archiveType;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "CreateArchiveSpecification{" .
            "source=" . $this->source .
            ", destination=" . $this->destination .
            ", archiveType=" . $this->archiveType .
            '}';
    }
}