<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getAllContacts (Request $request)
    {
    // dump($request->query('name')); //pasar por query params info
    return 'Get All Contacts';
    }

    public function getContactById ($id)
    {
        return 'Get Contact By ID: '. $id;
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
