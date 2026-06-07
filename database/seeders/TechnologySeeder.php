<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            // --- FRONT-END CORE & UI ---
            ['name' => 'HTML5', 'color' => '#E34F26'],
            ['name' => 'CSS3', 'color' => '#1572B6'],
            ['name' => 'JavaScript', 'color' => '#F7DF1E'],
            ['name' => 'Bootstrap', 'color' => '#7952B3'],
            ['name' => 'Tailwind CSS', 'color' => '#06B6D4'],
            ['name' => 'Sass / SCSS', 'color' => '#CC6699'],

            // --- JAVASCRIPT ECOSYSTEM ---
            ['name' => 'Vue.js', 'color' => '#4FC08D'],
            ['name' => 'React', 'color' => '#61DAFB'],
            ['name' => 'Redux', 'color' => '#764ABC'],
            ['name' => 'Next.js', 'color' => '#000000'],
            ['name' => 'TypeScript', 'color' => '#3178C6'],
            ['name' => 'Vite', 'color' => '#646CFF'],
            ['name' => 'Axios', 'color' => '#5A29E4'],

            // --- BACK-END & RUNTIMES ---
            ['name' => 'PHP', 'color' => '#777BB4'],
            ['name' => 'Laravel', 'color' => '#FF2D20'],
            ['name' => 'Blade Templating', 'color' => '#F7523F'],
            ['name' => 'Node.js', 'color' => '#339933'],
            ['name' => 'Express.js', 'color' => '#000000'],
            ['name' => 'RESTful APIs', 'color' => '#009688'],

            // --- DATABASES & ORM ---
            ['name' => 'MySQL', 'color' => '#4479A1'],
            ['name' => 'PostgreSQL', 'color' => '#4169E1'],
            ['name' => 'MongoDB', 'color' => '#47A248'],
            ['name' => 'SQL', 'color' => '#003B57'],
            ['name' => 'Prisma ORM', 'color' => '#2D3748'],

            // --- TESTING & QUALITY ---
            ['name' => 'Jest', 'color' => '#C21325'],
            ['name' => 'Vitest', 'color' => '#646CFF'],
            ['name' => 'Cypress', 'color' => '#17202C'],
            ['name' => 'PHPUnit', 'color' => '#4F5B93'],

            // --- WORKFLOW, DEPLOY & DEV-TOOLS ---
            ['name' => 'Git', 'color' => '#F05032'],
            ['name' => 'GitHub', 'color' => '#181717'],
            ['name' => 'Visual Studio Code', 'color' => '#007ACC'],
            ['name' => 'XAMPP', 'color' => '#F37023'],
            ['name' => 'Postman', 'color' => '#FF6C37'],
            ['name' => 'Figma', 'color' => '#F24E1E'],
            ['name' => 'NPM', 'color' => '#CB3837'],
            ['name' => 'Docker', 'color' => '#2496ED'],
            ['name' => 'Vercel', 'color' => '#000000'],
            ['name' => 'Netlify', 'color' => '#00C7B7']
        ];

        foreach ($technologies as $tech) {
            Technology::create([
                'name' => $tech['name'],
                'slug' => Str::slug($tech['name'], '-'),
                'color' => $tech['color']
            ]);
        }
    }
}
