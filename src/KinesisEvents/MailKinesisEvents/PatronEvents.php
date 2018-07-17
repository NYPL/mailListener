<?php
namespace NYPL\Services\KinesisEvents\MailKinesisEvents;

use NYPL\Services\KinesisEvents\MailKinesisEvents;
use NYPL\Services\Model\DataModel\StreamData\Patron;

class PatronEvents extends MailKinesisEvents
{
    /**
     * @param array $data
     *
     * @return Patron
     */
    public function getStreamData(array $data = [])
    {
        return new Patron($data);
    }

    /**
     * @return string
     */
    public function getSchemaName()
    {
        return 'Patron';
    }
}
