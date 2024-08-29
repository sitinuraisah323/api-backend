<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;

class MessageController extends Controller
{
   public function index()
    {
        $data = Message::all();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Event Message List",
            
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'opening' => 'required',
            'invitation' => 'required',
            'closing' => 'required',
            'other' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $message = Message::create($input);
        return response()->json([
            "data" => $message,
            "success" => true,
            "message" => "Event Message created successfully.",
           
        ]);
    } 

    public function show($id)
    {
        $message = Message::find($id);
        if (is_null($message)) {
            return $this->sendError('Message Message not found.');
        }
        return response()->json([
            "data" => $message,
            "success" => true,
            "message" => "Message retrieved successfully."
            
        ]);
    }

    public function update(Request $request, Message $message )
    {
        // $data = new Product($request)->save()
        $message->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Event Message updated successfully.",
            "data" => $message
        ]);
        // return response(['project' => new Product($product), 'message' => 'Update successfully'], 200);
    
        
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json([
            "data" => $message,
            "success" => true,
            "message" => "Event Message deleted successfully.",
            
        ]);
    }
}
