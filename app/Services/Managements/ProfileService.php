<?php

namespace App\Services\Managements;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class ProfileService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    /**
     * @return array
     */
    public function getEditData():array
    {
        try {
            $this->checkData(Auth::id());
            $user = $this->getServiceEntity();

            $response = [
                "success" => true,
                "user" => $user,
                "title" => "Profile",
                "cardTitle" => "Profile",
                "subTitle" => "Profile",
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse();
        }

        return  $response;
    }


    /**
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(array $requestedData): array
    {
        try {
            $this->checkData(Auth::id());
            $user = $this->getServiceEntity();

//            upload file
            if (request()->hasFile("profile_image")) {
                $profile = request()->file("profile_image");
                $uploaded = Storage::putFile("profiles", $profile);
                $requestedData["profile_image"] = $uploaded;
            }


//            save data
            $user->fill($requestedData);
            $user->save();

            $response = [
                "success" => true
            ];
        } catch (\Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }

}
