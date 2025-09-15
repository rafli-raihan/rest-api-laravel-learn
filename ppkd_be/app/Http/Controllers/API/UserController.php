<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Psy\CodeCleaner\ReturnTypePass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return response()->json([
            'data' => $users,
            'status' => true,
            'message' => 'Fetch data success'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // $validator = Validator::make($request->all(),[
            //     'name'  => 'required|string',
            //     'email'  => 'required|string|email|unique:users,email',
            //     'password'  => 'required|min:8',
            // ]);
            // if($validator->fails()){
            //     return response()->json([
            //         'message'=>'Validatoion Fail',
            //         'errors' => $validator->errors()
            //     ], 422);
            // }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Create user success',
                'data' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            //code...
            $users = User::find($id);
            return response()->json([
                'data' => $users,
                'status' => true,
                'message' => 'Fetch data success'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            $user = User::findOrFail($id); // pake ini klo misalnya error find data mau ditampilin lebih detail penyebabnya
            $user->name = $request->name;
            $user->name = $request->name;
            if ($request->filled('password')) {
                # code...
                $user->password = $request->password;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'Update user success',
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            //code...
            User::find($id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Delete user success'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
