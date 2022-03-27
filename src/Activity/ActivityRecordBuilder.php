<?php

namespace Uc\Recorder\Activity;

use DateTimeImmutable;
use ReflectionClass;

/**
 * Builder class for creating ActivityRecord objects.
 *
 * @see \Uc\Recorder\Activity\ActivityRecord
 */
class ActivityRecordBuilder
{
    /**
     * @var string Action of the activity.
     */
    protected string $action;

    /**
     * @var string Description of the Activity.
     */
    protected string $description;

    /**
     * @var \DateTimeImmutable Datetime when the activity happened.
     */
    protected DateTimeImmutable $date;

    /**
     * @var int Identifier of the user who generates the activity.
     */
    protected int $userId;

    /**
     * @var \Uc\Recorder\Activity\GeographicInfo Geographical data of the activity generator.
     */
    protected GeographicInfo $geographicInfo;

    /**
     * @var \Uc\Recorder\Activity\UserAgent Browser and Operating System related information of the activity generator.
     */
    protected UserAgent $userAgent;

    public function getAction() : string
    {
        return $this->action;
    }

    public function setAction(string $action) : ActivityRecordBuilder
    {
        $this->action = $action;

        return $this;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : ActivityRecordBuilder
    {
        $this->description = $description;

        return $this;
    }

    public function getDate() : DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(DateTimeImmutable $date) : ActivityRecordBuilder
    {
        $this->date = $date;

        return $this;
    }

    public function getUserId() : int
    {
        return $this->userId;
    }

    public function setUserId(int $userId) : ActivityRecordBuilder
    {
        $this->userId = $userId;

        return $this;
    }

    public function getGeographicInfo() : GeographicInfo
    {
        return $this->geographicInfo;
    }

    public function setGeographicInfo(GeographicInfo $geographicInfo) : ActivityRecordBuilder
    {
        $this->geographicInfo = $geographicInfo;

        return $this;
    }

    public function getUserAgent() : UserAgent
    {
        return $this->userAgent;
    }

    public function setUserAgent(UserAgent $userAgent) : ActivityRecordBuilder
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Create instance of ActivityRecord based on the current configuration.
     *
     * @return \Uc\Recorder\Activity\ActivityRecord
     */
    public function getActivityRecord() : ActivityRecord
    {
        $reflection = new ReflectionClass($this);
        $document = [];

        foreach ($reflection->getProperties() as $property) {
            if ($property->isInitialized($this)) {
                $document[$property->getName()] = $property->getValue($this);
            }
        }

        return new ActivityRecord($document);
    }
}
