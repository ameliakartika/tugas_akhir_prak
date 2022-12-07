<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Models\matakuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
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
    public function createMahasiswa(Request $request)
    {
        $mahasiswa = mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'password' => $request->password,
            'prodiId' => $request->prodiId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'New Mahasiswa created',
            'data' => [
                'mahasiswa' => $mahasiswa
            ]
        ]);
    }

    public function getMahasiswaById($nim)
    {
        $mahasiswa = mahasiswa::with('matakuliah', 'prodi')->find($nim);
        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa grabbed',
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function getMahasiswaByToken(Request $request)
    {
        $mahasiswa = $request->mahasiswa;
        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa grabbed',
            'mahasiswa' => $mahasiswa
        ]);
    }
    
    public function getMahasiswas()
    {
        $mahasiswas = mahasiswa::with('prodi')->get();

        return response()->json([
            'status' => 'Success',
            'message' => 'all mahasiswas grabbed',
            'mahasiswa' => $mahasiswas,

        ], 200);
    }

    public function addMatakuliah(Request $request, $nim, $mkId)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);

        if ($request->mahasiswa->nim !== $mahasiswa->nim) {
            return \response()->json([
                "success" => false,
                "message" => "matakuliah added to mahasiswa"
            ]);
        }

        $mahasiswa->matakuliah()->attach([$mkId]);

        return response()->json([
            'success' => true,
            'message' => 'matakuliah added to ur profile',
        ]);
    }

    public function deleteMatakuliah(Request $request, $nim, $mkId)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);

        if ($request->mahasiswa->nim !== $mahasiswa->nim) {
            return \response()->json([
                "success" => false,
                "message" => "matakuliah deleted to mahasiswa"
            ]);
        }

        $mahasiswa->matakuliah()->detach([$mkId]);
        return response()->json([
            'success' => true,
            'message' => 'matakuliah deleted from profile',
        ]);
    }
}