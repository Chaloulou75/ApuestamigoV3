<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
        'name', 'logo', 'groupe', 
    ];

    public function games()
    {
        return $this->hasMany(Game::class);        
    }
}
