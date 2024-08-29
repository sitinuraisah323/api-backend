<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Gallery;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;

class GalleryController extends Controller
{
    public function index()
    {
        $data = Gallery::all();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Gallery List",
            
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'gallery'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $images = [];
        foreach ($request->file('gallery') as $image) {
            //upload image
            $fileName = $image->hashName();
            $image->move(public_path('gallery'), $fileName);
            
            $imageModel = new Gallery();
            $imageModel->gallery = $fileName;
            $imageModel->header_id = $request->header_id;
            $imageModel->save();

            $images[] = $imageModel;
        }

        return response()->json([
            "data" => $images,
            "success" => true,
            "message" => "Gallery created successfully.",
           
        ]);
    } 
    public function show($id)
    {
        $data = Gallery::find($id);
        if (is_null($data)) {
            return $this->sendError('Gallery not found.');
        }
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Gallery retrieved successfully."
        ]);
    }

    public function update(Request $request, Gallery $Gallery)
    {

        // var_dump($request); exit;
        //upload image
        // $image = $request->file('image');
        // $hash = $image->hashName();
        // $image->move(public_path('images'), $hash);

        // $Gallery->update([
        //         'image'     => $hash,
        //         'name'     => $request->name,
        //         'product_id'   => $request->product_id,
        //     ]);
        return response()->json([
        "success" => true,
        "message" => "Gallery updated successfully.",
        "data" => $request->all(),
        ]);

        

        //check if image is not empty
        // if ($request->hasFile('image')) {

            //upload image
         
            //delete old image
            // Storage::delete('public/images/'.$Gallery->image);

            //update post with new image
            
        // } else {

            //update post without image
            // $Gallery->update([
            //     'name'     => $request->name,
            //     'product_id'   => $request->product_id,
            // ]);
        // }

    }
    public function destroy(Gallery $Gallery)
    {
        $Gallery->delete();
        return response()->json([
            "data" => $Gallery,
            "success" => true,
            "message" => "Gallery deleted successfully.",
            
        ]);
    }
}
