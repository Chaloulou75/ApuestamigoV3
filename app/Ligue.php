<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ligue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'token', 'user_name', 'user_club',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('totalPoints')->orderBy('ligue_user.totalPoints', 'Desc')->withTimestamps();
        //
        
    }

    public function matchs()
    {
        return $this->hasMany(Match::class);        
    }
}
