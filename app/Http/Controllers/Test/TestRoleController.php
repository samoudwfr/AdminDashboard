<?php

namespace App\Http\Controllers\Test;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestRoleController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('test.testRoles', compact('customers'));
    }
}
