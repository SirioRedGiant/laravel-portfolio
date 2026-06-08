<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        // recupero gli ID di tegnologies in TechnologySeeder e con il metodo --> pluck('id') estraggo solo gli ID restituendo una collezione e lo converto in array
        $technologyIds = Technology::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $project = new Project();

            $project->title = $faker->sentence(3); // crea un titolo di 3 parole
            $project->slug = Str::slug($project->title, '-'); // trasforma una stringa da "Mio Progetto" in "mio-progetto"
            $project->description = $faker->text(500); // testo random
            $project->image = 'https://picsum.photos/600/400'; // immagine finta casuale
            $project->link_github = 'https://github.com';
            $project->link_website = 'https://google.com';

            $project->save();

            // genera un array di ID tech random per il singolo project --> randomElements prende un numero random tra 2 e 5 dell'ID dall'array delle technologies
            // $randomTechs = $faker->randomElements($technologyIds, rand(2, 5)); --> ERRORE non funziona whyyyy?
            $randomTechs = Arr::random($technologyIds, rand(2, 5));


            // aggiungo le tech al progetto nella tabella pivot project_technology
            $project->technologies()->attach($randomTechs);
        }
    }
}
