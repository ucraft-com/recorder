<?php

declare(strict_types = 1);

namespace Uc\Recorder;

/**
 * Interface of the record delivery transports.
 *
 * Each transport must have a unique identifier for further handling of records.
 */
interface RecordDeliveryTransportInterface
{
    /**
     * Return identifier of delivery transport.
     *
     * Identifier will be used on the consumer end to determine which transport should handle the record.
     *
     * @return string
     */
    public function getIdentifier() : string;

    /**
     * Return config of delivery transport.
     *
     * @return array
     */
    public function getConfig() : array;
}
