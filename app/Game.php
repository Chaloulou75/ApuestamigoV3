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
        'equipe1_id','equipe2_id', 'date_journees_id', 'gamedate', 'championnat_id', 
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

    public function journee()
    {
        return $this->belongsTo(DateJournee::class,'date_journees_id');  //      
    }

    public function championnat()
    {
        return $this->belongsTo(Championnat::class, 'championnat_id');        
    }

}
