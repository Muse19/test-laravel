<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\Helper;
use Illuminate\Http\Request;

class ReportController extends Controller
{ 
    use Helper;

    public function relatorio(Request $request)
    {
        
        $data = User::ordersByConsultant($request)->get();
       
        $items = $this->getRelatorio($data);                     
       
       return view('relatorio', compact('items'));
    }

    public function pizza(Request $request)
    {
        $data = User::ordersByConsultant($request)->get();

        $result = $this->getTotalRelatorio($data);

        return view('pizza', compact('result'));
    }
}
