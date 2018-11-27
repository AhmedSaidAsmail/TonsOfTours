<?php

namespace App\Src\Cart;

use App\Models\ProductInterface;
use App\Src\Deposit\Deposit;

class Product
{
    protected $fillable = [];
    /**
     * @var array $filledData Storing sent data
     */
    protected $filledData = [];
    /**
     * @var array $reservationData Data for reservation model
     */
    protected $reservationData = [];
//    /**
//     * @var integer $total Price total due
//     */
//    public $total;
//    /**
//     * @var integer $deposit Deposit due
//     */
//    public $deposit;
    /**
     * @var ProductInterface $model
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
        $this->setFilledData();
        $this->setTotal()
            ->setModel()
            ->setDeposit();
    }

    private function setFilledData()
    {
        array_map(function ($filed) {
            if (array_key_exists($filed, $this->data)) {
                $this->filledData[$filed] = $this->data[$filed];
            }
        }, $this->fillable);
    }

    private function setTotal()
    {
        if (array_key_exists('total', $this->data)) {
            $this->filledData['total'] = $this->data['total'];
            return $this;
        }
        throw new \RuntimeException('can not find total key in given array');
    }

    private function setDeposit()
    {
        $this->filledData['deposit'] = Deposit::deposit($this->model, $this->total);
    }

    private function setModel()
    {
        if (array_key_exists('model', $this->data)) {
            $this->model = $this->data['model'];
            return $this;
        }
        throw new \RuntimeException('can not find model key in given array');
    }


    public function __get($name)
    {
        if (array_key_exists($name, $this->filledData)) {
            return $this->filledData[$name];
        }
        return null;
    }

    public function __toArray()
    {
        $return = [];
        array_map(function ($field) use (&$return) {
            if (array_key_exists($field, $this->filledData)) {
                $return[$field] = $this->filledData[$field];
            }
        }, $this->reservationData);
        return $return;
    }


}