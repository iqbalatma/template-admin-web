<?php

namespace App\View\Components\Dashboard;

use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\Component;

class Layout extends Component
{
    public string $lastBreadcrumbKey;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $breadcrumbs = array_keys(FacadesView::getShared()["breadcrumbs"]);
        $this->lastBreadcrumbKey = end($breadcrumbs);
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
