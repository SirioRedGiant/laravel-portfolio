<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'image', 'link_github', 'link_website', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
