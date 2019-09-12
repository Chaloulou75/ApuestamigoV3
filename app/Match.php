<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ligue_id', 'journee', 'equipe1_id', 'equipe2_id', 'resultatEq1', 'resultatEq2', 'point_match',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);        
    }

    public function ligues()
    {
        return $this->belongsTo(Ligue::class);        
    }

    public function homeTeam()
    {
        return $this->belongsTo(Equipe::class, 'equipe1_id');        
    }

    public function awayTeam()
    {
        return $this->belongsTo(Equipe::class, 'equipe2_id');        
    }
}
