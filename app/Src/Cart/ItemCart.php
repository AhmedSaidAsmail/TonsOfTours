<?php


namespace App\Src\Cart;


class ItemCart implements CartInterface
{
    public $item_id;
    public $title;
    public $date;
    public $total;
    public $currency;
    public $st_num;
    public $st_price;
    public $st_name;
    public $sec_num;
    public $sec_price;
    public $sec_name;
    /**
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    private $model;
    /**
     * @var array $data
     */
    private $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function init()
    {
        $this->setProperties(array_keys(get_object_vars($this)));
    }

    private function setProperties(array $properties)
    {
        foreach ($properties as $property) {
            if (array_key_exists($property, $this->data) && $property != 'data') {
                $this->{$property} = $this->data[$property];
            } else {
                if ($property !== "data") {
                    throw new \RuntimeException(sprintf('can not find this %s in given data', $property));
                }
            }
        }
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function model()
    {
        return $this->model;
    }


}