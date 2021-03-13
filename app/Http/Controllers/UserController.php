<?php

namespace App\Http\Controllers;

use App\Models\User;

class USerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDetail($id){

        $user = User::find($id);

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => '',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success to get detail user',
            'data' => $user,
        ], 200);
    }
}
