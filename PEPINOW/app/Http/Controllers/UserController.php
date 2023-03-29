<?php

namespace App\Http\Controllers;


// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Models\Role;

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

    // public function login(Request $request)
    // {
    //     //
    //    $request->validate([
    //     'email' => 'required|string|email|exists:users',
    //     'password' => 'required|string'
    //    ]);

    //    $credentials = [
    //         'email' => $request->email,
    //         'password' => $request->password,
    // ]   ;


    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $accessToken = $user->createToken('pepinowToken')->plainTextToken;
    //         $personalAccessToken = PersonalAccessToken::findToken($accessToken);
    //         $personalAccessToken->expires_at = now()->addMinutes(50);
    //         $personalAccessToken->save();

    //         return response()->json([
    //             'user' => $user,
    //             'access_token' => $accessToken,
    //             'token_type' => 'Bearer',
    //         ]);
    //     }else{
    //         return response()->json(['error' => 'Invalid credentials'], 401);
    //     }


    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=User::all();

        return response()->json($users);
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
        $user->assignRole('user');

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
        $userauthid=auth()->user()->id;
        $user=User::find($id);

        if($user->id===$userauthid || auth()->user()->hasAnyRole(['admin']) )
            {
                $user=User::find($id);
                return response()->json($user);
            }
            else
            {
                return " you dont have permission to do that";

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
        // if( auth()->user()->hasAnyRole(['admin'])){


        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',

        ]);

          $user=User::find($id);
          $userauthid=auth()->user()->id;
          if($user->id===$userauthid || auth()->user()->hasAnyRole(['admin']) )
          {
            $user->update([

                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            return response()->json($user);
          }



    // }
    else
    {
        return " you dont have permission to do that";
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $userauthid=auth()->user()->id;
        $user=User::find($id);

        if($user->id===$userauthid || auth()->user()->hasAnyRole(['admin']))
            {
                $user=user::find($id);
                $user->delete();
                return response()->json(['message'=>' user deleted successfully']);
            }
        else
        {
            return " you dont have permission to do that";

        }

    }

    public function logout()
    {

         auth()->user()->tokens()->delete();

         return ['message'=> ' you are Logged Out'];
    }




    public function changeRole( Request $request, string $id)
    {

        if(auth()->user()->hasAnyRole(['admin'])){
            $user=User::find($id);
            $user->removeRole('admin');
            $user->removeRole('user');
            $user->removeRole('vendeur');
            $user->assignRole($request->RoleName);
            return response()->json(["Message "=> "Role changed successfully"]);

        }
        else
        {
            return "you are not Admin to do that";
        }
    }
}
