<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:blogger')->except('logout');
    }
    
    protected function showAdminLoginForm(){
      return view('auth.login', ['url' => 'admin']);
    }
    
    protected function showBloggerLoginForm(){
      return view('auth.login', ['url' => 'blogger']);
    }
    
    protected function adminLogin(Request $req){
      $req->validate([
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      
      if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password], $req->get('remember'))) {
        return redirect()->route('admin'); 
      }
      
      return redirect()->back();
    }
    
    protected function bloggerLogin(Request $req){
      $req->validate([
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      
      if (Auth::guard('blogger')->attempt(['email' => $req->email, 'password' => $req->password], $req->get('remember'))) {
        return redirect()->route('blogger'); 
      }
      
      return redirect()->back();
    }
}
