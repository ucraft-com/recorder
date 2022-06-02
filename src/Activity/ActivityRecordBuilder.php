<?php

declare(strict_types = 1);

namespace Uc\Recorder\Activity;

use DateTimeImmutable;
use ReflectionClass;
use Symfony\Component\Uid\Uuid;

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
    #[DocumentField]
    protected string $action;

    /**
     * @var string Description of the Activity.
     */
    #[DocumentField]
    protected string $description;

    /**
     * @var \DateTimeImmutable Datetime when the activity happened.
     */
    #[DocumentField]
    protected DateTimeImmutable $dateTime;

    /**
     * @var int Identifier of the user who generates the activity.
     */
    #[DocumentField]
    protected int $userId;

    /**
     * @var int Identifier of the project where the record was created.
     */
    #[DocumentField]
    protected int $projectId;

    /**
     * @var \Uc\Recorder\Activity\GeographicInfo Geographical data of the activity generator.
     */
    #[DocumentField]
    protected GeographicInfo $geographicInfo;

    /**
     * @var \Uc\Recorder\Activity\UserAgent Browser and Operating System related information of the activity generator.
     */
    #[DocumentField]
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

    public function getDateTime() : DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTimeImmutable $dateTime) : ActivityRecordBuilder
    {
        $this->dateTime = $dateTime;

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

    public function getProjectId() : int
    {
        return $this->projectId;
    }

    public function setProjectId(int $projectId) : ActivityRecordBuilder
    {
        $this->projectId = $projectId;

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
        $document = [
            'id' => Uuid::v4(),
        ];

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(DocumentField::class);
            $propertyName = $property->getName();

            if (!empty($attributes) && isset($this->$propertyName)) {
                $document[$propertyName] = $this->$propertyName;
            }
        }

        return new ActivityRecord($document);
    }
}
