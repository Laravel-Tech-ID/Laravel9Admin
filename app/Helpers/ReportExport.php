<?php
namespace App\Helpers;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{

    protected $view;
    protected $data;

    public function __construct($view, $data){
        $this->view = $view;
        $this->data = $data;
    }

    public function view(): View
    {
        return view($this->view,
            $this->data
        );
    }
}