<?php

return [
    /*
     | Name of the  Kafka topic where activity logs should be stored.
     */
    'sink_topic'     => env('RECORDER_KAFKA_SINK_TOPIC', ''),

    /*
     | Name of the Elasticsearch index where data should be accumulated.
     */
    'activity_index' => env('RECORDER_ACTIVITY_INDEX', 'activity'),
];
