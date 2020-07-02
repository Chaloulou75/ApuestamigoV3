<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateJournee extends Model
{
    protected $fillable = [
        'numerojournee', 'namejournee', 'timejournee', 'season',
    ];
}
