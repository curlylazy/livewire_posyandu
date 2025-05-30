<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PemeriksaanExport implements FromView
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $users = User::whereBetween('created_at', [$this->startDate, $this->endDate])->get();

        return view('exports.users', [
            'users' => $users,
            'start' => $this->startDate,
            'end' => $this->endDate,
        ]);
    }
}

