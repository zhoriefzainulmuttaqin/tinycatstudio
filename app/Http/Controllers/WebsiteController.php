<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\PricingPackage;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class WebsiteController extends Controller
{
    public function home(): View
    {
        $siteSettings = $this->siteSettings();

        $services = Service::query()
            ->active()
            ->with([
                'serviceDetails:id,service_id,title,description',
                'pricingPackages' => fn ($query) => $query
                    ->with('features:id,package_id,feature')
                    ->orderBy('price'),
            ])
            ->orderBy('id')
            ->get();

        $featuredPortfolios = Portfolio::query()
            ->with('service:id,name,slug')
            ->featured()
            ->latest()
            ->take(3)
            ->get();

        $featuredPackages = PricingPackage::query()
            ->with([
                'service:id,name,slug',
                'features:id,package_id,feature',
            ])
            ->orderByDesc('is_popular')
            ->orderBy('price')
            ->take(3)
            ->get();

        $testimonials = Testimonial::query()
            ->active()
            ->latest()
            ->take(6)
            ->get();

        $blogPosts = BlogPost::query()
            ->published()
            ->with('categories:id,name,slug')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $faqs = Faq::query()->orderBy('id')->get();

        $metrics = [
            ['label' => 'Layanan aktif', 'value' => $services->count()],
            ['label' => 'Project unggulan', 'value' => max($featuredPortfolios->count(), 3)],
            ['label' => 'Testimoni', 'value' => max($testimonials->count(), 5)],
            ['label' => 'Artikel SEO', 'value' => max($blogPosts->count(), 3)],
        ];

        return view('home', compact(
            'siteSettings',
            'services',
            'featuredPortfolios',
            'featuredPackages',
            'testimonials',
            'blogPosts',
            'faqs',
            'metrics',
        ));
    }

    public function service(Service $service): View
    {
        $siteSettings = $this->siteSettings();

        $service->load([
            'serviceDetails',
            'pricingPackages.features',
            'portfolios' => fn ($query) => $query->latest()->take(4),
        ]);

        $relatedServices = Service::query()
            ->active()
            ->whereKeyNot($service->id)
            ->take(3)
            ->get();

        return view('services.show', compact('siteSettings', 'service', 'relatedServices'));
    }

    public function portfolios(): View
    {
        $siteSettings = $this->siteSettings();

        $portfolios = Portfolio::query()
            ->with('service:id,name,slug')
            ->latest()
            ->get();

        return view('portfolios.index', compact('siteSettings', 'portfolios'));
    }

    public function portfolio(Portfolio $portfolio): View
    {
        $siteSettings = $this->siteSettings();

        $portfolio->load(['service', 'images']);

        $relatedPortfolios = Portfolio::query()
            ->with('service:id,name,slug')
            ->where('service_id', $portfolio->service_id)
            ->whereKeyNot($portfolio->id)
            ->take(3)
            ->get();

        return view('portfolios.show', compact('siteSettings', 'portfolio', 'relatedPortfolios'));
    }

    public function blog(): View
    {
        $siteSettings = $this->siteSettings();

        $posts = BlogPost::query()
            ->published()
            ->with('categories:id,name,slug')
            ->orderByDesc('published_at')
            ->paginate(6);

        $categories = Category::query()->orderBy('name')->get();

        return view('blog.index', compact('siteSettings', 'posts', 'categories'));
    }

    public function post(BlogPost $post): View
    {
        $siteSettings = $this->siteSettings();

        $post->load('categories:id,name,slug');

        $recentPosts = BlogPost::query()
            ->published()
            ->whereKeyNot($post->id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('siteSettings', 'post', 'recentPosts'));
    }

    /**
     * @return array<string, string>
     */
    private function siteSettings(): array
    {
        return Setting::query()->pluck('value', 'key')->all();
    }
}
