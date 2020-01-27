<?php

namespace Chrsc\ExtractEmail;

use GuzzleHttp\Client;

class ExtractEmail
{

    public const EMAIL_REGEX = '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/';
    private $url;

    public function __construct(string $url = null)
    {
        if($url !== null) {
            $this->setUrl($url);
        }
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getEmail()
    {
        preg_match_all(SELF::EMAIL_REGEX, $this->getContents(), $matches);

        return $matches[0];
    }

    private function getContents()
    {
        $client = new Client();
        $response = $client->request('GET', $this->url);

        return $response->getBody();
    }
}