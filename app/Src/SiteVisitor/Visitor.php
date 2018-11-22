<?php

namespace App\Src\SiteVisitor;


class Visitor
{
    const api_link = "http://ip-api.com/json";
    private $json;

    public function __construct()
    {
        $this->json = json_decode(file_get_contents(self::api_link));

    }

    /**
     * @return User|bool
     */
    public function detect()
    {
        $user = new User($this->json);
        return $user->detect();
    }

}