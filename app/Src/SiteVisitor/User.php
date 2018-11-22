<?php

namespace App\Src\SiteVisitor;

/**
 * Class User
 * @package App\Src\SiteVisitor
 * @property string ip
 */
class User
{
    /**
     * @var \stdClass $json
     */
    private $json;
    protected $fields_emulator = [
        'query' => 'ip',
        'country' => 'country',
        'city' => 'city',
        'regionName' => 'state'
    ];
    public $return;

    public function __construct(\stdClass $json)
    {
        $this->json = $json;
    }

    public function detect()
    {
        if (isset($this->json->status) && $this->json->status == "success") {
            $this->emulateFields();
            return $this;
        }
        return false;
    }

    private function emulateFields()
    {
        array_filter($this->fields_emulator, function ($return, $filed) {
            if (isset($this->json->{$filed})) {
                $this->return[$return] = $this->json->{$filed};
            }
        }, ARRAY_FILTER_USE_BOTH);
    }


    public function __get($name)
    {
        if (isset($this->return[$name])) {
            return $this->return[$name];
        }
        return null;
    }

}