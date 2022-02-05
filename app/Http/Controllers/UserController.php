<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $title = "";
        View::share(compact('title'));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Create a new user instance after a valid registrati  on.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['unique:users','required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'tel' => ['required', 'string'],
        ]);

        $user = User::create([
                'name' => $request->input()['name'],
                'email' => $request->input()['email'],
                'password' => Hash::make($request->input()['password']),
                'tel' => $request->input()['tel'],
                ]);

        return redirect()->route('users.login'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $identifiants = $request->only('email', 'password');
        if (Auth::attempt($identifiants)) {
            $request->session()->regenerate();
            if($request->input()["page"])
                return redirect()->to($request->input()["page"]);
            elseif(Auth::user()->isAdmin())
                return redirect()->route('admin');
            return redirect()->route('accueil');
        }

        return back()->withErrors([
            'erreur' => 'Identifiant ou mot de passe incorrecte',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('users.login');
    }

    
}
