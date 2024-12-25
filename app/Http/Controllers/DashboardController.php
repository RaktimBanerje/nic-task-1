<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() 
    {
        $user  = auth()->user();
        $role = $user->roles()->first();

        if($role->name == "head_master") {
            return view('head_master.index');
        }
        else {
            
            if(auth()->user()->is_approve) {
                return view('teacher.index');
            }
            else {
                return redirect()->route('teacher.under_review');
            }
        }
    }

    public function under_review()
    {
        return view('teacher.under_review');
    }
}
