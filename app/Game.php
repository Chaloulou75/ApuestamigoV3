<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'equipe1_id','equipe2_id', 'journee' 
    ];

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
