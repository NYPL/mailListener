<?php
namespace NYPL\Services\Model\DataModel\StreamData\NewPatron; //ljc

use NYPL\Services\Model\DataModel\StreamData\NewPatron; //ljc

class NewPatron extends StreamData
{
    public $patronId = '';

    public $barcode = '';

    public $name = '';

    public $firstName = '';

    public $birthdate = '';

    public $email = '';

    public $workOrSchoolAddress = '';

    public $username = '';

    public $pin = '';

    /**
     *
     * @var Address
     */
    public $address;

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        $this->setFirstName($this->deriveFirstName($name));
    }

    /**
     *
     * @param string $name
     *
     * @return bool|string
     */
    protected function deriveFirstName($name = '')
    {
        if (strpos($name, ',') !== false) {
            return substr($name, strpos($name, ',') + 1);
        }

        return $name;
    }

    /**
     *
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     *
     * @param string $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     * @return string
     */
    public function getWorkOrSchoolAddress()
    {
        return $this->workOrSchoolAddress;
    }

    /**
     *
     * @param string $workOrSchoolAddress
     */
    public function setWorkOrSchoolAddress($workOrSchoolAddress)
    {
        $this->workOrSchoolAddress = $workOrSchoolAddress;
    }

    /**
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     *
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     *
     * @param string $pin
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
    }

    /**
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     *
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     *
     * @param array|string $data
     *
     * @return Address
     */
    public function translateAddress($data)
    {
        return new Address($data, true);
    }

    /**
     *
     * @return string
     */
    public function getPatronId()
    {
        return $this->patronId;
    }

    /**
     *
     * @param string $patronId
     */
    public function setPatronId($patronId)
    {
        $this->patronId = $patronId;
    }

    /**
     *
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     *
     * @param string $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
}
