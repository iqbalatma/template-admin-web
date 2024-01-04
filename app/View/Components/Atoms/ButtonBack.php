<?php

namespace App\View\Components\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonBack extends Component
{
    public string $buttonBackUrl;
    /**
     * Create a new component instance.
     */
    public function __construct(string $url)
    {
        $this->buttonBackUrl = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.button-back');
    }
}
