<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();

            $project->title = $faker->sentence(3); // crea un titolo di 3 parole
            $project->slug = Str::slug($project->title, '-'); // trasforma una stringa da "Mio Progetto" in "mio-progetto"
            $project->description = $faker->text(500); // testo random
            $project->image = 'https://picsum.photos/600/400'; // immagine finta casuale
            $project->link_github = 'https://github.com';
            $project->link_website = 'https://google.com';

            $project->save();
        }
    }
}
