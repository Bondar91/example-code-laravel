<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
        $this->middleware('web');
    }

    public function dashboard()
    {
        return redirect('/admin/orders?tab=complete&show_tests=false&sort=id&direction=desc');
    }
}
