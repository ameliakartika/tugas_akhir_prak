<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class AuthController extends Controller
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

    public function register(Request $request)
    {

        $mahasiswa = mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'password' => Hash::make($request->password),
            'prodiId' => $request->prodiId,
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'new user created',
            'mahasiswa' => $mahasiswa,

        ], 200);
    }

    public function login(Request $request)
    {
        $nim = $request->nim;
        $password = $request->password;

        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'Error',
                'message' => 'user not exist',
            ], 404);
        }

        if (!Hash::check($password, $mahasiswa->password)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'wrong password',
            ], 400);
        }

        $mahasiswa->token = $this->jwt($mahasiswa); //
        $mahasiswa->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'successfully login',
            'token' => $mahasiswa->token
        ], 200);
    }

    protected function jwt(mahasiswa $mahasiswa)
    {
      $payload = [
        'iss' => 'lumen-jwt', //issuer of the token
        'sub' => $mahasiswa->nim, //subject of the token
        'iat' => time(), //time when JWT was issued.
        'exp' => time() + 60 * 60 //time when JWT will expire
      ];
  
      return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    //
}
