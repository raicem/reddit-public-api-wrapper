<?php

namespace RedditWrapper;

class WrapperClient
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function request(string $url): array
    {
        // TODO: Look for all the possible curl options
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, '15');
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($this->curl);

        if (false === $result) {
            $errorMessage = 'Curl error'.curl_error($this->curl);
            throw new RedditWrapperException($errorMessage);
        }

        return json_decode($result, true);
    }
}
