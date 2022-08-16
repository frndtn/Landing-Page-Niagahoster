<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table Products
        $products = Product::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Product',
            'data'    => $products  
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find Product by ID
        $product = Product::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Product',
            'data'    => $product 
        ], 200);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'price' => 'required',
            'final_price' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $product = Product::create([
            'name'     => $request->name,
            'price'   => $request->price,
            'final_price' => $request->final_price
        ]);

        //success save to database
        if($product) {

            return response()->json([
                'success' => true,
                'message' => 'Product Created',
                'data'    => $product  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Product Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'price' => 'required',
            'final_price' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find Product by ID
        $product = Product::findOrFail($product->id);

        if($product) {

            //update Product
            $product->update([
                'name'     => $request->name,
                'price'   => $request->price,
                'final_price' => $request->final_price
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product Updated',
                'data'    => $product  
            ], 200);

        }

        //data Product not found
        return response()->json([
            'success' => false,
            'message' => 'Product Not Found',
        ], 404);

    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find Product by ID
        $product = Product::findOrfail($id);

        if($product) {

            //delete Product
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product Deleted',
            ], 200);

        }

        //data Product not found
        return response()->json([
            'success' => false,
            'message' => 'Product Not Found',
        ], 404);
    }
}
