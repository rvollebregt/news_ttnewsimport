<?php

namespace BeechIt\NewsTtnewsimport\Domain\Model;

class NewsDefault extends \GeorgRinger\News\Domain\Model\News
{
    /** @var int */
    protected $eventFrom;
    /** @var int */
    protected $eventTo;
    /** @var string */
    protected $eventWhere;
    /** @var string */
    protected $eventOrganizer;
    /** @var string */
    protected $eventOrganizerEmail;
    /** @var int */
    protected $eventRegfrom;
    /** @var int */
    protected $eventRegto;
    /** @var string */
    protected $eventRegurl;
    /** @var int */
    protected $eventPreviewEnd;
    /** @var string */
    protected $eventPreviewHash;
    /** @var int */
    protected $eventShowyear;

    /**
     * @return int
     */
    public function getEventFrom()
    {
        return $this->eventFrom;
    }

    /**
     * @param int $eventFrom
     */
    public function setEventFrom($eventFrom)
    {
        $this->eventFrom = $eventFrom;
    }

    /**
     * @return int
     */
    public function getEventTo()
    {
        return $this->eventTo;
    }

    /**
     * @param int $eventTo
     */
    public function setEventTo($eventTo)
    {
        $this->eventTo = $eventTo;
    }

    /**
     * @return string
     */
    public function getEventWhere()
    {
        return $this->eventWhere;
    }

    /**
     * @param string $eventWhere
     */
    public function setEventWhere($eventWhere)
    {
        $this->eventWhere = $eventWhere;
    }

    /**
     * @return string
     */
    public function getEventOrganizer()
    {
        return $this->eventOrganizer;
    }

    /**
     * @param string $eventOrganizer
     */
    public function setEventOrganizer($eventOrganizer)
    {
        $this->eventOrganizer = $eventOrganizer;
    }

    /**
     * @return string
     */
    public function getEventOrganizerEmail()
    {
        return $this->eventOrganizerEmail;
    }

    /**
     * @param string $eventOrganizerEmail
     */
    public function setEventOrganizerEmail($eventOrganizerEmail)
    {
        $this->eventOrganizerEmail = $eventOrganizerEmail;
    }

    /**
     * @return int
     */
    public function getEventRegfrom()
    {
        return $this->eventRegfrom;
    }

    /**
     * @param int $eventRegfrom
     */
    public function setEventRegfrom($eventRegfrom)
    {
        $this->eventRegfrom = $eventRegfrom;
    }

    /**
     * @return int
     */
    public function getEventRegto()
    {
        return $this->eventRegto;
    }

    /**
     * @param int $eventRegto
     */
    public function setEventRegto($eventRegto)
    {
        $this->eventRegto = $eventRegto;
    }

    /**
     * @return string
     */
    public function getEventRegurl()
    {
        return $this->eventRegurl;
    }

    /**
     * @param string $eventRegurl
     */
    public function setEventRegurl($eventRegurl)
    {
        $this->eventRegurl = $eventRegurl;
    }

    /**
     * @return int
     */
    public function getEventPreviewEnd()
    {
        return $this->eventPreviewEnd;
    }

    /**
     * @param int $eventPreviewEnd
     */
    public function setEventPreviewEnd($eventPreviewEnd)
    {
        $this->eventPreviewEnd = $eventPreviewEnd;
    }

    /**
     * @return string
     */
    public function getEventPreviewHash()
    {
        return $this->eventPreviewHash;
    }

    /**
     * @param string $eventPreviewHash
     */
    public function setEventPreviewHash($eventPreviewHash)
    {
        $this->eventPreviewHash = $eventPreviewHash;
    }

    /**
     * @return int
     */
    public function getEventShowyear()
    {
        return $this->eventShowyear;
    }

    /**
     * @param int $eventShowyear
     */
    public function setEventShowyear($eventShowyear)
    {
        $this->eventShowyear = $eventShowyear;
    }
}
