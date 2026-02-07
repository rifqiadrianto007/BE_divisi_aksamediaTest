<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Division;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        try {

            $query = Employee::with('division');

            // filter name
            if ($request->has('name') && $request->name != null) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            // filter division
            if ($request->has('division_id') && $request->division_id != null) {
                $query->where('division_id', $request->division_id);
            }

            $employees = $query->paginate(10);

            $data = $employees->map(function ($employee) {

                return [
                    'id' => $employee->id,
                    'image' => $employee->image,
                    'name' => $employee->name,
                    'phone' => $employee->phone,
                    'division' => [
                        'id' => $employee->division->id,
                        'name' => $employee->division->name
                    ],
                    'position' => $employee->position
                ];

            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data employees berhasil diambil',
                'data' => [
                    'employees' => $data
                ],
                'pagination' => [
                    'current_page' => $employees->currentPage(),
                    'last_page' => $employees->lastPage(),
                    'per_page' => $employees->perPage(),
                    'total' => $employees->total()
                ]
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function store(Request $request)
    {

        try {

            // validation
            $request->validate([
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'division' => 'required|exists:divisions,id',
                'position' => 'required|string|max:255'
            ]);

            $imagePath = null;

            // upload image jika ada
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

                $imagePath = $file->storeAs(
                    'employees',
                    $filename,
                    'public'
                );

            }

            // create employee
            Employee::create([
                'image' => $imagePath,
                'name' => $request->name,
                'phone' => $request->phone,
                'division_id' => $request->division,
                'position' => $request->position
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee berhasil dibuat'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);

        }

    }

}
