<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Location;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;

class LocationController extends Controller
{
    public function index()
    {
        $location =Location::all();
        return response()->json(['data' => $location]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location_image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_name'     => 'required',
            'event_date'   => 'required',
            'location_name'     => 'required',
            'location_address'   => 'required',
            'latitude'     => 'required',
            'longitude'   => 'required',
            'header_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

         //upload image
        $image = $request->file('location_image');
        $hash = $image->hashName();
        $image->move(public_path('location_image'), $hash);
        //create post
        $data = Location::create([
            'event_name'     => $request->event_name,
            'event_date'     => $request->event_date,
            'location_name'   => $request->location_name,
            'location_address'     => $request->location_address,
            'location_image'     => $hash,
            'latitude'   => $request->latitude,
            'longitude'   => $request->longitude,
            'header_id'   => $request->header_id,
        ]);

       
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Location created successfully.",
           
        ]);
    }

    public function show($id)
    {
        $location =Location::find($id);
        if (!$location) {
            return response()->json(['message' => 'Location map not found'], 404);
        }
        return response()->json(['data' => $location]);
    }

    public function update(Request $request, $id)
    {
        $location =Location::find($id);
        if (!$location) {
            return response()->json(['message' => 'Location map not found'], 404);
        }
        $location->update($request->all());
        return response()->json(['data' => $location]);
    }

    public function destroy($id)
    {
        $location = Location::find($id);
        if (!$location) {
            return response()->json(['message' => 'Location map not found'], 404);
        }
        $location->delete();
        return response()->json([ 
            "data" => $location,
            "success" => true,
            "message" => "Location deleted successfully.",]);
    }
}
