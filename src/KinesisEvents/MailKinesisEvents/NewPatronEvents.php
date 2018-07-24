<?php
namespace NYPL\Services\KinesisEvents\MailKinesisEvents;

use NYPL\Services\KinesisEvents\MailKinesisEvents;
use NYPL\Services\Model\DataModel\StreamData\NewPatron\NewPatron;

class NewPatronEvents extends MailKinesisEvents
{
    /**
     * @param array $data
     *
     * @return NewPatron
     */
    public function getStreamData(array $data = [])
    {
        return new NewPatron($data);
    }

    /**
     * @return string
     */
    public function getSchemaName()
    {
        return 'NewPatron';
    }
}
