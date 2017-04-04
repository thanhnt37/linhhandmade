<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contact;
use App\FormType;
use App\Form;

class ContactController extends Controller
{
    public function index($id){
    	$formtype = FormType::find($id);
    	return view('backend.contacts.index',compact('formtype')); 

    }
   	public function delForm(Request $req){
   		$id = $req->id;
   		$form = Form::find($id);
   		if(sizeof($form)){
   			$form->delete();
   			return json_encode(array('status'=>true));
   		}
   		return json_encode(array('status'=>false));
   	}
}
