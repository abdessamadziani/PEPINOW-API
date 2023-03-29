<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // dd(auth()->user());
        if( auth()->user()->hasAnyRole(['admin','vendeur','user'])){
            return Category::all();
        }else{
            return "you dont have permission to do that ";
        }

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
        $user = auth()->user();
        if($user->hasAnyRole(['admin'])){

        $this->validate($request,[
            'category'=>'required',
        ]);

        return Category::create($request->all());
        }
        else{
            return "you dont have permission to do that ";
        }
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
    public function update(Request $request, string $id)
    {
        //
        $user = auth()->user();

        if($user->hasAnyRole(['admin'])){

        $this->validate($request,[
            'category'=>'required',

        ]);
        $cat=Category::find($id);
        $cat->update($request->all());
        return response()->json($cat);
    }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = auth()->user();

        if($user->hasAnyRole(['admin'])){

        $cat=Category::find($id);
        $cat->delete();
        return response()->json(['message'=>' Category deleted successfully']);
        }
        else{
            abort(403);
        }

    }
}
