<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
class UsersExport implements FromView,WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */


    public function forYear(int $year)
    {
        $this->year = $year;

        return $this;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    public function forStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }


    public function query()
    {
        return User::query()
            ->whereYear('created_at', $this->year)
            ->where('status', $this->status);
    }


    public function view(): View
    {
        return view('exports.users', [
            'users' => User::all()
        ]);
    }
}
