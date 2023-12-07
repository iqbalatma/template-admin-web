<?php

namespace App\Contracts\Abstracts\Services;

abstract class BaseService extends \Iqbalatma\LaravelServiceRepo\BaseService {
    protected array $breadcrumbs;

    /**
     * Use to get all data breadcrumbs
     *
     * @return array
     */
    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }

    /**
     * Use to add new breadcrumb
     *
     * @param array $newBreadcrumbs
     * @return void
     */
    public function addBreadCrumbs(array $newBreadcrumbs): void
    {
        foreach ($newBreadcrumbs as $key => $breadcrumb) {
            $this->breadcrumbs[$key] = $breadcrumb;
        }
    }
}
