<?php

declare(strict_types = 1);

namespace Uc\Recorder\Tests\Unit;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;
use Uc\Recorder\Activity\ActivityRecord;
use Uc\Recorder\Activity\ActivityRecordBuilder;
use Uc\Recorder\Activity\GeographicInfo;
use Uc\Recorder\Activity\UserAgent;
use Uc\Recorder\Tests\TestCase;
use Uc\Recorder\Transports\ElasticTransport;

class ActivityRecordBuilderTest extends TestCase
{
    public function testGetActivityRecord_CreatesValidObject() : void
    {
        $builder = $this->createBuilder();
        $geographicInfo = $this->createGeographicInfo();
        $userAgent = $this->createUserAgent();
        $dateTime = new DateTimeImmutable();

        $record = $builder
            ->setAction('Page created')
            ->setDescription('New page has been created.')
            ->setPayload(['name' => 'Some action happened!'])
            ->setDateTime($dateTime)
            ->setUserId(1)
            ->setProjectId(2)
            ->setGeographicInfo($geographicInfo)
            ->setUserAgent($userAgent)
            ->addTransport(new ElasticTransport())
            ->getActivityRecord();

        $this->assertInstanceOf(ActivityRecord::class, $record);

        $document = $record->getDocument();

        $this->assertEquals('Page created', $document['action']);
        $this->assertEquals('New page has been created.', $document['description']);
        $this->assertEquals(['name' => 'Some action happened!'], $document['payload']);
        $this->assertEquals($dateTime, $document['dateTime']);
        $this->assertEquals(1, $document['userId']);
        $this->assertEquals(2, $document['projectId']);
        $this->assertEquals($geographicInfo, $document['geographicInfo']);
        $this->assertEquals($userAgent, $document['userAgent']);
        $this->assertInstanceOf(Uuid::class, $document['id']);
    }

    protected function createBuilder() : ActivityRecordBuilder
    {
        return new ActivityRecordBuilder();
    }

    protected function createGeographicInfo() : GeographicInfo
    {
        return new GeographicInfo('0.0.0.0', 'New York', 'USA');
    }

    protected function createUserAgent() : UserAgent
    {
        return new UserAgent('chrome', 'Linux');
    }
}
