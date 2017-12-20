<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Validator;
use App\Administrador;
use Auth;

class AdministradorController extends Controller
{
    
   public function editarPerfil()
   {
   		$user = Auth::user()->administrador;
    	return view('administrador.editarPerfilAdministrador', ['user' => $user]);
   }

   public function editarPerfilSalvar($id_usuario_fk)
   {
   		$request= \Request::except('_token');

		$validator= Validator::make($request,[

      		'email' => 'required|min:7|max:50'
      	]);

		if($validator->fails()){

        	 return redirect('/administrador/editar/perfil')
                        ->withErrors($validator);
      	}
      	$email=\Request::get('email');

      	DB::beginTransaction();
    	try
        {

      		$user=DB::table('administradores')
            	->where('id_usuario_fk', $id_usuario_fk)
            	->update(['email_administrador' => $email]);

            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
        }





      	\Session::flash('sucesso','Email alterado com sucesso.');
      return redirect('/administrador/editar/perfil');

   }
}
