<?php

namespace App\Services\User;

use App\Core\Support\Services\ProduceServiceInterface;
use App\Models\User;
use App\Repositories\User\Interfaces\RoleInterface;
use App\Repositories\User\Interfaces\UserInterface;
use Hash;
use Illuminate\Http\Request;

class CreateUserService implements ProduceServiceInterface
{

    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * @var RoleInterface
     */
    protected $roleRepository;

    /**
     * CreateUserService constructor.
     *
     * @param UserInterface $userRepository
     * @param RoleInterface $roleRepository
     */
    public function __construct(
        UserInterface $userRepository,
        RoleInterface $roleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Request $request
     *
     * @return User|false|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function execute(Request $request)
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->createOrUpdate(array_merge($request->input()));

        if ($request->has('username') && $request->has('password')) {
            $this->userRepository->update(['id' => $user->id], [
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
            ]);
        }

        return $user;
    }
}
