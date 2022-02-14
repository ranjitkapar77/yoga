<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MissionMessages;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ProvinceTableSeeder::class);
        $this->call(DistrictTableSeeder::class);

        Setting::insert([
            [
                "company_name" => "LekhaBidhi",
                "email" => "lekhabidhi@gmail.com ",
                "contact_no" => "01-5904030",
                "province_no" => "3",
                "district_no" => "23",
                "local_address" => "Sundhara",
                "company_logo" => "noimage.jpg",
                "footer_logo" => "noimage.jpg",
                "company_favicon" => "noimage.jpg",
                "pan_vat" => "1542-551-575",
                "total_employees" => "250",
                "happy_clients" => "250",
                "projects_completed" => "250",
                "map_url" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.9212530847535!2d85.30833201458272!3d27.68882863291339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1918e77a958d%3A0x8adb3649babf6b7e!2sNectar%20Digit%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1630559019802!5m2!1sen!2snp"
            ]
        ]);

        MissionMessages::insert([
            [
                "mission" => "LekhaBidhi, A Product Of Nectar Digit",
                "vision" => "LekhaBidhi, A Product Of Nectar Digit",
                "company_values" => "LekhaBidhi, A Product Of Nectar Digit",
                "welcome_title" => "LekhaBidhi, A Product Of Nectar Digit",
                "welcome_sub_title" => "LekhaBidhi, A Product Of Nectar Digit",
                "welcome_message" => "LekhaBidhi, A Product Of Nectar Digit",
                'youtube_link' => "https://www.youtube.com/watch?v=V00TZgYN-jc"
            ]
        ]);

        MenuCategory::insert([
            [
                'name' => 'Home',
                'slug' => Str::slug('Home')
            ],
            [
                'name' => 'About',
                'slug' => Str::slug('About')
            ],
            [
                'name' => 'Team',
                'slug' => Str::slug('Team')
            ],
            [
                'name' => 'Services',
                'slug' => Str::slug('Services')
            ],
            [
                'name' => 'Partners',
                'slug' => Str::slug('Partners')
            ],
            [
                'name' => 'Pricing & Plans',
                'slug' => Str::slug('Pricing & Plans')
            ],
            [
                'name' => 'Contact',
                'slug' => Str::slug('Contact')
            ],
            [
                'name' => 'Blogs',
                'slug' => Str::slug('Blogs')
            ],
            [
                'name' => 'Courses',
                'slug' => Str::slug('courses')
            ],
            [
                'name' => 'Destination',
                'slug' => Str::slug('destination')
            ],
            [
                'name' => 'Test Preparation',
                'slug' => Str::slug('test-preparation')
            ]
        ]);

        User::insert([
            [
                "name"=>"Nectar Digit",
                "email"=>"nectardigit@admin.com",
                "password"=>Hash::make("Nectar@321"),
                "created_at"=>date('Y-m-d H:i:s'),
                "updated_at"=>date('Y-m-d H:i:s'),
            ],
        ]);

    }
}
