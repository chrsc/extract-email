<?php

namespace Chrsc\ExtractEmail;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class ExtractEmail
{

    public const EMAIL_REGEX = '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/';
    public const URL_REGEX = '/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)/';

    /** @var string */
    private $url;

    public function __construct(string $url = null)
    {
        if($url !== null) {
            $this->setUrl($url);
        }
    }

    /**
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $this->validateUrl($url) ? $url : null;

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getEmail(): array
    {
        if ($this->url === null) {
            return [];
        }
        \preg_match_all(SELF::EMAIL_REGEX, $this->getContents(), $matches);

        return $matches[0];
    }

    /**
     * @return string
     */
    private function getContents(): string
    {
        $client = new Client();
        try {
            $response = $client->request('GET', $this->url);
            if ($response->getStatusCode() === 200) {
                return $response->getBody();
            }
        } catch (ClientException $clientException) {
            \Log::error($clientException->getCode() . $clientException->getMessage());
        } catch (RequestException $requestException) {
            \Log::error($requestException->getCode() . $requestException->getMessage());
        }

        return '';
    }

    /**
     * @return bool
     */
    private function validateUrl(string $url): bool
    {
        if(\preg_match(self::URL_REGEX, $url) === 0) {
            return (bool) \preg_match(self::URL_REGEX, 'http://' . $url);
        }

        return true;
    }
}