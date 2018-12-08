<?php

namespace Payment;


abstract class ResponseLink
{
    private $link;
    protected $response;
    private $scheme;
    private $host;
    private $path;
    protected $queries = [];

    public function __construct($link)
    {
        $this->link = $link;
//        $this->response = $response;
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
        $queries = parse_url($this->link, PHP_URL_QUERY);
        if (!is_null($queries)) {
            parse_str($queries, $this->queries);
        }
        return $this;
    }

    private function analyseLink()
    {
        $this->setScheme()
            ->setHost()
            ->setPath()
            ->setQueries();
    }

    /**
     * @param array $response
     * @return $this
     */
    abstract public function makeResponseQueries(array $response = []);

    public function make()
    {
        $this->analyseLink();
        return $this->scheme . "://" . $this->host . $this->path . $this->response;

    }
}