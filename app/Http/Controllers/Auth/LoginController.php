<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/blog/show';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public static function index() {
        if(\Auth::user()) {
            if(Auth::user()->user_role_id > 3) {
                $page_id = Auth::user()->page_id;
                if($page_id) {
                    return redirect()->route('page.edit',[$page_id]);
                } else {
                    // return custom error page
                    return abort(403);
                }
            }
            return redirect()->route('blog.show');
        }
        return view('auth.login');
    }

    public function login(Request $request) {
        if(\Auth::user()) {
            if(Auth::user()->user_role_id > 3) {
                $page_id = Auth::user()->page_id;
                if($page_id) {
                    return redirect()->route('page.edit',[$page_id]);
                } else {
                    // return custom error page
                    return abort(403);
                }
            }
            return redirect()->route('blog.show');
        }
        $data = $request->all();
        $data['email'] = trim($request->input('email'));
        $request->replace($data);

        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required',
        ], [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'El correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $user = User::where('email', 'LIKE', $request->input('email'))->first();
        if($user !== NULL && Hash::check($request->input('password'), $user->password)) {
            if (Auth::loginUsingId($user->user_id)) {
                if(Auth::user()->user_role_id > 3) {
                    $page_id = Auth::user()->page_id;
                    if($page_id) {
                        return redirect()->route('page.edit',[$page_id]);
                    } else {
                        // return custom error page
                        return abort(403);
                    }
                }
                return redirect()->route('blog.show');
            } else {
                \Session::flash('alertMessage','El usuario y/o contraseña es incorrecto');
                \Session::flash('alert-class','alert-danger');
                return redirect()->route('login')->withInput();
            }
        } else {
            \Session::flash('alertMessage','El usuario y/o contraseña es incorrecto');
            \Session::flash('alert-class','alert-danger');
            return redirect()->route('login')->withInput();
        }
    }

    public static function logOut() {
        Auth::logout();
        return redirect()->route('home');
    }
}
