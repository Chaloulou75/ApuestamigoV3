<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function homeTeam()
    {
        return $this->belongsTo(Equipe::class, 'equipe1_id');        
    }

    public function awayTeam()
    {
        return $this->belongsTo(Equipe::class, 'equipe2_id');        
    }

    public function matchs()
    {
        return $this->hasMany(Match::class);        
    }
}
