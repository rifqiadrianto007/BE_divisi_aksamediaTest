<?php

namespace App\Http\Controllers\Api;

use App\Models\Division;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{

    public function index(Request $request)
    {

        $query = Division::query();

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $divisions = $query->paginate(10);

        return ApiResponse::success(
            'Data divisions berhasil diambil',
            [
                'divisions' => $divisions->items()
            ],
            [
                'current_page' => $divisions->currentPage(),
                'last_page' => $divisions->lastPage(),
                'per_page' => $divisions->perPage(),
                'total' => $divisions->total()
            ]
        );

    }

}
