<?php

declare(strict_types = 1);

namespace Uc\Recorder;

/**
 * Interface of the record delivery transports.
 *
 * Each transport must have identifier for further corresponding handling of record.
 */
interface RecordDeliveryTransportInterface
{
    /**
     * Returns identifier of delivery transport.
     *
     * Identifier will be used on the consumer end to determine which transport
     * should handle record.
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
