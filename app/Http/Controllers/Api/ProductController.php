<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
       
        // $auth = auth()->guard('api')->user();
        // var_dump($auth); exit;
        // echo 'Yess';
        $data = Product::all();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Product List",
            
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'product' => 'required',
            'type' => 'required',
            'price' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $product = Product::create($input);
        return response()->json([
            "data" => $product,
            "success" => true,
            "message" => "Product created successfully.",
           
        ]);
    } 

    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        return response()->json([
            "data" => $product,
            "success" => true,
            "message" => "Product retrieved successfully."
            
        ]);
    }

    public function update(Request $request, Product $product)
    {
        // $data = new Product($request)->save()
        $product->update($request->all());

        return response()->json([
        "success" => true,
        "message" => "Product updated successfully.",
        "data" => $product
        ]);
        // return response(['project' => new Product($product), 'message' => 'Update successfully'], 200);
    
        
    }

    public function destroy(Product $product) 
    {
        $product->delete();
        return response()->json([
            "data" => $product,
            "success" => true,
            "message" => "Product deleted successfully.",
            
        ]);
    }
}
