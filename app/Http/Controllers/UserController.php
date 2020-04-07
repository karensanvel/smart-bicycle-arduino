<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Ajax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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
        $this->middleware('auth')->except('showRegisterForm','store','getNumber', 'getUsername', 'getId'); 
       
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
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json($user);
        //return redirect()->intended(route('user.index')); back()->withSuccess('User '.$request->username.' has been created successfully');
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
    
}

