<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function getAllContacts (Request $request)
    {
        try {
            Log::info('Init Get all contacts');
            // dump($request->query('name')); //pasar por query params info
            //$contacts = DB::table('contacts')->where('id_user','=', 7)->get()->toArray();

            $contacts = Contact::where('id_user', 7)->get()->toArray();

            if (empty($contacts)) {
                return response()->json([
                    "success" => "No hay contactos"
                ],
                202);
            }
            Log::info('You Get all contacs');
            return response()->json($contacts, 200);
        } catch (\Throwable $th) {
            Log::error('Ha ocurrido un error -> '.$th->getMessage());
            return response()->json(["error" => "ups"], 500);
        }
    }

    public function getContactById ($id)
    {
        try {
            // $contact = DB::table('contacts')->where('id_user','=', 1)->where('id','=', $id)->get()->toArray();
            //$contact = DB::table('contacts')->where('id_user','=', 7)->find($id);

            $contact = Contact::where('id_user', 1)->where('id', $id)->first();

            if (empty($contact)) {
                return response()->json([
                    "error" => "Este contacto no existe"
                ],
                404);
            }

            return response()->json($contact, 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => "ups"], 500);
        }
    }

    public function postContact (Request $request)
    {
        try {
            //dump($request->all()); //pasar informacion por body y ver por console log todo
            //dump($request->all()['name']); //pasar informacion por body y ver por console log una clave de la request
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'surname' => 'required|string',
                'phone_number' => 'required|string',
                'email' => 'required|email'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }


            $newContact = new Contact();

            $newContact->name = $request->name;
            $newContact->surname = $request->surname;
            $newContact->phone_number = $request->phone_number;
            $newContact->email = $request->email;
            $newContact->id_user = $request->id_user;

            $newContact->save();

            
            return response()->json(["data"=>$newContact, "success"=>"Contacto Creado"], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => "ups"], 500);
        }
    }

    public function putContact (Request $request, $id)
    {
        try {
            $contact = Contact::where('id', $id)->where('id_user', 1)->first();

            if (empty($contact)) {
                return response()->json([
                    "error" => "Este contacto no existe"
                ],
                404);
            }
            
            if (isset($request->name))
                $contact->name = $request->name;

            if (isset($request->surname))
                $contact->surname = $request->surname;

            if (isset($request->phone_number))
                $contact->phone_number = $request->phone_number;

            if (isset($request->email))
                $contact->email = $request->email;

            $contact->save();

            return response()->json(["data"=>$contact, "success"=>"Contacto Actualizado"], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => "ups"], 500);
        }
    }

    public function deleteContact ($id)
    {
        try {
            $contact = Contact::where('id', $id)->where('id_user', 1)->first();

            if (empty($contact)) {
                return response()->json([
                    "error" => "Este contacto no existe"
                ],
                404);
            }

            $contact->delete();

            return response()->json([ "success"=>"Has eliminado el contacto: ".$id], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => "ups"], 500);
        }
    }
}
