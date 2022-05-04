<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function getAllContacts (Request $request)
    {
    // dump($request->query('name')); //pasar por query params info
        //$contacts = DB::table('contacts')->where('id_user','=', 7)->get()->toArray();

        $contacts = Contact::where('id_user', 7)->get()->toArray();

        if (empty($contacts)) {
            return response()->json([
                "success" => "No hay contactos"
            ],
            202);
        }
        
        return response()->json($contacts, 200);
    }

    public function getContactById ($id)
    {
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
    }

    public function postContact (Request $request)
    {
        dump($request->all()); //pasar informacion por body y ver por console log todo
        dump($request->all()['name']); //pasar informacion por body y ver por console log una clave de la request
        return 'You create a new contact';
    }

    public function putContact ($id)
    {
        return 'You update contact: '. $id;
    }

    public function deleteContact ($id)
    {
        return 'You delete contact: '. $id;
    }
}
