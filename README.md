Reddit Public API PHP Wrapper
===

Reddit provides a very convenient access to its data just by adding `.json` to the end of normal URLs. For example, `https://www.reddit.com/r/formula1.json` will present you the json response.

This is a very simple wrapper to easily access subreddit and user data. 

### 1. Installation

Install it as a dependency using [Composer](https://getcomposer.org/)

```bash
composer require raicem/reddit-public-api-wrapper
```

### 2. Instantiate
```php

use RedditWrapper\Wrapper;
use RedditWrapper\WrapperClient;

$wrapper = new Wrapper(new WrapperClient());

```

### 3. Queries
#### 3.1 Subreddit Query
Fetches information about a certain subreddit.

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
You may use the constants provided with the `RedditWrapper\Enums\SubredditSort` and `RedditWrapper\Enums\SubredditSortTime`.

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

Fetches the feed belonging to a user.

```php

use RedditWrapper\Queries\UserQuery;

$query = new UserQuery([
    'username' => 'unidan',
]);

$response = $wrapper->fetch($query);

```

All of these queries extends the `QueryInterface` in the package. So you can create your own query implementing `QueryInterface` in your code base and then provide it to the `Wrapper`.

### 4. Magic Stuff
#### 4.1 __call method on the Wrapper

I believe the main function of this library will be to fetch subreddit information. I wanted to streamline that functionality as much as possible. 

So without creating a new query, you may call the subreddit's name as a method on this wrapper.

```php

use RedditWrapper\Wrapper;
use RedditWrapper\WrapperClient;

$wrapper = new Wrapper(new WrapperClient());

$response = $wrapper->formula1();

```
#### 4.2 `fetchSimple` method on Wrapper
When fetching subreddit information, Reddit sends a lot of information that is probaby not neccessery. The default response can very difficult to get through. `fetchSimple` method removes all the clutter and tries to present response with only more general values.

```php

$query = new SubredditQuery([
    'subreddit' => 'formula1',
    'sort' => SubredditSort::TOP,
    'sortTime' => SubredditSortTime::WEEK,
]);

$response = $wrapper->fetchSimple($query);

```

`fetchSimple` method returns these values. This method only works for `SubredditQuery` instances.

| Value        |
| ------------ |
| title        |
| id           |
| thumbnail    |
| permalink    |
| num_comments |
| score        |
| created      |
