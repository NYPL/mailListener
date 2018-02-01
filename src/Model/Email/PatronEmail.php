<?php
namespace NYPL\Services\Model\Email;

use NYPL\Services\Model\DataModel\StreamData\Patron;
use NYPL\Services\Model\Email;

class PatronEmail extends Email
{
    public function getSubject()
    {
        return 'NYPL Registration Confirmation';
    }

    public function getFromAddress()
    {
        return 'nypllibrarycard@nypl.org';
    }

    public function getTemplate()
    {
        return 'patron.twig';
    }

    public function getToAddress()
    {
        /**
         * @var Patron $patron
         */
        $patron = $this->getStreamData();

        return trim($patron->getSimplePatron()->getEmail());
    }
}
