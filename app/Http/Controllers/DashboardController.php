<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): Response
    {
        viewShare(["title" => "Dashboard", "subTitle" => "Dashboard"]);
        return response()->view("dashboard.index");
    }
}
