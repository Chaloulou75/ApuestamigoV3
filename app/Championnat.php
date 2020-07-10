<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Championnat extends Model
{
    protected $fillable = [
        'name', 'finished', 'logo', 'logourl'
    ];

    public function matchs()
    {
        return $this->hasMany(Match::class);        
    }

    public function games()
    {
        return $this->hasMany(Game::class);        
    }

    public function equipes()
    {
        return $this->hasMany(Equipe::class);        
    }

    public function journees()
    {
        return $this->hasMany(DateJournee::class);        
    }

    public function ligues()
    {
        return $this->hasMany(Ligue::class);        
    }
}
