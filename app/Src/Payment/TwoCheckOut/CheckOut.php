<?php

namespace App\Src\Payment\TwoCheckOut;

use App\Src\Payment\Exception\NoSettingFoundException;
use App\Src\Payment\Exception\PaymentException;
use App\Src\Payment\PaymentGateway;
use Twocheckout;
use Twocheckout_Charge;
use Illuminate\Http\Request;
use App\Models\TwoCheckOut as TowCheckOutModel;

class CheckOut implements PaymentGateway
{
    /**
     * @var string $privateKey 2CheckOut Private Key
     */
    private $privateKey;
    /**
     * @var string $sellerId 2CheckOut Seller Id
     */
    public $sellerId;
    /**
     * @var bool $verifySSL
     */
    private $verifySSL;
    /**
     * @var bool $sandbox
     */
    private $sandbox;
    /**
     * @var string $currency
     */
    public $currency;
    /**
     * @var Request $request
     */
    /**
     * @var Payer $billingAddr ;
     */
    public $billingAddr;
    /**
     * @var Payer $shippingAddr ;
     */
    public $shippingAddr;
    /**
     * @var Seller $seller
     */
    private $seller;
    /**
     * @var int $total
     */
    public $total;
    /**
     * @var Request $request
     */
    public $request;
    /**
     * @var string $successLink Success link redirect
     */
    private $successLink;
    /**
     * @var string $failureLink Failure link redirect
     */
    private $failureLink;

    /**
     * CheckOut constructor.
     * @param Request $request
     * @param int $total
     * @param string $successLink
     * @param string $failureLink
     * @return void
     */
    public function __construct(Request $request, $total, $successLink, $failureLink)
    {
        $this->request = $request;
        $this->total = $total;
        $this->successLink = $successLink;
        $this->failureLink = $failureLink;
    }

    /**
     * @return void
     * @throws NoSettingFoundException
     */
    public function init()
    {
        if ($this->checkModelSetting() !== false) {
            $this->setCheckOutSettings($this->checkModelSetting());
            return;
        }
        throw new NoSettingFoundException('No setting found for 2Checkout Payment Gateway in your Database');
    }

    /**
     * @return TowCheckOutModel|bool
     */
    private function checkModelSetting()
    {
        $seating = TowCheckOutModel::first();
        if (!is_null($seating)) {
            return $seating;
        }
        return false;
    }

    /**
     * @param TowCheckOutModel $settingModel
     */
    private function setCheckOutSettings(TowCheckOutModel $settingModel)
    {
        $this->sellerId = $settingModel->partner_id;
        $this->privateKey = $settingModel->private_key;
        $this->verifySSL = $settingModel->ssl;
        $this->sandbox = $settingModel->sandbox;
        $this->currency = $settingModel->currency;
    }

    private function setPayerGivenArray($detailsKey)
    {
        $billingAddress = [];
        if ($this->request->has($detailsKey)) {
            $billingAddress = $this->request->get($detailsKey);
        }
        return array_merge(['email' => $this->request->get('email'),
                'phoneNumber' => $this->request->get('phone'),
                'name' => $this->request->get('credit')['name'],
                'country' => $this->request->get('credit')['country']]
            , $billingAddress);

    }

    /**
     * @return array|false|mixed|string
     * @throws PaymentException
     */
    public function pay()
    {
        $this->billingAddr = new Payer($this->setPayerGivenArray('billingAddress'));
        $this->shippingAddr = new Payer($this->setPayerGivenArray('shippingAddress'));
        $this->seller = new Seller($this);
//        return $this->shippingAddr;
        return $this->checkOutPay($this->seller->__toArray());

    }

    /**
     * @param array $sellerDetails
     * @return array|false|mixed|string
     * @throws PaymentException
     */
    public function checkOutPay(array $sellerDetails)
    {
        try {
            Twocheckout::privateKey($this->privateKey);
            Twocheckout::sellerId($this->sellerId);
            Twocheckout::verifySSL($this->verifySSL);
            Twocheckout::sandbox($this->sandbox);
            $charge = Twocheckout_Charge::auth($sellerDetails, 'array');
            return (new ResponseLink($this->successLink, $charge['response']))->make();

        } catch (\Exception $e) {
            throw new PaymentException($e->getMessage());
        }

    }

    /**
     * @param array $data
     * @return null|string
     */
    protected function analysisResponseQueries(array $data)
    {
        if ($data['responseCode'] == "APPROVED") {
            $query = http_build_query([
                'paymentId' => $data['transactionId'],
                'orderNumber' => $data['orderNumber']
            ]);
            return $query;
        }
        return null;
    }

}