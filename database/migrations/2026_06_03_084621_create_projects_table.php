<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150)->unique(); // titolo del progetto
            $table->string('slug')->unique();       // URL progetto
            $table->text('description')->nullable(); // descrizione 
            $table->string('image')->nullable();       // percorso immagine di copertina
            $table->string('link_github')->nullable(); // link alla repository
            $table->string('link_website')->nullable(); // link al sito live

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
