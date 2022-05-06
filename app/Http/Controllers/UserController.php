<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    const ROLE_ADMIN_ID = 2;
    public function getUserByContactId($id)
    {
        try {
            Log::info('getUserByContactId');
            $user = Contact::find($id)->user;

            if(empty($user)){
                return response()->json([
                    'error' => 'Este contacto no pertenece a ningún usuario'
                ], 404);
            }
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            Log::error('Ha ocurrido un error '.$th->getMessage());
            return response()->json(["error" => "ups"], 500);
        }
    }
    public function createUserAdmin($id)
    {
        try {

            Log::info('Asignando un rol de Admin a un usuario');

            $user = User::find($id);

            $user->roles()->attach(self::ROLE_ADMIN_ID);

            return response()->json(["success" => "el usuario ".$id." ahora es admin"], 200);

        } catch (\Throwable $th) {
            Log::error('Ha ocurrido un error '.$th->getMessage());
            return response()->json(["error" => "ups"], 500);
        }
    }

    public function destroyUserAdmin($id)
    {
        try {

            Log::info('Asignando un rol de Admin a un usuario');

            $user = User::find($id);

            $user->roles()->detach(self::ROLE_ADMIN_ID);

            return response()->json(["success" => "el usuario ".$id." ha dejado de ser admin"], 200);

        } catch (\Throwable $th) {
            Log::error('Ha ocurrido un error '.$th->getMessage());
            return response()->json(["error" => "ups"], 500);
        }
    }
}
