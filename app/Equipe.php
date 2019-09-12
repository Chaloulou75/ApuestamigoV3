<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
        'name', 'logo', 'groupe', 
    ];

    public function matchs()
    {
        return $this->hasMany(Match::class);        
    }
}
