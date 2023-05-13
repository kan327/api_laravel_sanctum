<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SiswaController extends Authenticatable
{
    private $response = [
        "message" => null,
        "data" => null,
        "status" => null,
        "token" => null,
    ];

    public function register(Request $req)
    {
        // Validasi input dari request
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        try{
            // Tambahkan data siswa baru ke database
            $data = Siswa::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
            ]);

            // Beri respons dengan pesan "success" dan kode status 200
            $this->response['message'] = "success";
            $this->response['status'] = 200;
        }catch(Exception $e){
            // Jika terjadi error, beri respons dengan pesan error dan kode status 501
            $this->response['message'] = "Handle Error Occurred: " . $e->getMessage();
            $this->response['status'] = 501;
        }

        // Beri respons dengan data siswa yang baru ditambahkan ke database
        $this->response['data'] = $data;
        return response()->json($this->response, $this->response['status']);
    }

    public function login(Request $req)
    {
        // Validasi input dari request
        $data = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari data siswa dengan email yang cocok dari database
        $user = Siswa::where('email', $req->email)->first();

        // Jika data siswa dengan email yang cocok ditemukan dan password cocok
        if($user!= '[]' && Hash::check($req->password, $user->password)){
            // Buat token baru untuk akses personal
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            // Beri respons dengan pesan "success", data siswa yang cocok, token, dan kode status 200
            $this->response['message'] = "success";
            $this->response['status'] = 200;
            $this->response['data'] = $user;
            $this->response['token'] = $token;
        }
        // Jika data siswa dengan email yang cocok tidak ditemukan
        else if($user == '[]'){
            // Beri respons dengan pesan error "User Not Found" dan kode status 404
            $this->response['message'] = "Handle Error Occurred: User Not Found";
            $this->response['status'] = 404;
        }
        // Jika password atau email salah
        else{
            // Beri respons dengan pesan error "Wrong Password or Email Address, try again or register first" dan kode status 404
            $this->response['message'] = "Wrong Password or Email Address, try again or register first";
            $this->response['status'] = 404;
        }

        // Beri respons dengan data siswa yang baru ditambahkan
        return response()->json($this->response, $this->response['status']);
    }
    public function me(Request $request) // untuk sementara belum dipakai
    {
        $user = $request->user();
        $this->response['message'] = "success";
        $this->response['data'] = $user;
        return response()->json($this->response, 200);
    }
    
    public function logout(Request $request) // untuk sementara belum dipakai
    {
        $user = $request->user();
        $user->tokens()->delete();
        $this->response['message'] = "success";
        return response()->json($this->response, 200); 
    }
}
