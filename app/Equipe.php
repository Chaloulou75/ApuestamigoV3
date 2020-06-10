<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
        'name', 'logo', 'groupe', 'logourl'
    ];

    public function games()
    {
        return $this->hasMany(Game::class);        
    }

    public function users()
    {
        return $this->hasMany(User::class);        
    }
}
