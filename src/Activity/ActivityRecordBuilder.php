<?php

declare(strict_types = 1);

namespace Uc\Recorder\Activity;

use DateTimeImmutable;
use ReflectionClass;
use RuntimeException;
use Symfony\Component\Uid\Uuid;
use Uc\Recorder\RecordDeliveryTransportInterface;

use function array_values;

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
     * @var array|null Payload of the Activity. Can be empty.
     */
    #[DocumentField]
    protected array|null $payload = null;

    /**
     * @var \DateTimeImmutable Datetime when the activity happened.
     */
    #[DocumentField]
    protected DateTimeImmutable $dateTime;

    /**
     * @var array User who generates the activity.
     */
    #[DocumentField]
    protected array $user;

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

    /**
     * @var array List of the transports that should send data on the consumer end to handle the record.
     */
    protected array $transports;

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

    public function getPayload() : array|null
    {
        return $this->payload;
    }

    public function setPayload(array|null $payload) : ActivityRecordBuilder
    {
        $this->payload = $payload;

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

    public function getUser() : array
    {
        return $this->user;
    }

    public function setUser(array $user) : ActivityRecordBuilder
    {
        $this->user = $user;

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

    public function getTransports() : array
    {
        return $this->transports;
    }

    public function setTransports(array $transports) : ActivityRecordBuilder
    {
        foreach ($transports as $transport) {
            $this->addTransport($transport);
        }

        return $this;
    }

    public function addTransport(RecordDeliveryTransportInterface $transport) : ActivityRecordBuilder
    {
        $this->transports[$transport->getIdentifier()] = $transport;

        return $this;
    }

    public function removeTransport(RecordDeliveryTransportInterface $transport) : ActivityRecordBuilder
    {
        unset($this->transports[$transport->getIdentifier()]);

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

        $transports = $this->getTransports();

        if (empty($transports)) {
            throw new RuntimeException('Impossible to create a record without transports.');
        }

        return new ActivityRecord($document, array_values($transports));
    }
}
