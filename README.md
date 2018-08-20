Reddit Public API PHP Wrapper
===

Reddit provides a very convenient access to its data just by adding `.json` to the end of normal URLs. For example, `https://www.reddit.com/r/formula1.json` will present you the json response.

This is a very simple wrapper to easily access subreddit and user data. 

### 1. Installation

Install it as a dependency using [Composer](https://getcomposer.org/)

```bash
composer require raicem/reddit-wrapper
```

### 2. Instantiate
```php

use RedditWrapper\Wrapper;
use RedditWrapper\WrapperClient;

$wrapper = new Wrapper(new WrapperClient());

```

### 3. Queries
#### 3.1 Subreddit Query
Fetches information about certain Subreddit.

```php

use RedditWrapper\Queries\SubredditQuery;
use RedditWrapper\Enums\SubredditSort;
use RedditWrapper\Enums\SubredditSortTime;

$query = new SubredditQuery([
    'subreddit' => 'formula1',
]);

$response = $wrapper->fetch($query);

```

You may add sort options to your query for best, top, rising, controversial posts in a subreddit.

```php

use RedditWrapper\Queries\SubredditQuery;
use RedditWrapper\Enums\SubredditSort;
use RedditWrapper\Enums\SubredditSortTime;

$query = new SubredditQuery([
    'subreddit' => 'formula1',
    'sort' => SubredditSort::TOP,
    'sortTime' => SubredditSortTime::WEEK,
]);

$response = $wrapper->fetch($query);

```

#### 3.1 User Query

Fetches the feed belonging to the user.

```php

use RedditWrapper\Queries\UserQuery;

$query = new UserQuery([
    'username' => 'unidan',
]);

$response = $wrapper->fetch($query);

```

All of the queries extend the `QueryInterface` in the library. So you can implement your own query in your code base and then provide this query to the `Wrapper`.

### 4. Magic Stuff
#### 4.1 __call method on the Wrapper

I believe the main function of this library to fetch Subreddit information. I wanted to streamline that functionality as much as possible. 

So without creating a new query you can call the Subreddit's name as a method on this wrapper.

```php

use RedditWrapper\Wrapper;
use RedditWrapper\WrapperClient;

$wrapper = new Wrapper(new WrapperClient());

$response = $wrapper->formula1();

```
#### 4.2 `fetchSimple` methon on Wrapper
When fetching subreddit information, Reddit sends a lot of information that mostly will not be needed. This can very difficult the get through. fetchSimple method filters certain properties so that you are presented with a cleaner response. 

```php

$query = new SubredditQuery([
    'subreddit' => 'formula1',
    'sort' => SubredditSort::TOP,
    'sortTime' => SubredditSortTime::WEEK,
]);

$response = $wrapper->fetchSimple($query);

```

`fetchSimple` method returns these values.

| Value        |
| ------------ |
| title        |
| id           |
| thumbnail    |
| permalink    |
| num_comments |
| score        |
| created      |
