<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Theme;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;


class ThemeController extends Controller
{
    
    public function index()
    {
        $data = Theme::with('product')->get();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Theme List",
            
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'     => 'required',
            'product_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

         //upload image
        $image = $request->file('image');
        $hash = $image->hashName();
        $image->move(public_path('images'), $hash);
        //create post
        $data = Theme::create([
            'image'     => $hash,
            'name'     => $request->name,
            'product_id'   => $request->product_id,
        ]);

       
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Theme created successfully.",
           
        ]);
    } 
    public function show($id)
    {
        $data = Theme::find($id);
        if (is_null($data)) {
            return $this->sendError('Theme not found.');
        }
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Theme retrieved successfully."
            
        ]);
    }

    public function update(Request $request, Theme $theme)
    {
      


// var_dump($request); exit;
        //upload image
        // $image = $request->file('image');
        // $hash = $image->hashName();
        // $image->move(public_path('images'), $hash);

        // $theme->update([
        //         'image'     => $hash,
        //         'name'     => $request->name,
        //         'product_id'   => $request->product_id,
        //     ]);
        return response()->json([
        "success" => true,
        "message" => "theme updated successfully.",
        "data" => $request->all(),
        ]);

        

        //check if image is not empty
        // if ($request->hasFile('image')) {

            //upload image
         
            //delete old image
            // Storage::delete('public/images/'.$theme->image);

            //update post with new image
            
        // } else {

            //update post without image
            // $theme->update([
            //     'name'     => $request->name,
            //     'product_id'   => $request->product_id,
            // ]);
        // }

        

    }
    public function destroy(Theme $theme)
    {
        $theme->delete();
        return response()->json([
            "data" => $theme,
            "success" => true,
            "message" => "Theme deleted successfully.",
            
        ]);
    }
}
