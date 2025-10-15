<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index()
    {
        $companies = Company::all();
        return response()->json([
            'success' => true,
            'message' => 'Companies retrieved',
            'data' => $companies,
        ], 200);
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:companies,email',
            'phone' => 'nullable|string|max:20',
        ]);

        $company = Company::create($validated);

        $user = Auth::user();
        if ($user) {
            $user->companies()->attach($company->id, ['role' => 'admin']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Company created',
            'data' => $company,
        ], 201);
    }

    public function show($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Company retrieved',
            'data' => $company,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:companies,email,' . $company->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $company->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Company updated',
            'data' => $company,
        ], 200);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }
        $company->delete();

        return response()->json([
            'success' => true,
            'message' => 'Company deleted',
            'data' => null
        ], 200);
    }
}
