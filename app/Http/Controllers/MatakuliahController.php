<?php

namespace App\Http\Controllers;

use App\Models\matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
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

    public function getMatakuliah()
    {
        $matakuliah = matakuliah::All();

        return response()->json([
            'success' => true,
            'message' => 'All Matakuliah Grabbed',
            'matakuliah' => $matakuliah
        ]);
    }
}