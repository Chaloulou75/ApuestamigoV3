<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateJournee extends Model
{
    protected $fillable = [
        'numerojournee', 'namejournee', 'timejournee', 'season', 'championnat_id',
    ];

    public function championnat()
    {
        return $this->belongsTo(Championnat::class, 'championnat_id');        
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'date_journees_id');        
    }
}
