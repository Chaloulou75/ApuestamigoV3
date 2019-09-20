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
        'user_id', 'ligue_id', 'journee', 'game_id', 'resultatEq1', 'resultatEq2', 'point_match',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);        
    }

    public function ligues()
    {
        return $this->belongsTo(Ligue::class);        
    }

    public function games()
    {
        return $this->belongsTo(Game::class);        
    }

    


}
