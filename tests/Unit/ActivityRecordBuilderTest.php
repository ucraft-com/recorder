<?php

declare(strict_types = 1);

namespace Uc\Recorder\Tests\Unit;

use DateTimeImmutable;
use Uc\Recorder\Activity\ActivityRecord;
use Uc\Recorder\Activity\ActivityRecordBuilder;
use Uc\Recorder\Activity\GeographicInfo;
use Uc\Recorder\Activity\UserAgent;
use Uc\Recorder\Tests\TestCase;

class ActivityRecordBuilderTest extends TestCase
{
    public function testGetActivityRecord_CreatesValidObject() : void
    {
        $builder = $this->createBuilder();
        $geographicInfo = $this->createGeographicInfo();
        $userAgent = $this->createUserAgent();
        $date = new DateTimeImmutable();

        $record = $builder
            ->setAction('Page created')
            ->setDescription('New page has been created.')
            ->setDate($date)
            ->setUserId(1)
            ->setGeographicInfo($geographicInfo)
            ->setUserAgent($userAgent)
            ->getActivityRecord();

        $this->assertInstanceOf(ActivityRecord::class, $record);
        $this->assertEquals(
            [
                'action'         => 'Page created',
                'description'    => 'New page has been created.',
                'date'           => $date,
                'userId'         => 1,
                'geographicInfo' => $geographicInfo,
                'userAgent'      => $userAgent
            ],
            $record->getDocument()
        );
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
