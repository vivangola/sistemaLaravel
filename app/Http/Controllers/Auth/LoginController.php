<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Session;

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
    }

    public function index(){
        
        if(Auth::user()){
            return redirect()->action('HomeController@index');
        }else{
            return view('auth.login');
        }
        
    }

    public function login(Request $request){

        $this->validate($request, [
            'login' => 'required', 
            'senha' => 'required'
        ]);
        
        $lembrar = !empty($request->lembrar);
        $usuario = User::where('login', $request->login)->first();
        
        if(!empty($usuario)){
            if(Hash::check($request->senha, $usuario->password)){
                Auth::loginUsingId($usuario->login, $lembrar);
                return redirect()->action('Auth\LoginController@index');
            }else{
                return redirect()->back()->withInput()->withErrors(['Senha inválida!']);    
            }
            
        }else{
            return redirect()->back()->withInput()->withErrors(['Usuário inválido!']);
        }

        return redirect()->back()->withInput()->withErrors(['Erro ao efetuar login!']);
       
    }

    public function logout(Request $request){

         Auth::logout();
         Session::flush();
         return redirect()->action('Auth\LoginController@index');
         
     }
}
