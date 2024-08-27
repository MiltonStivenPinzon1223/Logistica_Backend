<?php

namespace App\Http\Controllers;

use App\Models\TypeCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeCertificateController extends Controller
{
    public function index()
    {
        $TypeCertificates =TypeCertificate::all();
        return response()->json([
            'status' => true,
            'data' => [
                'data' => $TypeCertificates
            ]
        ], 201);
    }

    public function store(Request $request)
    {
    $user = auth()->user();

    if ($user->id_rol !==3) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }
    $rules = [
        'name' =>'required|string|unique:type_certificates',
    ];
    $validator = Validator::make($request->input(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => False,
            'message' => $validator->errors()->all()
        ]);
    }else{

    $TypeCertificate = new TypeCertificate();
    $TypeCertificate->name = $request->name;
    $TypeCertificate->save();

    return response()->json([
        'status' => true,
        'data' => [
            'message' => 'tipo de certificado registrado exitosamente'
        ]
    ], 201);
    }
}

    public function show($id)
    {
        $TypeCertificate =TypeCertificate::find($id);

        if (!$TypeCertificate) {
            return response()->json(['error' => 'tipo de certificado no encontrado.'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'data' => $TypeCertificate
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
    $TypeCertificate =TypeCertificate::find($id);

    if (!$TypeCertificate && $TypeCertificate->id_users == $user->id) {
        return response()->json(['error' => 'Accion denegada.'], 403);
    }

    $TypeCertificate->name = $request->name;
    $TypeCertificate->save();

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
