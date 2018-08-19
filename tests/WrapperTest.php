<?php

namespace Tests;

use RedditWrapper\Enums\SubredditSort;
use RedditWrapper\Queries\SubredditQuery;
use RedditWrapper\Wrapper;
use PHPUnit\Framework\TestCase;
use RedditWrapper\WrapperClient;

class WrapperTest extends TestCase
{
    public function test_wrapper_expects_wrapper_client()
    {
        $this->expectException(\ArgumentCountError::class);

        new Wrapper();
    }

    public function test_client_request_method_is_called()
    {
        $mock = $this->createMock(WrapperClient::class);
        $mock->expects($this->once())->method('request')->willReturn($this->exampleData());

        $wrapper = new Wrapper($mock);

        $subredditQuery = new SubredditQuery([
            'subreddit' => 'formula1',
            'sort' => SubredditSort::TOP,
        ]);

        $wrapper->fetch($subredditQuery);
    }

    public function test_magic_call_method_triggers_fetch()
    {
        $mock = $this->createMock(WrapperClient::class);
        $mock->expects($this->once())->method('request')->willReturn($this->exampleData());

        $wrapper = new Wrapper($mock);

        $wrapper->formula1();
    }

    private function exampleData(): array
    {
        return [
            'data' => [
                'children' => [
                    'approved_at_utc' => null,
                    'subreddit' => 'formula1',
                    'selftext' => '',
                    'user_reports' => [],
                    'saved' => false,
                    'mod_reason_title' => null,
                    'gilded' => 0,
                    'clicked' => false,
                    'title' => 'The new role of Valtteri Bottas for 2019',
                    'link_flair_richtext' => [],
                    'subreddit_name_prefixed' => 'r/formula1',
                    'hidden' => false,
                    'pwls' => 6,
                    'link_flair_css_class' => 'sub-all media',
                    'downs' => 0,
                    'thumbnail_height' => 78,
                    'parent_whitelist_status' => 'all_ads',
                    'hide_score' => false,
                    'name' => 't3_970taj',
                    'quarantine' => false,
                    'link_flair_text_color' => 'dark',
                    'author_flair_background_color' => null,
                    'subreddit_type' => 'public',
                    'ups' => 8775,
                    'domain' => 'i.redd.it',
                    'media_embed' => [],
                    'thumbnail_width' => 140,
                    'author_flair_template_id' => null,
                    'is_original_content' => false,
                    'secure_media' => null,
                    'is_reddit_media_domain' => true,
                    'is_meta' => false,
                    'category' => null,
                    'secure_media_embed' => [],
                    'link_flair_text' => 'Media /r/all',
                    'can_mod_post' => false,
                    'score' => 8775,
                    'approved_by' => null,
                    'thumbnail' => 'https://b.thumbs.redditmedia.com/svuTEEz6QPWpwykzWa9spOOp4nJiR34ZxzBH-ky9ZXg.jpg',
                    'edited' => false,
                    'author_flair_css_class' => null,
                    'author_flair_richtext' => [],
                    'post_hint' => 'image',
                    'content_categories' => null,
                    'is_self' => false,
                    'mod_note' => null,
                    'created' => 1534213678,
                    'link_flair_type' => 'text',
                    'wls' => 6,
                    'banned_by' => null,
                    'author_flair_type' => 'text',
                    'contest_mode' => false,
                    'selftext_html' => null,
                    'likes' => null,
                    'suggested_sort' => null,
                    'banned_at_utc' => null,
                    'view_count' => null,
                    'archived' => false,
                    'no_follow' => false,
                    'is_crosspostable' => false,
                    'pinned' => false,
                    'over_18' => false,
                    'media_only' => false,
                    'link_flair_template_id' => null,
                    'can_gild' => false,
                    'spoiler' => false,
                    'locked' => false,
                    'author_flair_text' => null,
                    'visited' => false,
                    'num_reports' => null,
                    'distinguished' => null,
                    'subreddit_id' => 't5_2qimj',
                    'mod_reason_by' => null,
                    'removal_reason' => null,
                    'link_flair_background_color' => '',
                    'id' => '970taj',
                    'report_reasons' => null,
                    'author' => 'Codigo_X',
                    'num_crossposts' => 1,
                    'num_comments' => 210,
                    'send_replies' => true,
                    'mod_reports' => [],
                    'author_flair_text_color' => null,
                    'permalink' => '/r/formula1/comments/970taj/the_new_role_of_valtteri_bottas_for_2019/',
                    'whitelist_status' => 'all_ads',
                    'stickied' => false,
                    'url' => 'https://i.redd.it/gu9tb1zslwf11.jpg',
                    'subreddit_subscribers' => 413324,
                    'created_utc' => 1534184878,
                    'media' => null,
                    'is_video' => false,
                ],
            ],
        ];
    }
}
