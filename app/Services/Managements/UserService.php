<?php

namespace App\Services\Managements;

use App\Contracts\Abstracts\Services\BaseService;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class UserService extends BaseService
{
    /** @var UserRepository */
    protected $repository;
    protected RoleRepository $roleRepository;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->roleRepository = new RoleRepository();
        $this->breadcrumbs = [
            "Management" => "#",
            "Users" => route('users.index')
        ];
    }

    /**
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => ucfirst(trans("managements/users.title")),
            "pageTitle" => ucfirst(trans("managements/users.title")),
            "cardTitle" => ucwords(trans("managements/users.cardTitle")),
            "breadcrumbs"=> $this->getBreadcrumbs(),
            "users" => $this->repository->getAllDataPaginated()
        ];
    }


    /**
     * @param string $id
     * @return array
     */
    public function getDataById(string $id): array
    {
        try {
            $this->checkData($id);
            $user = $this->getServiceEntity();

            $roles = $this->roleRepository->getAllData();
            RoleService::setActiveRole($roles, $user);

            $this->addBreadCrumbs([
                "Edit" => route('users.edit', $id)
            ]);

            $response = [
                "success" => true,
                "subTitle" => ucfirst(trans("managements/users.subTitle")),
                "title" => ucfirst(trans("managements/users.title")),
                "user" => $user,
                "roles" => $roles,
                "breadcrumbs"=> $this->getBreadcrumbs(),
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => ucfirst($e->getMessage())
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


    /**
     * @param string $id
     * @param array $requestedData
     * @return array|true[]
     */
    public function updateDataById(string $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            /** @var User $user */
            $user = $this->getServiceEntity();
            $user->syncRoles($requestedData);

            $response = [
                "success" => true,
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => ucfirst($e->getMessage())
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        return $response;
    }
}
