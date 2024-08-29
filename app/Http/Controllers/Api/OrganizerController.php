<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organizer;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;

class OrganizerController extends Controller
{
    public function index()
    {
        $data = Organizer::all();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Organizer List",
            
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'     => 'required',
            'description'   => 'required',
            'avatar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username_ig'   => 'required',
            'header_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

         //upload image
        $image = $request->file('avatar');
        $hash = $image->hashName();
        $image->move(public_path('avatar'), $hash);
        //create post
        $data = Organizer::create([
            
            'full_name'     => $request->full_name,
            'description'   => $request->description,
            'avatar'     => $hash,
            'username_ig'   => $request->username_ig,
            'header_id' => $request->header_id
        ]);

       
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Organizer created successfully.",
           
        ]);
    } 
    public function show($id)
    {
        $data = Organizer::find($id);
        if (is_null($data)) {
            return $this->sendError('Organizer not found.');
        }
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Organizer retrieved successfully."
            
        ]);
    }

    public function update(Request $request, Organizer $organizer)
    {
      


// var_dump($request); exit;
        //upload image
        // $image = $request->file('image');
        // $hash = $image->hashName();
        // $image->move(public_path('images'), $hash);

        // $organizer->update([
        //         'image'     => $hash,
        //         'name'     => $request->name,
        //         'product_id'   => $request->product_id,
        //     ]);
        return response()->json([
        "success" => true,
        "message" => "Organizer updated successfully.",
        "data" => $request->all(),
        ]);

        

        //check if image is not empty
        // if ($request->hasFile('image')) {

            //upload image
         
            //delete old image
            // Storage::delete('public/images/'.$organizer->image);

            //update post with new image
            
        // } else {

            //update post without image
            // $organizer->update([
            //     'name'     => $request->name,
            //     'product_id'   => $request->product_id,
            // ]);
        // }

        

    }
    public function destroy(Organizer $organizer)
    {
        $organizer->delete();
        return response()->json([
            "data" => $organizer,
            "success" => true,
            "message" => "Organizer deleted successfully.",
            
        ]);
    }
}
