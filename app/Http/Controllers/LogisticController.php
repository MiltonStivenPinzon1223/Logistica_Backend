<?php

namespace App\Http\Controllers;

use App\Models\Logistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogisticController extends Controller
{
    public function index()
    {
        $logistics = Logistic::all();
        return response()->json([
            'status' => true,
            'data' => [
                'data' => $logistics
            ]
        ], 201);
    }

    public function store(Request $request)
    {
        $rules = [
            'celular' =>'required|string|unique:logistics',
            'description' =>'required|string',
            'id_users' =>'required|integer|exists:users|unique:logistics',
        ];
        $validator = Validator::make($request->input(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'message' => $validator->errors()->all()
            ]);
        }else{
    
        $logistic = new Logistic();
        $logistic->celular = $request->celular;
        $logistic->description = $request->description;
        $logistic->id_users = $request->id_users;
        $logistic->save();
    
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'logistico registrado exitosamente'
            ]
        ], 201);
        }
    }

    public function show($id)
    {
        $logistic = Logistic::find($id);

        if (!$logistic) {
            return response()->json(['error' => 'logistico no encontrado.'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'data' => $logistic
            ]
        ], 201);
    }


    public function update(Request $request, $id)
    {
    $user = auth()->user();

    if ($user->id_rol !==3) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
    ]);
    $validate = Controller::validate_exists($request->name, 'type_certificates', 'name', 'id', $id);

    if ($validator->fails() || $validate == 0) {
        $msg = ($validate == 0) ? "value tried to register, it is already registered." : $validator->errors()->all();
        return response()->json([
            'status' => False,
            'message' => $msg
        ]);
    }else{
    $logistic =Logistic::find($id);

    if (!$logistic && $logistic->id_users == $user->id) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }

    $logistic->name = $request->name;
    $logistic->save();

    return response()->json([
        'status' => true,
        'data' => [
            'message' => 'tipo de certificado actualizado exitosamente'
        ]
    ], 201);
}
}

    public function destroy($id)
    {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Funcion no disponible'
            ]
        ], 201);
    }
}
