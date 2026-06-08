<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['name', 'slug', 'color']; // per usare il mass assignment


    /**
     *  Relazione many to many
     */
    public function Projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
