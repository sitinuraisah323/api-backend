<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Header;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;
class HeaderController extends Controller
{
    public function index()
    {
        $data = Header::all();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Header List",
            
        ]);
    }
    public function store(Request $request)
    {
    
        $user = JWTAuth::parseToken()->authenticate();
        
        $validator = Validator::make($request->all(), [
            'event_title' => 'required',
            'welcome_text' => 'required',
            'cover_overview' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_header' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_start_date' => 'required',
            'product_id' => 'required',
            'user_id' => 'required',
            'theme_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

         //upload image cover_overview
        $co = $request->file('cover_overview');
        $cover_overview = $co->hashName();
        $co->move(public_path('cover_overview'), $cover_overview);

         //upload image cover_header
        $ch = $request->file('cover_header');
        $cover_header = $ch->hashName();
        $ch->move(public_path('cover_header'), $cover_header);
        
        //create post
        $data = Header::create([
            'event_title' => $request->event_title,
            'welcome_text' => $request->welcome_text,
            'cover_overview'     => $cover_overview,
            'cover_header'     => $cover_header,
            'event_start_date'     => $request->event_start_date,
            'product_id' =>  $request->product_id,
            'user_id' =>  $user->id,
            'theme_id' =>  $request->theme_id,
        ]);
       
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Header created successfully.",
           
        ]);

        
    } 
    public function show($id)
    {
        $data = Header::with('product', 'theme', 'user','location', 'message', 'organizer', 'event', 'gallery')->find($id);
        if (is_null($data)) {
            return $this->sendError('Header not found.');
        }
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Header retrieved successfully."
            
        ]);
    }

    public function update(Request $request, Header $header)
    {
        $header->update($request->all());

        return response()->json([
        "success" => true,
        "message" => "header updated successfully.",
        "data" => $header
        ]);

    }
    public function destroy(Header $header)
    {
        $header->delete();
        return response()->json([
            "data" => $header,
            "success" => true,
            "message" => "Header deleted successfully.",
            
        ]);
    }
}
