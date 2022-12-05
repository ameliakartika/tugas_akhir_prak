<?php

namespace App\Http\Controllers;

use App\Models\prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //
    public function getProdi()
    {
        $prodis = prodi::All();

        return response()->json([
            'success' => true,
            'message' => 'All Prodi Grabbed',
            'prodi' => $prodis
        ]);
    }
}