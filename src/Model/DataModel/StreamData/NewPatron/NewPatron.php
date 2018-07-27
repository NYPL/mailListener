<?php
namespace NYPL\Services\Model\DataModel\StreamData\NewPatron;

use NYPL\Services\Model\DataModel\StreamData;

class NewPatron extends StreamData
{
    /**
     * @var int
     */
    public $id = 0;

    /**
     * @var array
     */
    public $names = [];

    /**
     * @var array
     */
    public $barcodes = [];

    /**
     * @var string
     */
    public $expirationDate = '';

    /**
     * @var string
     */
    public $birthDate = '';

    /**
     * @var array
     */
    public $emails = [];

    /**
     * @var string
     */
    public $pin = '';

    /**
     * @var int
     */
    public $patronType = 0;

    public $patronCodes;

    public $blockInfo;

    public $addresses;

    public $phones;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param array $names
     */
    public function setNames($names)
    {
        $this->names = $names;
    }

    /**
     * @return array
     */
    public function getBarcodes()
    {
        return $this->barcodes;
    }

    /**
     * @param array $barcodes
     */
    public function setBarcodes($barcodes)
    {
        $this->barcodes = $barcodes;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param array $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    /**
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @param string $pin
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
    }

    /**
     * @return int
     */
    public function getPatronType()
    {
        return $this->patronType;
    }

    /**
     * @param int $patronType
     */
    public function setPatronType($patronType)
    {
        $this->patronType = $patronType;
    }

    /**
     * @return string
     */
    public function getPrimaryEmail()
    {
        return $this->getEmails()[0];
    }

    /**
     * @return string
     */
    public function getPrimaryBarcode()
    {
        return $this->getBarcodes()[0];
    }

    /**
     * @return string
     */
    public function getPrimaryName()
    {
        return $this->getNames()[0];
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        $explodedName = explode(',', $this->getPrimaryName());

        return isset($explodedName[1]) ? trim($explodedName[1]) : '';
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        $explodedName = explode(',', $this->getPrimaryName());

        return trim($explodedName[0]);
    }
}
