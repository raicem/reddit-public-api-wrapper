<?php

namespace RedditWrapper\Queries;

use RedditWrapper\RedditWrapperException;

class UserQuery extends Query implements QueryInterface
{
    private const URL = self::BASE_URL.'/user/%s.json';

    /**
     * @var string
     */
    private $username;

    /**
     * Array of options must contain a subreddit value.
     */
    public function __construct(array $options)
    {
        $this->validate($options);

        $this->username = $options['username'];
    }

    /**
     * Creates a url to be used to fetch information about the subreddit.
     */
    public function url(): string
    {
        return sprintf(self::URL, $this->username);
    }

    private function validate($options): void
    {
        if (!array_key_exists('username', $options)) {
            throw new RedditWrapperException('Please give a username in the options');
        }
    }
}
