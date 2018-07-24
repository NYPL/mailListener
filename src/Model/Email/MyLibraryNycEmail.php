<?php
namespace NYPL\Services\Model\Email;

use NYPL\Services\Model\DataModel\StreamData\NewPatron\NewPatron;
use NYPL\Services\Model\Email;

class MyLibraryNycEmail extends Email
{
    public function getSubject()
    {
        return 'Welcome to MyLibraryNYC';
    }

    public function getFromAddress()
    {
        return 'help@mylibrarynyc.org';
    }

    public function getTemplate()
    {
        return 'my_library_nyc.twig';
    }

    public function getToAddress()
    {
        /**
         * @var NewPatron $newPatron
         */
        $newPatron = $this->getStreamData();

        return $newPatron->getPrimaryEmail();
    }

    public function getBccAddress()
    {
        return 'mylibrarynyc@nypl.org';
    }
}
