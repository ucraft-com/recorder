<?php

namespace Uc\Recorder\Activity;

use DateTimeImmutable;

class ActivityRecordBuilder
{
    protected string $action;

    protected string $description;

    protected DateTimeImmutable $date;

    protected int $userId;

    protected GeographicInfo $geographicInfo;

    protected UserAgent $userAgent;

    /**
     * @return string
     */
    public function getAction() : string
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return ActivityRecordBuilder
     */
    public function setAction(string $action) : ActivityRecordBuilder
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return ActivityRecordBuilder
     */
    public function setDescription(string $description) : ActivityRecordBuilder
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate() : DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @param \DateTimeImmutable $date
     *
     * @return ActivityRecordBuilder
     */
    public function setDate(DateTimeImmutable $date) : ActivityRecordBuilder
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId() : int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     *
     * @return ActivityRecordBuilder
     */
    public function setUserId(int $userId) : ActivityRecordBuilder
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return \Uc\Recorder\Activity\GeographicInfo
     */
    public function getGeographicInfo() : GeographicInfo
    {
        return $this->geographicInfo;
    }

    /**
     * @param \Uc\Recorder\Activity\GeographicInfo $geographicInfo
     *
     * @return ActivityRecordBuilder
     */
    public function setGeographicInfo(GeographicInfo $geographicInfo) : ActivityRecordBuilder
    {
        $this->geographicInfo = $geographicInfo;

        return $this;
    }

    /**
     * @return \Uc\Recorder\Activity\UserAgent
     */
    public function getUserAgent() : UserAgent
    {
        return $this->userAgent;
    }

    /**
     * @param \Uc\Recorder\Activity\UserAgent $userAgent
     *
     * @return ActivityRecordBuilder
     */
    public function setUserAgent(UserAgent $userAgent) : ActivityRecordBuilder
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getActivityRecord() : ActivityRecord
    {
        $document = [];

        if (isset($this->action)) {
            $document['action'] = $this->getAction();
        }

        if (isset($this->description)) {
            $document['description'] = $this->getDescription();
        }

        if (isset($this->date)) {
            $document['date'] = $this->getDate();
        }

        if (isset($this->userId)) {
            $document['userId'] = $this->getUserId();
        }

        if (isset($this->geographicInfo)) {
            $document['geographicInfo'] = $this->getGeographicInfo();
        }

        if (isset($this->userAgent)) {
            $document['userAgent'] = $this->getUserAgent();
        }

        return new ActivityRecord($document);
    }
}
