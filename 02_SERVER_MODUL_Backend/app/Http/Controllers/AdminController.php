<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
       $admin = Administrator::all();
        return response()->json([
            'totalElement' =>$admin->count(),
            'content' =>$admin->map(function ($admin){
                return [
                    'username' => $admin->username,
                    'last_login_at' =>$admin->last_login_at,
                    'created_at' => $admin->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $admin->updated_at->format('Y-m-d H:i:s'),
                ];
            })
        ],200);
    }
}
