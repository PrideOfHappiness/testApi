<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAllUsers(){
        $data = User::all();
        return response()->json($data);
    }

    public function registerVerifikator(Request $request){
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'status' => $request->status,
            'user_access' => 'Verifikator',
        ]);

        return response()->json($user, 201);
    }

    public function promoteUser(Request $request, User $user){
        $user->update(['role' => 'verifikator']);
        return response()->json($user);
    } 
    
    public function getAllPermissions(){
        $data = Izin::all();
        return response()->json($data);
    }

    public function resetPassword(Request $request, User $user){
        $request->validate([
            'password' => 'required|min:6',
        ]);
    
        $user->update(['password' => bcrypt($request->password)]);
        return response()->json($user);
    }
}
