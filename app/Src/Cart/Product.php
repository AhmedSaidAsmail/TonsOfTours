<?php

namespace App\Src\Cart;

use App\Models\ProductInterface;
use App\Src\Payment\Payment;

class Product
{
    protected $fillable = [];
    /**
     * @var array $filledData Storing sent data
     */
    protected $filledData = [];
    /**
     * @var integer $total Price total due
     */
    public $total;
    /**
     * @var integer $deposit Deposit due
     */
    public $deposit;
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

    protected function setFilledData()
    {
        array_map(function ($filed) {
            if (array_key_exists($filed, $this->data)) {
                $this->filledData[$filed] = $this->data[$filed];
            }
        }, $this->fillable);
    }

    protected function setTotal()
    {
        if (array_key_exists('total', $this->data)) {
            $this->total = $this->data['total'];
            return $this;
        }
        throw new \RuntimeException('can not find total key in given array');
    }

    protected function setModel()
    {
        if (array_key_exists('model', $this->data)) {
            $this->model = $this->data['model'];
            return $this;
        }
        throw new \RuntimeException('can not find model key in given array');
    }

    protected function setDeposit()
    {
        $this->deposit = Payment::deposit($this->model, $this->total);
    }

//    public function getTotal()
//    {
//        return $this->total;
//    }

//    public function model()
//    {
//        return $this->model;
//    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->filledData)) {
            return $this->filledData[$name];
        }
        return null;
    }


}