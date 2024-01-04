<?php

namespace App\View\Components\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonSave extends Component
{
    public string $buttonSaveFormId;
    /**
     * Create a new component instance.
     */
    public function __construct(string $form = "")
    {
        $this->buttonSaveFormId = $form;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.button-save');
    }
}
