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
        if(!$this->validatePeriod($request->except('users')))
        {
            return response()->json(['error' => 'Ingrese un período válido.'], 422);
        }

        if(!$request->filled('users')){
            return response()->json(['error' => 'Ingrese consultores.'], 422);
        }

        $data = User::consultantWithOrders($request)->get();
        
        $items = $this->getRelatorio($data);                     
       
       return view('relatorio', compact('items'));
    }

    public function pizza(Request $request)
    {
        if(!$this->validatePeriod($request->except('users')))
        {
            return response()->json(['error' => 'Ingrese un período válido.'], 403);
        }

        if(!$request->filled('users')){
            return response()->json(['error' => 'Ingrese consultores.'], 422);
        }
        
        $data = User::consultantWithOrders($request)->get();

        $result = $this->getTotalRelatorio($data);

        return view('pizza', compact('result'));
    }

    public function grafico(Request $request)
    {
        if(!$this->validatePeriod($request->except('users')))
        {
            return response()->json(['error' => 'Ingrese un período válido.'], 403);
        }

        if(!$request->filled('users')){
            return response()->json(['error' => 'Ingrese consultores.'], 422);
        }
        
        $data = User::consultantWithOrders($request)->get();

        $result = $this->grafica($data);

        return view('grafico', compact('result'));
    }
}
