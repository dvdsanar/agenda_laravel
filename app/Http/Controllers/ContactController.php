<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function getAllContacts (Request $request)
    {
    // dump($request->query('name')); //pasar por query params info
        $contacts = DB::table('contacts')->where('id_user','=', 7)->get()->toArray();
        
        return $contacts;
    }

    public function getContactById ($id)
    {
        // $contact = DB::table('contacts')->where('id_user','=', 1)->where('id','=', $id)->get()->toArray();
        $contact = DB::table('contacts')->where('id_user','=', 7)->find($id);
        return $contact;
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
