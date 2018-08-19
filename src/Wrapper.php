<?php

namespace RedditWrapper;

use RedditWrapper\Queries\QueryInterface;
use RedditWrapper\Queries\SubredditQuery;

class Wrapper
{
    private $client;

    public function __construct(WrapperClient $client)
    {
        $this->client = $client;
    }

    public function fetch(QueryInterface $query): array
    {
        $response = $this->client->request($query->url());

        return $response['data']['children'];
    }

    public function fetchSimplified(QueryInterface $query): array
    {
        $response = $this->fetch($query);

        $response = array_map(function ($item) {
            return [
                'title' => $item['data']['title'],
                'id' => $item['data']['id'],
                'thumbnail' => $item['data']['thumbnail'],
                'permalink' => $item['data']['permalink'],
                'num_comments' => $item['data']['num_comments'],
                'score' => $item['data']['score'],
                'created' => $item['data']['created'],
            ];
        }, $response);

        return $response;
    }

    public function __call($name, $arguments): array
    {
        $arguments['subreddit'] = $name;

        $query = new SubredditQuery($arguments);

        return $this->fetch($query);
    }
}
