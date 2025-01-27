<?php

namespace App\Http\Controllers;

use App\Services\SomeConcreteClass;
use App\Models\RateContract;
use Illuminate\Http\Request;


class RateContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rate-contract.index');
    }

    public function asteng()
    {
        return view('rate-contract.asteng');
    }

    public function asbar()
    {
        return view('rate-contract.asbar');
    }

    public function astim()
    {
        return view('rate-contract.astim');
    }
}
