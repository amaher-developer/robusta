<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return response(
            Department::get(),
            200
        );
    }

    public function show($id)
    {
        $department = Department::find($id);
        if($department){
            return response(
                $department,
                200
            );
        }
        return response(
            ['error' => 'Department not found.'],
            404
        );

    }
}
