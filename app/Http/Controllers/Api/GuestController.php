<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Guest;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;

class GuestController extends Controller
{
    
    public function index()
    {
        $data = Guest::all();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Guest List",
            
        ]);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'status' => 'required',
            'total' => 'required',
            'reason' => 'required',
            'label' => 'required',
            'user_id' => 'required'

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $data = Guest::create($input);
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Guest created successfully.",
           
        ]);
    } 
    public function show($id)
    {
        $data = Guest::find($id);
        if (is_null($data)) {
            return $this->sendError('Guest not found.');
        }
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Guest retrieved successfully."
            
        ]);
    }

    public function update(Request $request, Guest $guest)
    {
        $guest->update($request->all());

        return response()->json([
        "success" => true,
        "message" => "Guest updated successfully.",
        "data" => $guest
        ]);

    }
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json([
            "data" => $guest,
            "success" => true,
            "message" => "Guest deleted successfully.",
            
        ]);
    }
}
