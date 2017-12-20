<?php

namespace App\Http\Controllers\Auth;
use Session;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Coordenador;
use App\Aluno;
use App\Professor;
use DB;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('guest', ['except' => 'logout']);
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(){
        return view('login.login');
    }

    public function postLogin(Request $request){
        
        $dados=$request->except('_token');
        
        $validador = Validator::make($dados, [
            'usuário' => 'required|min:4|max:30',
            'senha' => 'required|min:5|max:60'
        ]);

        $dada_auth = ['login' => $dados['usuário'], 'password' => $dados['senha']];

        if($validador->fails())
        {
           
            return redirect('/login')->withErrors($validador);
        }

        if(Auth::attempt($dada_auth))
        {
            return redirect('/');
        }
         \Session::flash('er' , 'Usuario ou senha não confere.');
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect ('/login');
    }

    public function recuperarSenha()
    {
        $request=\Request::except('_token');

        $validator= Validator::make($request,[
                'login' =>'required|min:4|max:30'
            ],[
            'login.required' =>'Recuperar senha: o campo usuário é obrigatório.',
            'login.min' =>'Recuperar senha: o usuário deve ter no mínimo 4 caracter.',
            'login.max' =>'Recuperar senha: o usuário deve ter no máximo 30 caracter.',
        ]);

        if($validator->fails()){

            return redirect('/login')->withErrors($validator);
        }

        $usuario= User::where('login', '=', $request)->get();
        if (count($usuario) ==0 ){
            \Session::flash('er', 'Recuperar Senha: usuário não existe');
            return redirect('/login');
        }
       
        $coordenador= Coordenador:: where('id_usuario_fk', '=', $usuario[0]['id_usuario'])->get();
        if (count($coordenador)>0) {
            $result = Professor::where('id_professor', '=', $coordenador[0]->id_professor_fk)->get();
            $email=$result[0]->email_professor;
        }
        else{
            $result= Aluno:: where('id_usuario_fk', '=', $usuario[0]['id_usuario'])->get();
            $email=$result[0]->email_aluno;
        }

        DB::beginTransaction();
        try
        {
            $tamanho = 10;
            $maiusculas = true;
            $numeros = true;
            $simbolos = true;
            $lmin = 'abcdefghijklmnopqrstuvwxyz';
            $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $num = '1234567890';
            $simb = '!@#$%*-';
            $retorno = '';
            $caracteres = '';

            $caracteres .= $lmin;
            if ($maiusculas) $caracteres .= $lmai;
            if ($numeros) $caracteres .= $num;
            if ($simbolos) $caracteres .= $simb;

            $len = strlen($caracteres);

            for ($n = 1; $n <= $tamanho; $n++)
            {
                $rand = mt_rand(1, $len);
                $retorno .= $caracteres[$rand-1];
            }

            $usuario[0]->update(['password' => bcrypt($retorno)]);
            Mail::raw('Sua nova senha é: '. $retorno, function ($message) use ($email){
                $message->from('ifes.alegre.tcc@gmail.com', 'IFTCC');
                $message->to($email);
                $message->subject('Pedido de Alteração de Senha');
            });
            
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollback();
            Log::info('ALTERAÇÃO DE  SENHA', ['Exception' => $e]);
            \Session::flash('er','Alteração de senha não realizada.');
            return redirect('/login');
        }
        \Session::flash('sucesso', 'Senha alterada com sucesso. Verifique o seu e-mail');
        return redirect('/login');

    }
}
