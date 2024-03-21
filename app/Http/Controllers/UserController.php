<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'username' => 'required',
            'name' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    
        $user = User::create([
            'username' => $request->username,
            'nama' => $request->name,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_access' => 'User',
            'status' => 'Active',
        ]);
    
        return response()->json($user, 201);
    }

    public function submitPermission(Request $request){
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'userID' => 'required',
        ]);

        $permission = Izin::create([
            'userID' => $request->userID,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => 'Menunggu validasi',
        ]);

        return response()->json($permission, 201);
    }

    public function getPermissionHistory(){
        $permissions = Izin::where('userID', Auth::user()->userID)->get();
        return response()->json($permissions);
    }

    public function updatePermissionHistory(Request $request, Izin $izin){
        $izin->update($request->all());
        return response()->json($izin, 200);
    }

    public function getPermissionStatus(Izin $izin){
        return response()->json($izin->status);
    }

    public function batalIzin(Izin $izin){
        $izin->delete();
        return response()->json(['message' => 'Izin dibatalkan']);
    }

    public function hapusIzin(Izin $izin){
        $izin->delete();
        return response()->json(['message' => 'Izin dihapus']);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'required|min:6',
        ]);
    
        $user = User::find(Auth::user()->userID);
        $user->update(['password' => bcrypt($request->password)]);
    
        return response()->json('Berhasil mengubah password', 200);
    }
}
