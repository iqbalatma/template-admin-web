<?php

namespace App\Services\Managements;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
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


}
