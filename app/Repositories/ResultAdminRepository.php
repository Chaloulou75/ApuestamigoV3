<?php

namespace App\Repositories;

use App\User;

class ResultAdminRepository
{
	public function resultAdmin($journee)
	{
		return User::with(['matchs' => function ($query) use($journee){
                                  $query->where('championnat_id', $journee->championnat_id)
                                        ->where('date_journees_id', $journee->id)
                                        ->orderBy('game_id');
                              }])->where('admin', 1)
                                 ->first();
	}
}
