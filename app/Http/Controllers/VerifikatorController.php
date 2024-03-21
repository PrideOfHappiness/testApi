<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use Illuminate\Http\Request;

class VerifikatorController extends Controller
{
    public function verifyPermission(Request $request, Izin $izin){
        $request->validate([
            'status' => 'required',
            'commented' => 'required',
        ]);

        $izin->update([
            'status' => $request->status,
            'komentar' => $request->comment,
        ]);

        return response()->json($izin, 201);
    }

    public function verifyUser(Request $request, User $user){
        $user->update(['verified' => true]);
        return response()->json($user);
    }
}
