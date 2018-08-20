<?php

namespace RedditWrapper;

use RedditWrapper\Queries\QueryInterface;
use RedditWrapper\Queries\SubredditQuery;

class Wrapper
{
    private $client;

    /**
     * WrapperClient contains the curl logic. It is injected to the Wrapper class
     * mainly for seperating the logic and allowing easier testing.
     */
    public function __construct(WrapperClient $client)
    {
        $this->client = $client;
    }

    public function fetch(QueryInterface $query): array
    {
        $response = $this->client->request($query->url());

        return $response['data']['children'];
    }

    /**
     * Reddit returns a very big array about the information of the subreddits posts.
     * This method fetches the subreddit information as usual but then filters
     * some very detailed information.
     */
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

    /**
     * This magic method allows wrapper to accept queries such as $wrapper->formula1().
     * This a shorthand usage for the subreddit query. You can pass options to this
     * method as if you are creating a SubredditQuery.
     */
    public function __call($name, $arguments): array
    {
        $arguments['subreddit'] = $name;

        $query = new SubredditQuery($arguments);

        return $this->fetch($query);
    }
}
