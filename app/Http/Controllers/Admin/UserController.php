<?php

namespace App\Http\Controllers\Admin;

use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Repositories\User\Eloquent\RoleRepository;
use App\Repositories\User\Interfaces\RoleInterface;
use App\Repositories\User\Interfaces\UserInterface;
use App\Services\User\CreateUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserInterface
     */
    protected $userRepository;
    /**
     * @var RoleRepository
     */
    protected $roleRepository;
    /**
     * @var string
     */
    protected $redirectTo;

    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->userRepository;
        $roles = $this->roleRepository->getList([
            '' => 'Select role'
        ], []);
        return view('admin.users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @param CreateUserService $service
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(CreateUserRequest $request, CreateUserService $service, BaseHttpResponse $response)
    {
        try {
            $service->execute($request);
            return $response->setPreviousUrl(route('users.index'))->setMessage(trans('notices.create_success_message'));

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findOrFail($id);
        $roles = $this->roleRepository->getList([
            '' => 'Select role'
        ], []);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
