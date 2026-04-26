<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Booking;
use App\Models\CleaningJob;
use App\Models\ContactInquiry;
use App\Models\Property;
use App\Models\Service;
use App\Models\SitePage;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'hosts' => User::query()->where('role', 'host')->count(),
            'cleaners' => User::query()->where('role', 'cleaner')->count(),
            'properties' => Property::query()->count(),
            'bookings' => Booking::query()->count(),
            'jobs' => CleaningJob::query()->count(),
            'new_inquiries' => ContactInquiry::query()->where('status', 'new')->count(),
            'site_pages' => SitePage::query()->count(),
            'services' => Service::query()->count(),
            'blog_posts' => BlogPost::query()->count(),
        ];

        $recentInquiries = ContactInquiry::query()
            ->latest()
            ->take(8)
            ->get();

        $upcomingJobs = CleaningJob::query()
            ->with(['property', 'cleaner.user'])
            ->whereIn('status', ['pending', 'assigned', 'in_progress'])
            ->orderBy('scheduled_start')
            ->take(8)
            ->get();

        $recentServices = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->take(4)
            ->get();

        $recentBlogPosts = BlogPost::query()
            ->where('is_published', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'upcomingJobs', 'recentServices', 'recentBlogPosts'));
    }
}
