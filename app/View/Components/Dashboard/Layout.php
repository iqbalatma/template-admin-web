<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Layout extends Component
{

    public string $title;
    public string $subTitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = "", string $subTitle = "")
    {
        $this->title = $title;
        $this->subTitle = $subTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.layout');
    }
}
