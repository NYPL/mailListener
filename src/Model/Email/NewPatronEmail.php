<?php
namespace NYPL\Services\Model\Email;

use NYPL\Services\Model\DataModel\StreamData\NewPatron\NewPatron;
use NYPL\Services\Model\Email;

class NewPatronEmail extends Email
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
        return 'new_patron.twig';
    }

    public function getToAddress()
    {
        /**
         *
         * @var NewPatron $patron
         */
        $newPatron = $this->getStreamData();

        return trim($newPatron->getEmail());
    }
}
