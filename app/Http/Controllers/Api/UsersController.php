<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class UsersController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ]);
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return \response()->json([
                "message" =>  "The given data was invalid.",
                "errors" =>  [
                    "password" => [
                        "The old password incorrect."
                    ]
                ]
            ], 422);
        }

        // if($request->password === $request->old_password){
        //     return \response()->json([
        //         "message" =>  "The given data was invalid.",
        //         "errors" =>  [
        //             "password" => [
        //                 "The old password and new password is the same."
        //             ]
        //         ]
        //     ], 422);
        // }
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);
        return \response()->json([
            'message' => "Update profile successfuly"
        ], 200);
    }
}
