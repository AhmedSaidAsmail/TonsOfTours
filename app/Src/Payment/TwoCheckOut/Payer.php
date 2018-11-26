<?php

namespace App\Src\Payment\TwoCheckOut;

use App\Src\Payment\Exception\NoArgumentGivenException;

class Payer
{
    /**
     * array fields Fields name
     */
    const fields = ["name", "addrLine1", "city", "state", "zipCode", "country", "email", "phoneNumber"
    ];
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
     * @param array $details
     * @return void
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Setting all payer properties according to given details array
     *
     */
    private function setProps()
    {
        array_map(function ($key) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $this->details[$key];
            }
        }, array_keys($this->details));
    }

    /**
     * Returning payer all details in array
     *
     * @return array
     */
    public function __toArray()
    {
        $this->setProps();
        $return = [];
        array_filter(self::fields, function ($field) use (&$return) {
            if (property_exists(self::class, $field) && !is_null($this->{$field})) {
                $return[$field] = $this->{$field};
            } else {
                throw new NoArgumentGivenException(sprintf('Can not find the %s key in given data', $field));
            }
        });
        return $return;

    }


}