<?php

namespace App\Src\Payment\TwoCheckOut;


class ResponseLink
{
    private $link;
    private $response;
    private $scheme;
    private $host;
    private $path;
    private $queries;

    public function __construct($link, array $response)
    {
        $this->link = $link;
        $this->response = $response;
    }

    private function setScheme()
    {
        $this->scheme = parse_url($this->link, PHP_URL_SCHEME);
        return $this;
    }

    private function setHost()
    {
        $this->host = parse_url($this->link, PHP_URL_HOST);
        return $this;
    }

    private function setPath()
    {
        $this->path = parse_url($this->link, PHP_URL_PATH);
        return $this;
    }

    private function setQueries()
    {
        parse_str(parse_url($this->link, PHP_URL_QUERY), $this->queries);
        return $this;
    }

    private function analyseLink()
    {
        $this->setScheme()
            ->setHost()
            ->setPath()
            ->setQueries();
    }

    private function makeResponseQueries()
    {
        if ($this->response['responseCode'] == "APPROVED") {
            $query = http_build_query(array_merge($this->queries
                , [
                    'paymentId' => $this->response['transactionId'],
                    'orderNumber' => $this->response['orderNumber'],
                    'payment_method' => "2_check_out"
                ]));
            return "?" . $query;
        }
        return null;
    }

    public function make()
    {
        $this->analyseLink();
        return $this->scheme . "://" . $this->host . $this->path . $this->makeResponseQueries();

    }
}