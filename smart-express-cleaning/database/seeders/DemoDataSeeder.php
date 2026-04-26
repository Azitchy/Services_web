<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\BlogPost;
use App\Models\Cleaner;
use App\Models\CleaningJob;
use App\Models\ContactInquiry;
use App\Models\InventoryItem;
use App\Models\JobSupply;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Service;
use App\Models\SitePage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@smartexpresscleaning.com',
            'role' => 'admin',
            'phone' => '+971500000001',
        ]);

        $hosts = User::factory()
            ->count(4)
            ->state(['role' => 'host'])
            ->create();

        $cleanerUsers = User::factory()
            ->count(8)
            ->state(['role' => 'cleaner'])
            ->create();

        $cleaners = $cleanerUsers->map(function (User $user, int $index) {
            return Cleaner::factory()->create([
                'user_id' => $user->id,
                'employee_code' => 'CLN-'.str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT),
                'phone' => $user->phone,
                'hourly_rate' => fake()->randomFloat(2, 20, 60),
                'is_active' => true,
            ]);
        });

        $properties = collect();

        foreach ($hosts as $hostIndex => $host) {
            $hostProperties = Property::factory()
                ->count(2)
                ->create([
                    'host_user_id' => $host->id,
                    'listing_platform' => fake()->randomElement(['airbnb', 'pms']),
                    'external_listing_id' => 'LIST-'.$host->id.'-'.($hostIndex + 1).'-'.strtoupper(fake()->bothify('??##')),
                    'notes' => 'Premium host property with full guest-ready cleaning protocol.',
                    'is_active' => true,
                ]);

            $properties = $properties->merge($hostProperties);
        }

        $bookings = collect();

        foreach ($properties as $propertyIndex => $property) {
            for ($i = 0; $i < 3; $i++) {
                $checkIn = Carbon::now()->addDays(($propertyIndex * 2) + ($i * 4));
                $checkOut = (clone $checkIn)->addDays(fake()->numberBetween(1, 3));

                $booking = Booking::factory()->create([
                    'property_id' => $property->id,
                    'source' => fake()->randomElement(['airbnb', 'pms', 'manual']),
                    'external_booking_id' => 'BKG-'.$property->id.'-'.($i + 1).'-'.strtoupper(fake()->bothify('??##')),
                    'guest_name' => fake()->name(),
                    'guest_count' => fake()->numberBetween(1, 6),
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'booking_status' => 'confirmed',
                    'synced_at' => now(),
                ]);

                $bookings->push($booking);
            }
        }

        $cleaningJobs = collect();

        foreach ($bookings as $booking) {
            $scheduledStart = Carbon::parse($booking->check_out)->addMinutes(45);
            $scheduledEnd = (clone $scheduledStart)->addMinutes($booking->property->default_cleaning_minutes);
            $assignedCleaner = $cleaners->random();

            $job = CleaningJob::factory()->create([
                'booking_id' => $booking->id,
                'property_id' => $booking->property_id,
                'cleaner_id' => $assignedCleaner->id,
                'scheduled_start' => $scheduledStart,
                'scheduled_end' => $scheduledEnd,
                'status' => fake()->randomElement(['pending', 'assigned', 'in_progress', 'completed']),
                'priority' => fake()->numberBetween(1, 5),
                'manual_override' => fake()->boolean(30),
                'completed_at' => null,
                'notes' => 'Auto-generated from booking checkout. Verify amenities and linen count.',
            ]);

            if ($job->status === 'completed') {
                $job->update(['completed_at' => Carbon::parse($job->scheduled_end)]);
            }

            $cleaningJobs->push($job);
        }

        foreach ($hosts as $host) {
            Payment::factory()->count(3)->create([
                'user_id' => $host->id,
            ]);
        }

        $inventoryItems = collect();

        foreach ($properties as $property) {
            $items = InventoryItem::factory()->count(5)->create([
                'property_id' => $property->id,
                'is_active' => true,
            ]);

            $inventoryItems = $inventoryItems->merge($items);
        }

        foreach ($cleaningJobs as $job) {
            $itemsForProperty = $inventoryItems->where('property_id', $job->property_id)->shuffle()->take(2)->values();

            foreach ($itemsForProperty as $item) {
                JobSupply::factory()->create([
                    'cleaning_job_id' => $job->id,
                    'inventory_item_id' => $item->id,
                    'quantity_used' => fake()->randomFloat(2, 0.5, 3),
                    'notes' => 'Used during turnover for guest-ready setup.',
                ]);
            }
        }

        SitePage::query()->updateOrCreate(
            ['page_key' => 'home'],
            [
                'name' => 'Home',
                'hero_kicker' => 'Home',
                'hero_title' => 'Smart Express Cleaning Services',
                'hero_subtitle' => 'Holiday Home Cleaning Experts in Dubai. Guest-ready turnovers, deep cleans, and reliable service built for hosts and property managers.',
                'section_title' => 'Why Choose Smart Express Cleaning Services?',
                'section_subtitle' => 'Built around Airbnb hosting standards, our service makes every check-in feel professionally prepared and truly guest-ready.',
                'extra_content' => [
                    'hero_button' => 'Pop Me a Price',
                    'why_cards' => [
                        ['title' => 'Experienced, Trusted Team', 'text' => 'All cleaners are trained for high-standard holiday home delivery.'],
                        ['title' => 'Guest-Ready Standards', 'text' => 'Premium products, linens, and staging checks on every turnover.'],
                        ['title' => 'Reliable & Flexible', 'text' => 'Scheduled around your booking flow with responsive support.'],
                        ['title' => 'Powered by Clean Tech', 'text' => 'Automation-backed operations designed for modern property teams.'],
                    ],
                ],
                'is_active' => true,
            ]
        );

        SitePage::query()->updateOrCreate(
            ['page_key' => 'about'],
            [
                'name' => 'About Us',
                'hero_kicker' => 'About Us',
                'hero_title' => 'Hospitality-level cleaning, built for modern hosting teams.',
                'hero_subtitle' => 'Smart Express Cleaning Services supports Airbnb hosts and property managers with reliable, process-driven cleaning across Dubai.',
                'section_title' => 'Who We Are',
                'section_subtitle' => 'We are a guest-experience focused cleaning company.',
                'extra_content' => [
                    'who_title' => 'Who We Are',
                    'who_paragraph_1' => 'We are a guest-experience focused cleaning company. Our operations are structured to deliver consistent quality across single units and multi-property portfolios.',
                    'who_paragraph_2' => 'From same-day turnovers to deep cleaning and amenity checks, we keep properties spotless, staged, and ready for the next guest arrival.',
                    'who_image_url' => 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1400&q=80',
                    'values_title' => 'Our Core Values',
                    'core_values' => [
                        ['title' => 'Consistency', 'text' => 'Every clean follows structured checklists and final quality inspection.'],
                        ['title' => 'Speed', 'text' => 'Optimized turnover workflows to meet tight check-in timelines.'],
                        ['title' => 'Transparency', 'text' => 'Clear communication on schedules, updates, and job completion.'],
                        ['title' => 'Hospitality Mindset', 'text' => 'We clean to impress guests, not just to finish tasks.'],
                    ],
                    'deliver_title' => 'What We Deliver',
                    'deliver_subtitle' => 'A complete service cycle designed for hosts and property managers.',
                ],
                'is_active' => true,
            ]
        );

        SitePage::query()->updateOrCreate(
            ['page_key' => 'services'],
            [
                'name' => 'Our Services',
                'hero_kicker' => 'Our Services',
                'hero_title' => 'Cleaning services tailored for Airbnb hosts and property managers.',
                'hero_subtitle' => 'We combine operational discipline with hospitality standards to keep every property guest-ready.',
                'section_title' => 'How Our Process Works',
                'extra_content' => [
                    'process' => [
                        ['title' => '1. Booking Sync', 'text' => 'We align cleaning windows with check-out schedules and turnaround deadlines.'],
                        ['title' => '2. Team Dispatch', 'text' => 'Assigned cleaners arrive with a task checklist and property-specific requirements.'],
                        ['title' => '3. Quality Confirmation', 'text' => 'Final walkthrough confirms cleanliness, staging, and guest-facing presentation.'],
                    ],
                ],
                'is_active' => true,
            ]
        );

        SitePage::query()->updateOrCreate(
            ['page_key' => 'blogs'],
            [
                'name' => 'Blogs',
                'hero_kicker' => 'Blog',
                'hero_title' => 'Insights for better cleaning operations and happier guests.',
                'hero_subtitle' => 'Practical advice for hosts, property managers, and cleaning teams.',
                'is_active' => true,
            ]
        );

        $serviceData = [
            [
                'title' => 'Holiday Home & Airbnb Turnaround',
                'slug' => 'holiday-home-airbnb-turnaround',
                'short_description' => 'Fast checkout-to-checkin cleaning with staging, linen reset, and essentials top-up.',
                'description' => 'Fast checkout-to-checkin cleaning with staging, linen reset, and essentials top-up.',
                'image_url' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Regular Maintenance Checks',
                'slug' => 'regular-maintenance-checks',
                'short_description' => 'Routine property checks to keep your operations smooth between guest stays.',
                'description' => 'Routine property checks to keep your operations smooth between guest stays.',
                'image_url' => 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Post-Renovation Clean',
                'slug' => 'post-renovation-clean',
                'short_description' => 'Detailed dust and debris removal after fit-outs and renovations.',
                'description' => 'Detailed dust and debris removal after fit-outs and renovations.',
                'image_url' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Linen & Towel Care',
                'slug' => 'linen-and-towel-care',
                'short_description' => 'Collection coordination, quality checks, and neat setup for guest arrivals.',
                'description' => 'Collection coordination, quality checks, and neat setup for guest arrivals.',
                'image_url' => 'https://images.unsplash.com/photo-1616628182509-6f5af8e7f16d?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Deep Clean',
                'slug' => 'deep-clean',
                'short_description' => 'Comprehensive deep cleaning for periodic reset and premium presentation.',
                'description' => 'Comprehensive deep cleaning for periodic reset and premium presentation.',
                'image_url' => 'https://images.unsplash.com/photo-1556909190-eccf4a8bf97a?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Upholstery & Carpet Cleaning',
                'slug' => 'upholstery-and-carpet-cleaning',
                'short_description' => 'Professional refresh for sofas, rugs, and soft-furnishing surfaces.',
                'description' => 'Professional refresh for sofas, rugs, and soft-furnishing surfaces.',
                'image_url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($serviceData as $service) {
            Service::query()->updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }

        $blogData = [
            [
                'title' => 'How to Prepare Airbnb Properties for Same-Day Turnover',
                'slug' => 'how-to-prepare-airbnb-properties-for-same-day-turnover',
                'excerpt' => 'A practical checklist for hosts to maintain five-star standards during same-day turnover.',
                'content' => "Same-day turnover requires a documented checklist and disciplined timing.\\n\\nStart with ventilating the property, collecting waste, and prioritizing kitchen and bathrooms.\\n\\nUse zone-based cleaning so team members can work in parallel and finish faster.\\n\\nSet a final quality inspection pass for linens, toiletries, and staging details.",
                'cover_image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1400&q=80',
                'author_name' => 'Smart Express Editorial Team',
                'read_time_minutes' => 6,
                'published_at' => now()->subDays(4),
                'is_published' => true,
            ],
            [
                'title' => '5 Cleaning Quality Checks Every Property Manager Should Use',
                'slug' => '5-cleaning-quality-checks-every-property-manager-should-use',
                'excerpt' => 'A lightweight quality-control system that reduces guest complaints and improves consistency.',
                'content' => "Define non-negotiables for bathrooms, bedrooms, and kitchen presentation.\\n\\nUse photo proof for high-risk touchpoints after each clean.\\n\\nTrack recurring quality misses to identify training opportunities.\\n\\nCombine spot audits with post-guest feedback to improve SOPs.",
                'cover_image_url' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1400&q=80',
                'author_name' => 'Smart Express Editorial Team',
                'read_time_minutes' => 5,
                'published_at' => now()->subDays(8),
                'is_published' => true,
            ],
            [
                'title' => 'Inventory Planning for Holiday Home Cleaning Teams',
                'slug' => 'inventory-planning-for-holiday-home-cleaning-teams',
                'excerpt' => 'Avoid low-stock emergencies by pairing inventory thresholds with upcoming bookings.',
                'content' => "Categorize supplies by criticality and consumption speed.\\n\\nSet reorder thresholds based on average usage per completed job.\\n\\nBundle supply kits per property to reduce preparation time.\\n\\nReview inventory reports weekly and before peak booking periods.",
                'cover_image_url' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1400&q=80',
                'author_name' => 'Smart Express Editorial Team',
                'read_time_minutes' => 5,
                'published_at' => now()->subDays(12),
                'is_published' => true,
            ],
        ];

        foreach ($blogData as $blogPost) {
            BlogPost::query()->updateOrCreate(
                ['slug' => $blogPost['slug']],
                $blogPost
            );
        }

        ContactInquiry::factory()->count(15)->create();
    }
}

