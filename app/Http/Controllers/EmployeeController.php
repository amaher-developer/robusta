<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return response(
            Employee::with('department')->get(),
            200
        );
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateBonus()
    {
        if(!request('id') || !request('bonus_by_ratio')) {
            return response(['error' => 'Please enter the employee id and bouns by ratio correctly.'], 422);
        }
        Employee::where('id',request('id'))
            ->update(['bonus_by_ratio' => request('bonus_by_ratio')]);

        return response(
            ['message' => 'The bonus updated successfully.'],
            200
        );

    }

}
