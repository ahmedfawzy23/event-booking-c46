<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            ["name" => "Music", "description" => "Concerts, festivals, and live performances."],
            ["name" => "Sports", "description" => "Matches, championships, and sporting events."],
            ["name" => "Technology", "description" => "Conferences, workshops, and tech meetups."],
            ["name" => "Food & Drink", "description" => "Food festivals, tasting events, and culinary experiences."],
            ["name" => "Arts & Culture", "description" => "Exhibitions, theatre, and cultural events."],
            ["name" => "Education", "description" => "Webinars, workshops, and learning opportunities."],
            ["name" => "Business", "description" => "Seminars, conferences, and networking events."],
            ["name" => "Entertainment", "description" => "Festivals, fairs, and entertainment shows."],
            ["name" => "Health & Wellness", "description" => "Fitness classes, wellness retreats, and health events."],
            ["name" => "Outdoor & Adventure", "description" => "Hiking, camping, and adventure sports events."],
            ["name" => "Family-Friendly", "description" => "Events suitable for all ages."],
            ["name" => "Fashion", "description" => "Fashion shows, expos, and style-related events."],
            ["name" => "Travel", "description" => "Travel fairs, expos, and tourism-related events."],
            ["name" => "Gaming", "description" => "Esports tournaments, conventions, and gaming events."],
            ["name" => "Charity & Fundraising", "description" => "Charity runs, galas, and fundraising events."],
            ["name" => "Local Community", "description" => "Neighborhood events and community gatherings."],
            ["name" => "Film", "description" => "Film festivals, screenings, and movie-related events."],
            ["name" => "Holiday-Themed", "description" => "Seasonal and holiday-themed events."],
            ["name" => "Art Exhibitions", "description" => "Art shows, galleries, and exhibitions."],
            ["name" => "Workshops & Classes", "description" => "Skill-building workshops and classes."],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
