<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use PHPUnit\Util\Xml\Validator as XmlValidator;
use Validator;
class EventController extends Controller
{
    public function index()
    {
        $data = Event::all();
        return response()->json([
            "data" => $data,
            "success" => true,
            "message" => "Event List",
            
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'groom' => 'required',
            'bride' => 'required',
            'contract_date' => 'required',
            'place_of_contract' => 'required',
            'reception_date' => 'required',
            'place_reception' => 'required',
            'header_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $event = Event::create($input);
        return response()->json([
            "data" => $event,
            "success" => true,
            "message" => "Event  created successfully.",
           
        ]);
    } 

    public function show($id)
    {
        $event = Event::find($id);
        if (is_null($event)) {
            return $this->sendError('Event not found.');
        }
        return response()->json([
            "data" => $event,
            "success" => true,
            "message" => "Event retrieved successfully."
            
        ]);
    }

    public function update(Request $request, Event $event )
    {
        // $data = new Product($request)->save()
        $event->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Event updated successfully.",
            "data" => $event
        ]);
        // return response(['project' => new Product($product), 'Event' => 'Update successfully'], 200);
    
        
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json([
            "data" => $event,
            "success" => true,
            "message" => "Event Event deleted successfully.",
            
        ]);
    }
}
