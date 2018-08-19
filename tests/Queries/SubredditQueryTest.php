<?php

namespace Tests\Queries;

use PHPUnit\Framework\TestCase;
use RedditWrapper\Enums\SubredditSort;
use RedditWrapper\Enums\SubredditSortTime;
use RedditWrapper\Queries\SubredditQuery;
use RedditWrapper\RedditWrapperException;

class SubredditQueryTest extends TestCase
{
    public function test_subreddit_query_expects_array_of_options()
    {
        $this->expectException(\ArgumentCountError::class);

        new SubredditQuery();
    }

    public function test_subreddit_query_expects_subreddit_option()
    {
        $this->expectException(RedditWrapperException::class);

        new SubredditQuery([]);
    }

    public function test_subreddit_query_can_be_constructed_with_a_subreddit_option()
    {
        $subreddit = 'test';
        $query = new SubredditQuery(['subreddit' => $subreddit]);

        $attribute = $this->getObjectAttribute($query, 'subreddit');

        $this->assertEquals($subreddit, $attribute);
    }

    public function test_subreddit_query_can_be_constructed_with_a_sort_option()
    {
        $subreddit = 'test';
        $query = new SubredditQuery([
            'subreddit' => $subreddit,
            'sort' => SubredditSort::TOP,
        ]);

        $subredditAttribute = $this->getObjectAttribute($query, 'subreddit');
        $this->assertEquals($subreddit, $subredditAttribute);

        $sortAttribute = $this->getObjectAttribute($query, 'sort');
        $this->assertEquals(SubredditSort::TOP, $sortAttribute);
    }

    public function test_subreddit_query_can_be_constructed_with_a_sort_time_option()
    {
        $subreddit = 'test';
        $query = new SubredditQuery([
            'subreddit' => $subreddit,
            'sort' => SubredditSort::TOP,
            'sortTime' => SubredditSortTime::WEEK,
        ]);

        $subredditAttribute = $this->getObjectAttribute($query, 'subreddit');
        $this->assertEquals($subreddit, $subredditAttribute);

        $sortAttribute = $this->getObjectAttribute($query, 'sort');
        $this->assertEquals(SubredditSort::TOP, $sortAttribute);

        $sortTimeAttribute = $this->getObjectAttribute($query, 'sortTime');
        $this->assertEquals(SubredditSortTime::WEEK, $sortTimeAttribute);
    }

    public function test_subreddit_query_can_generate_the_request_url()
    {
        $expectedUrl = 'https://www.reddit.com/r/formula1/top.json?t=all';

        $query = new SubredditQuery([
            'subreddit' => 'formula1',
            'sort' => SubredditSort::TOP,
            'sortTime' => SubredditSortTime::ALL,
        ]);

        $this->assertEquals($expectedUrl, $query->url());
    }

    public function test_subreddit_query_can_not_be_instantiated_with_wrong_sort_option()
    {
        $this->expectException(RedditWrapperException::class);

        new SubredditQuery([
            'subreddit' => 'formula1',
            'sort' => 'invalid',
        ]);
    }

    public function test_subreddit_query_can_not_be_instantiated_with_wrong_sort_time_option()
    {
        $this->expectException(RedditWrapperException::class);

        new SubredditQuery([
            'subreddit' => 'formula1',
            'sort' => SubredditSort::TOP,
            'sortTime' => 'invalid',
        ]);
    }
}
