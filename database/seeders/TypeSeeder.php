<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // array tipologie progetti
        $types = [
            'Front-End Web Development',
            'Back-End Web Development',
            'Full-Stack Web Applications',
            'Responsive Web Design',
            'E-commerce Platforms',
            'Web App Clones',
            'RESTful API Development & Integration',
            'Database Management & Architecture',
            'UI/UX Component Design'
        ];

        foreach ($types as $type_name) {

            Type::create([
                'name' => $type_name,
                'slug' => Str::slug($type_name, '-')
            ]);
        }
    }
}
