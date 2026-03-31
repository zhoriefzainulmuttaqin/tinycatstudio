<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Tests\TestCase;

class MediaUrlResolutionTest extends TestCase
{
    public function test_portfolio_and_blog_media_urls_resolve_storage_paths(): void
    {
        $portfolio = new Portfolio([
            'thumbnail' => 'portfolios/komodo-sunrise.png',
        ]);

        $portfolioImage = new PortfolioImage([
            'image' => 'portfolios/gallery/komodo-detail.png',
        ]);

        $post = new BlogPost([
            'thumbnail' => 'blog/insight-cover.jpg',
        ]);

        $this->assertSame(asset('storage/portfolios/komodo-sunrise.png'), $portfolio->thumbnail_url);
        $this->assertSame(asset('storage/portfolios/gallery/komodo-detail.png'), $portfolioImage->image_url);
        $this->assertSame(asset('storage/blog/insight-cover.jpg'), $post->thumbnail_url);
    }

    public function test_existing_absolute_urls_are_preserved(): void
    {
        $url = 'https://cdn.example.com/portfolio/hero.png';

        $portfolio = new Portfolio([
            'thumbnail' => $url,
        ]);

        $this->assertSame($url, $portfolio->thumbnail_url);
    }
}
