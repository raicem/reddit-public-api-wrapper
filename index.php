<?php

require 'vendor/autoload.php';

use RedditWrapper\Enums\SubredditSort;
use RedditWrapper\Enums\SubredditSortTime;
use RedditWrapper\Wrapper;
use RedditWrapper\WrapperClient;
use RedditWrapper\Queries\SubredditQuery;

/*$query = new SubredditQuery([
    'subreddit' => 'formula1',
    'sort' => \RedditWrapper\Enums\SubredditSort::TOP,
    'sortTime' => \RedditWrapper\Enums\SubredditSortTime::WEEK,
]);

$wrapper = new Wrapper(new WrapperClient());
$response = $wrapper->fetchSimplified($query);

echo json_encode($response);*/

$wrapper = new Wrapper(new WrapperClient());

$response = $wrapper->formula1(['sort' => SubredditSort::TOP, 'sortTime' => SubredditSortTime::WEEK]);
