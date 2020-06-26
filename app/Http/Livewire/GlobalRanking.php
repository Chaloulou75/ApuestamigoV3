<?php

namespace App\Http\Livewire;

use App\Ligue;
use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class GlobalRanking extends Component
{
	use WithPagination;

	public $query;

	public $perPage = 2;

	public function updatingQuery()
    {
        $this->resetPage();
    }

	public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

    public function render()
    {

        return view('livewire.global-ranking', [
        	
        	'users' => User::with('ligues')->where('name', 'like', '%'.$this->query.'%')->paginate($this->perPage),

        ]);   	
    }
}

