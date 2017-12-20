<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;
use DB;

class UserController extends Controller
{
	public function alterarSenha()
	{
		$user= Auth::user();

	    return view('alterarSenha',['user' => $user]);
	}


	public function alterarSenhaSalvar($id_usuario)
	{
		 $request= \Request::except('_token');

     	 $validator= Validator::make($request,[
     	 	'senha_atual' => 'required|min:6',
     	 	'confirmar_senha' =>'required|different:senha_atual|min:6|max:60',
     	 	'nova_senha' => 'required|min:6|max:60|same:confirmar_senha'
		]);

     	if($validator->fails()){

        return redirect('/alterar/senha')->withErrors($validator);
     	}

      	//  nova senha 
		$password=\Request::get('confirmar_senha');
		//  senha antiga que tem que ser compara com a que tá no banco 
		

        DB:: beginTransaction();
        try
        {
            $user =Auth::user();
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
        }

          if(Hash::check(\Request::get('senha_atual') , $user->password)) {

                DB::beginTransaction();
                try
                {

                    DB::table('usuarios')
                        ->where('id_usuario', $id_usuario)
                        ->update(['password' => bcrypt($password)]);
                    DB::commit();
                }
                catch(\Exception $e)
                {
                    DB::rollback();
                }    

                return redirect('/logout');   
            }
            else
            {
              \Session::flash('er','Insira a senha atual corretamente.');
              return redirect('/alterar/senha');
            }
        
    
    }

}
