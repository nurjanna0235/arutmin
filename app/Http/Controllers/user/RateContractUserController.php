<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RateContractUserController extends Controller
{
    public function index()
    {
       
        return view('user.rate-contract.index');
    }

    public function asteng(){

        return view('user.rate-contract.asteng');
    }
}

