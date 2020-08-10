<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
        'name', 'logo', 'logourl', 'championnat_id',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function championnat()
    {
        return $this->belongsTo(Championnat::class, 'championnat_id');
    }
}
