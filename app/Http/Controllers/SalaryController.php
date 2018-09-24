<?php

namespace App\Http\Controllers;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index()
    {

        $employees = DB::table('employees')
            ->select(DB::raw('SUM(salary) salaries_total, SUM(salary * bonus_by_ratio / 100) bonus_total'))
            ->first();
        $remainderMonths = 12 - date('n');
        $report = [];
        $toDay = Carbon::today();

        foreach (range(1, $remainderMonths) as $month) {
            $baseDay = $toDay->copy()->addMonths($month)->day(30);
            if($baseDay->isweekend())
                $baseDay = $baseDay->copy()->previous(Carbon::THURSDAY);

            $bonusDay = $toDay->copy()->addMonths($month)->day(15);

            if($bonusDay->isweekend())
                $bonusDay = $bonusDay->copy()->next(Carbon::THURSDAY);


            $report[] = [
                'Month' => $baseDay->format('M'),
                'Salaries_payment_day' => $baseDay->day,
                'Bonus_payment_day' => $bonusDay->day,
                'Salaries_total' => $employees->salaries_total,
                'Bonus_total' => $employees->bonus_total,
                'Payments_total' => $employees->salaries_total + $employees->bonus_total,
            ];

        }

        return $report;

    }
}
