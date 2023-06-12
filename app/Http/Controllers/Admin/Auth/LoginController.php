<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Core\Support\Http\Controllers\BaseController;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * @var BaseHttpResponse
     */
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @param BaseHttpResponse $response
     */
    public function __construct(BaseHttpResponse $response)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->redirectTo = config('general.admin_dir');
        $this->response = $response;
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('access.login');
    }
}
