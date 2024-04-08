<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $headers = array();
        $product = Product::all();
        return response()->json($product, 200, $headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $headers = array();
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product = new product();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileAllowedextension = ['pdf', 'jpg', 'png'];
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, $fileAllowedextension)) {
                $name = time() . $file->getClientOriginalName();
                $file->move('image', $name);
                $product->photo = $name;
            }
        }

        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        if ($product->save()) {
            return response()->json($product, 200, $headers);
        } else {
            return response()->json($product, 400, $headers);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $headers = array();
        $product = Product::find($id);
        return response()->json($product, 200, $headers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $headers = array();
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product = product::find($id);

        if ($request->hash_file('photo')) {
            $file = $request->file('photo');
            $fileAllowedextension = ['pdf', 'jpg', 'png'];
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, $fileAllowedextension)) {
                $name = time() . $file->getClientOriginalName();
                $file->move('image', $name);
                $product->photo = $name;
            }
        }

        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        if ($product->save()) {
            return response()->json($product, 200, $headers);
        } else {
            return response()->json($product, 400, $headers);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $headers = array();
        $product = Product::find($id);
        $product->delete();
        return response()->json($product, 200, $headers);
    }
}
