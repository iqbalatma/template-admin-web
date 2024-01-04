<?php

namespace App\View\Components\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonCreate extends Component
{
    public string $buttonCreateUrl;
    /**
     * Create a new component instance.
     */
    public function __construct(string $url)
    {
        $this->buttonCreateUrl = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.button-create');
    }
}
