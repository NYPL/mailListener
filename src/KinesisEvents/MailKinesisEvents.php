<?php
namespace NYPL\Services\KinesisEvents;

use NYPL\Services\Model\DataModel\StreamData;
use NYPL\Starter\Listener\ListenerEvents\KinesisEvents;

abstract class MailKinesisEvents extends KinesisEvents
{
    /**
     * @param array $data
     *
     * @return StreamData
     */
    abstract public function getStreamData(array $data = []);
}
