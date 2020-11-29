<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Ajax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ContactCyclist;
use App\NumeroSerie;
use App\LecturaTemperaturaHumedad;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('showRegisterForm','store', 'storeContactForCyclist','getNumber', 'getUsername', 'getId', 'getCyclist'); 
       
    }
    public function index()
    {
        return view('index');
    }
    public function showRegisterForm()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'serialNumber'=>'required',
            'name' => 'required|max:255',
            'username' => 'required|min:5|max:20|unique:users',
            'password' => 'required|min:7|max:20|confirmed'
        ]);
    
        $user = new User;
        $user->idNumero= $request->serialNumber;
        $user->name = $request->name;
        $user->username = $request->username; 
        $user->user_type = $request->userType;
        $user->email_contact = $request->emailContact;
        $user->number_phone = $request->numberPhone;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json($user);
        //return redirect()->intended(route('user.index')); back()->withSuccess('User '.$request->username.' has been created successfully');
    }
    public function storeContactForCyclist(Request $request) { //malas practicas, no repetir
        $contactCyc = new ContactCyclist;
        $contactCyc->id_cyclist= $request->idCyclist;
        $contactCyc->id_contact = $request->idContact;
        $contactCyc->save();
        return response()->json($contactCyc);
    }
    public function getNumber($number)
    {
        $numero = NumeroSerie::where('numero', $number)->get();
        return response()->json($numero);
    }
    public function getId($id)
    {
        $user = User::where('idNumero', $id)->get();
        return response()->json($user);
    }
    public function getUsername($username)
    {
        $user = User::where('username', $username)->with('numero')->get();
        return response()->json($user);
    }
    public function getCyclist($id)
    {
        $user = User::where('user_type', 'cyclist')->where('idNumero', $id)->get();
        return response()->json($user);
    }
   
}

