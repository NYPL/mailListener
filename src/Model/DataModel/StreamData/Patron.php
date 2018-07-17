<?php
namespace NYPL\Services\Model\DataModel\StreamData;

use NYPL\Services\Model\DataModel\StreamData;

class Patron extends StreamData
{
    /**
     * @var SimplePatron
     */
    public $simplePatron;

    /**
     * @return SimplePatron
     */
    public function getSimplePatron()
    {
        return $this->simplePatron;
    }

    /**
     *
     * @param SimplePatron $simplePatron
     */
    public function setSimplePatron($simplePatron)
    {
        $this->simplePatron = $simplePatron;
    }

    /**
     *
     * @param array|string $data
     *
     * @return SimplePatron
     */
    public function translateSimplePatron($data)
    {
        return new SimplePatron($data, true);
    }
}
