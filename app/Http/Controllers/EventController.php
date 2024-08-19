<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json([
            'status' => true,
            'data' => [
                'data' => $events
            ]
        ], 201);
    }

    public function store(Request $request)
    {
    $user = auth()->user();

    if ($user->id_rol !== 2) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }
    $rules = [
        'name' =>'required|string',
        'date' =>'required|date|after:today',
        'address' =>'required|string',
        'start' =>'required|date_format:H:i|before:end',
        'end' =>'required|date_format:H:i|after:start',
        'quotas' =>'required|integer|min:1',
        'description' =>'required|string',
        'id_type_clothings' =>'required|integer|exists:type_clothing,id'
    ];
    $validator = Validator::make($request->input(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => False,
            'message' => $validator->errors()->all()
        ]);
    }else{

    $event = new Event();
    $event->name = $request->name;
    $event->date = $request->date;
    $event->address = $request->address;
    $event->start = $request->start;
    $event->end = $request->end;
    $event->quotas = $request->quotas;
    $event->description = $request->description;
    $event->id_type_clothings = $request->id_type_clothings;
    $event->id_users = $user->id;
    $event->save();

    return response()->json([
        'status' => true,
        'data' => [
            'message' => 'Evento registrado exitosamente'
        ]
    ], 201);
    }
}

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Evento no encontrado.'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'data' => $event
            ]
        ], 201);
    }

    public function update(Request $request, $id)
    {
    $user = auth()->user();

    if ($user->id_rol !== 2) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'date' => 'required|date|after:today',
        'address' => 'required|string',
        'start' => 'required|date_format:H:i|before:end',
        'end' => 'required|date_format:H:i|after:start',
        'quotas' => 'required|integer|min:1',
        'description' => 'required|string',
        'id_type_clothings' => 'required|integer|exists:type_clothing,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $event = Event::find($id);

    if (!$event && $event->id_users == $user->id) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }

    $event->name = $request->name;
    $event->date = $request->date;
    $event->address = $request->address;
    $event->start = $request->start;
    $event->end = $request->end;
    $event->quotas = $request->quotas;
    $event->description = $request->description;
    $event->id_type_clothings = $request->id_type_clothings;
    $event->id_users = $user->id;

    $event->save();

    return response()->json([
        'status' => true,
        'data' => [
            'message' => 'Evento actualizado exitosamente'
        ]
    ], 201);
}

public function destroy($id)
{
    $user = auth()->user();

    if ($user->id_rol !== 2) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }
    $event = Event::find($id);
    if (!$event) {
        return response()->json(['error' => 'Evento no encontrado.'], 404);
    }

    $event->delete();

    return response()->json([
        'status' => true,
        'data' => [
            'message' => 'Evento elimado exitosamente'
        ]
    ], 201);
}
}
