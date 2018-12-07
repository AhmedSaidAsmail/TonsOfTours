<?php

namespace Payment\TwoCheckOut;

use Illuminate\Http\Request;
use Payment\Exception\NoArgumentGivenException;

class Payer
{
    /**
     * @var array $fillable All Returning Data
     */
    private $fillable = ["name", "addrLine1", "city", "state", "zipCode", "country", "email", "phoneNumber"];
    /**
     * @var array $requiredFields Required fields to processed Payment
     */
    private $requiredFields = ['email', 'name', 'phone', 'country'];
    /**
     * @var string $request_key Request key reserved for bayer details
     */
    private $request_key;
    /**
     * @var Request $request Given Data
     */
    private $request;
    /**
     * @var string $city
     */
    private $city = 'No_City';
    /**
     * @var string $state
     */
    private $state = 'No_State';
    /**
     * @var string $zipCode
     */
    private $zipCode = '22112';
    /**
     * @var string $addrLine1
     */
    private $addrLine1 = "No_Add";
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var string $country
     */
    private $country;
    /**
     * @var string $email
     */
    private $email;
    /**
     * @var string $phoneNumber
     */
    private $phoneNumber;
    /**
     * @var array $details sent data
     */
    private $details;

    /**
     * Payer constructor.
     * @param Request $request
     * @param string $request_key
     */
    public function __construct(Request $request, $request_key)
    {
        $this->request = $request;
        $this->request_key = $request_key;
        $this->details = $this->initialData();
    }

    /**
     * Initial given data from request
     *
     * @return array
     */
    private function initialData()
    {
        $address = [];
        if ($this->request->has($this->request_key)) {
            $address = $this->request->get($this->request_key);
        }
        return $address;

    }

    /**
     * Check if Data has the key
     *
     * @param $key
     * @return bool
     */
    private function addressHasKey($key)
    {
        return array_key_exists($key, $this->details);
    }

    /**
     * Setting field from the request if not exists in given data
     *
     * @param $key
     * @return mixed
     * @throws NoArgumentGivenException
     */
    private function setKeyFromRequest($key)
    {
        if ($this->request->has($key)) {
            return $this->request->get($key);
        }
        throw new NoArgumentGivenException(sprintf('Request has no given %s', $key));
    }

    /**
     *Setting the Payer key
     *
     * @param $key
     */
    private function setAddressKey($key)
    {
        if (!$this->addressHasKey($key)) {
            $this->details[$key] = $this->setKeyFromRequest($key);
        }
    }

    /**
     * Checking and Setting the required fields
     *
     * @return $this
     */
    private function setRequiredFields()
    {
        array_map(function ($field) {
            $this->setAddressKey($field);
        }, $this->requiredFields);
        return $this;
    }

    /**
     * Setting Payer Properties
     *
     */
    private function setProperties()
    {
        array_map(function ($field) {
            if (property_exists(slef::class, $field)) {
                $this->setProperty($field);
            }

        }, $this->fillable);
    }

    /**
     * Setting Specified Property
     *
     * @param $property
     */
    private function setProperty($property)
    {
        if ($this->addressHasKey($property)) {
            $this->{$property} = $this->details[$property];
        }
    }

    /**
     * Returning payer all details in array
     *
     * @return array
     */
    public function __toArray()
    {
        $this->setRequiredFields()
            ->setProperties();
        $return = [];
        array_filter($this->fillable, function ($field) use (&$return) {
            if (property_exists(self::class, $field) && !is_null($this->{$field})) {
                $return[$field] = $this->{$field};
            } else {
                throw new NoArgumentGivenException(sprintf('Can not find the %s key in given data', $field));
            }
        });
        return $return;

    }


}