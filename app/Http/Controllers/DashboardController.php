<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Iqbalatma\LaravelExtend\Exceptions\EmptyDataException;
use Iqbalatma\LaravelTelegramBotChannelAsync\Log;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): Response
    {
        throw new EmptyDataException();
        Log::critical("ini critical");
        return response()->view("dashboard.index", ["title" => "Dashboard"]);
    }
}
