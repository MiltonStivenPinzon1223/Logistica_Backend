<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return response()->json([
            'status' => true,
            'data' => [
                'data' => $certificates
            ]
        ], 201);
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Certificate $certificate)
    {
        //
    }

    public function update(Request $request, Certificate $certificate)
    {
        //
    }

    public function destroy(Certificate $certificate)
    {
        //
    }
}
