<?php

namespace App\View\Components;

use App\Models\Section;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionNavigation extends Component
{
    public $model;
    public $sections;
    public function __construct($sections,$model)
    {
        $this->sections = $sections;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.section-navigation');
    }
}
