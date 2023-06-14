<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Services\Managements\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * @param ProfileService $service
     * @return Response
     */
    public function edit(ProfileService $service):Response
    {
        $response = $service->getEditData();
        if ($this->isError($response, "dashboard")) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("managements.profiles.edit");
    }
}
