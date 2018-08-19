<?php

namespace RedditWrapper\Queries;

use RedditWrapper\Enums\SubredditSort;
use RedditWrapper\Enums\SubredditSortTime;
use RedditWrapper\RedditWrapperException;

class SubredditQuery extends Query implements QueryInterface
{
    private const URL = self::BASE_URL.'/r/%s/%s.json';

    /**
     * @var string
     */
    private $subreddit;

    /**
     * @var string
     */
    private $sort = 'best';

    /**
     * @var string
     */
    private $sortTime;

    public function __construct(array $options)
    {
        $this->validate($options);

        $this->subreddit = $options['subreddit'];

        if (!empty($options['sort'])) {
            $this->sort = $options['sort'];
        }

        if ('top' === $this->sort && !empty($options['sortTime'])) {
            $this->sortTime = $options['sortTime'];
        }
    }

    public function url(): string
    {
        $url = sprintf(self::URL, $this->subreddit, $this->sort);

        if ($this->sortTime) {
            $url = $url.'?t='.$this->sortTime;
        }

        return $url;
    }

    private function validate($options): void
    {
        if (!array_key_exists('subreddit', $options)) {
            throw new RedditWrapperException('Please give subreddit in the options');
        }

        if (!empty($options['sort']) && SubredditSort::isNotValid($options['sort'])) {
            throw new RedditWrapperException('Sort option is not valid.');
        }

        if (!empty($options['sortTime']) && SubredditSortTime::isNotValid($options['sortTime'])) {
            throw new RedditWrapperException('Sort option is not valid.');
        }
    }
}
