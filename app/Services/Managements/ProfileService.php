<?php

namespace App\Services\Managements;

use App\Contracts\Abstracts\Services\BaseService;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class ProfileService extends BaseService
{
    /** @var UserRepository  */
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->breadcrumbs = [
            "Management" => "#",
            "Profile" => route('management.profiles.edit'),
        ];
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
                "pageTitle" => "Profile",
                "pageDescription" => "Update detail information on profile",
                "cardTitle" => "Update Profile",
                "breadcrumbs" => $this->getBreadcrumbs()
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
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
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }

}
