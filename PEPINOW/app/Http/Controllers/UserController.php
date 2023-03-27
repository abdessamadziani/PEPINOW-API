<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{


    public function login(Request $request)
    {
        //
        $fields=$request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $user=user::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'],$user->password))
        {
            return response(['message'=>'UserName OR Password incorrect']);
        }



        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=
            [
                'user'=>$user,
                'token'=>$token
            ];

        return response($response);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    public function register(Request $request)
    {
        $fields=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        $user= User::create([

            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)

        ]);
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=
            [
                'user'=>$user,
                'token'=>$token
            ];

        return response($response);

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

     public function updateuser(Request $request, string $id)
     {

        //   $user= User::all();
        //  $user= new UserResource($user);

         //
         // $user=user::find($user);
        //  $this->validate($request,[
        //      'name'=>'required',
        //      'email'=>'required',
        //      'password'=>'required',
        //  ]);


        //  $user=user::find($id);
        //  $userauthid=auth()->user()->id;

        //      if(($user->id)==$userauthid)
        //      {
        //          $user->update([
        //              'name'=>$request->name,
        //              'email'=>$request->email,
        //              'password'=>$request->password,
        //          ]);

        //          return response()->json($user);
        //       }
        //       else
        //       return response()->json(['message'=>'sorry you dont not have the access to update this user ']);




     }
    public function update(Request $request, string $id)
    {
        //

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',


        ]);
        $user=User::find($id);
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user=user::find($id);
        $user->delete();
        return response()->json(['message'=>' user deleted successfully']);
    }

    public function logout()
    {

         auth()->user()->tokens()->delete();

         return ['message'=> ' you are Logged Out'];
    }
}
