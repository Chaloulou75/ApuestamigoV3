<?php

namespace App;

use App\DateJournee;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ligue_id', 'date_journees_id', 'game_id', 'resultatEq1', 'resultatEq2', 'pointMatch',
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

    public function journee()
    {
        return $this->belongsTo(DateJournee::class, 'date_journees_id');        
    }
}
