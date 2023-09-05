<?php

namespace App\View\Components;

use App\Models\Picture;
use Illuminate\View\Component;

class PictureList extends Component
{
    public $pictures;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pictures = Picture::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.picture-list');
    }
}
