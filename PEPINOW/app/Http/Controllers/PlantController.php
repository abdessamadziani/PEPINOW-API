<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;


class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Plant::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'image'=>'required',
            'category_id'=>'required',
            'user_id'=>'required'

        ]);

        $image = $request->image;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path=public_path('upload');
        $image->move($path, $filename);


        $plant= Plant::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=>$filename,
            'category_id'=>$request->category_id,
            'user_id'=>$request->user_id
            //$request->all()

    ]);

        return response(['message'=>'plant added successffuly','status'=>true],200);
    }







    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //


        $plant=plant::find($id);

        return response()->json($plant);

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
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'image'=>'required',
            'category_id'=>'required',
            'user_id'=>'required'

        ]);
        $image = $request->image;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path=public_path('upload');
        $image->move($path, $filename);


        $plant=Plant::find($id);
        $plant->update(
            [
                'name'=>$request->name,
                'description'=>$request->description,
                'price'=>$request->price,
                'image'=>$filename,
                'category_id'=>$request->category_id,
                'user_id'=>$request->user_id
            ]
        );
        return response(['message'=>'plant updated successffuly','status'=>true],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $plant=Plant::find($id);
        $plant->delete();
        return response()->json(['message'=>' plant deleted successfully']);
    }
}
