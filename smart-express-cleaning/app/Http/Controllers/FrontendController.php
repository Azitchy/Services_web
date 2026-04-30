<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BlogPost;
use App\Models\Service;
use App\Models\SitePage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class FrontendController extends Controller
{
    public function home()
    {
        $page = $this->pageByKey('home');
        $banners = \App\Models\Banner::where('is_active', true)->orderBy('sort_order')->get();
        $services = Schema::hasTable('services') ? $this->serviceQuery()->take(3)->get() : collect();
        $blogs = Schema::hasTable('blog_posts') ? $this->blogPostQuery()->take(3)->get() : collect();
        $whyChooseUs = Schema::hasTable('why_choose_us') ? \App\Models\WhyChooseUs::orderBy('order', 'asc')->get() : collect();

        return view('frontend.home', [
            'page' => $page,
            'banners' => $banners,
            'services' => $services,
            'blogs' => $blogs,
            'whyChooseUs' => $whyChooseUs,
        ]);
    }

    public function about()
    {
        $page = $this->pageByKey('about');
        $services = Schema::hasTable('services') ? $this->serviceQuery()->take(4)->get() : collect();

        return view('frontend.about', [
            'page' => $page,
            'services' => $services,
        ]);
    }

    public function servicesPage()
    {
        $page = $this->pageByKey('services');
        $services = Schema::hasTable('services') ? $this->serviceQuery()->get() : collect();

        return view('frontend.services', [
            'page' => $page,
            'services' => $services,
        ]);
    }

    public function blogs()
    {
        $page = $this->pageByKey('blogs');

        $blogs = Schema::hasTable('blog_posts')
            ? $this->blogPostQuery()->paginate(9)
            : new LengthAwarePaginator([], 0, 9);

        return view('frontend.blogs.index', compact('page', 'blogs'));
    }

    public function blogShow(string $slug)
    {
        abort_unless(Schema::hasTable('blog_posts'), 404);

        $blog = $this->blogPostQuery()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.blogs.show', [
            'blog' => $blog,
        ]);
    }

    private function pageByKey(string $pageKey): SitePage
    {
        if (! Schema::hasTable('site_pages')) {
            return $this->defaultPage($pageKey);
        }

        $page = SitePage::query()
            ->where('page_key', $pageKey)
            ->where('is_active', true)
            ->first();

        if ($page) {
            return $page;
        }

        return $this->defaultPage($pageKey);
    }

    private function defaultPage(string $pageKey): SitePage
    {
        return new SitePage([
            'page_key' => $pageKey,
            'name' => ucfirst($pageKey),
            'hero_kicker' => ucfirst($pageKey),
            'hero_title' => 'Smart Express Cleaning Services',
            'hero_subtitle' => 'Hospitality-level cleaning support for hosts and property managers.',
            'hero_image_url' => null,
            'section_title' => null,
            'section_subtitle' => null,
            'extra_content' => [],
            'is_active' => true,
        ]);
    }

    private function serviceQuery()
    {
        return Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title');
    }

    private function blogPostQuery()
    {
        return BlogPost::query()
            ->where('is_published', true)
            ->orderByDesc('published_at');
    }
}
