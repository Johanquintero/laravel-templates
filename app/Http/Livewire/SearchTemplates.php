<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Template;

class SearchTemplates extends Component
{
    public $search;
 
    protected $queryString = ['search'];
 
    public function render()
    {
        return view('livewire.search-templates', [
            'templates' => Template::where('store_name', 'like', '%'.$this->search.'%')->get(),
        ]);
    }
}