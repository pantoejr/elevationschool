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
    public $classSections;
    public $installments;
    public function __construct($sections,$model,$classSections = null, $installments = null)
    {
        $this->sections = $sections;
        $this->model = $model;
        $this->classSections = $classSections;
        $this->installments = $installments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.section-navigation');
    }
}
