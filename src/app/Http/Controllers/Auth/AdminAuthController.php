<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Session;


class AdminAuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLogin(): Factory|View|Application
    {
        return view('admin.login');
    }

    /**
     * @throws ValidationException
     */
    public function adminLogin(Request $request): Redirector|Application|RedirectResponse
    {
        $this->validate($request, [
            'username' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        $admin = Admin::where([
            ['username', $request['username']],
            ['password', $request['password']],
        ])->first();

        //Check if the user exists
        if (empty($admin)) {
            $this->logout();
            return back()->withErrors('Der Admin-Account existiert nicht.');
        }

        //Tries to authenticate
        if(Auth::guard('admin')->loginUsingId($admin->id)){
            //Success
            return redirect('/admin/dashboard');
        }

        return back()->withErrors('Es konnte sich nicht eingeloggt werden.');
    }

    public function logout (): Redirector|Application|RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return redirect('/admin/login');
    }
}
