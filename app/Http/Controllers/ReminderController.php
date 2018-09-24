<?php

namespace App\Http\Controllers;

use App\Reminder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    /**
     *
     */
    public function fillTable(){

        $remainderMonths = 12 - date('n');
        $reminders = [];
        $toDay = Carbon::today();

        foreach (range(1, $remainderMonths) as $month) {
            $baseDay = $toDay->copy()->addMonths($month)->day(30);
            if ($baseDay->isweekend())
                $baseDay = $baseDay->copy()->previous(Carbon::THURSDAY);

            $bonusDay = $toDay->copy()->addMonths($month)->day(15);

            if ($bonusDay->isweekend())
                $bonusDay = $bonusDay->copy()->next(Carbon::THURSDAY);

            $reminders[] = [
                'day' => $baseDay->copy()->subDays(2)->toDateString(),
                'type' => 'base',
            ];

            $reminders[] = [
                'day' => $bonusDay->copy()->subDays(2)->toDateString(),
                'type' => 'bonus',
            ];
        }
        DB::table('reminders')->truncate();
        Reminder::insert($reminders);
    }

    /**
     *
     */
    public  function sendMails(){
        if ($reminder = Reminder::where('day', Carbon::today()->addDays(2))->first()) {
            $employees = DB::table('employees')
                ->select(DB::raw('SUM(salary) salaries_total, SUM(salary * bonus_by_ratio / 100) bonus_total'))
                ->first();

            $mails = User::all()->pluck('email');
            $toPay = $reminder->type == 'base' ? $employees->salaries_total : $employees->bonus_total;

            mail(implode($mails), "Salaries reminder [{$reminder->type}]", "Payments total: {$toPay}");
//            Notification::send($mails, Notification::toMail());

        }
    }

}
