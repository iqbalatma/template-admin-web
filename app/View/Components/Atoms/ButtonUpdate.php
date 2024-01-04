<?php

namespace App\View\Components\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonUpdate extends Component
{
    public string $buttonUpdateFormId;
    /**
     * Create a new component instance.
     */
    public function __construct(string $form = "")
    {
        $this->buttonUpdateFormId = $form;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.button-update');
    }
}
