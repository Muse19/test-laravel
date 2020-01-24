<?php

namespace App\Traits;

use Carbon\Carbon;

trait Helper 
{
 
  private function getReceita($data)
  {
    $result = 0;
    
    foreach($data as $i){
      $result += $i->valor - ($i->valor*($i->total_imp_inc/100));
    }
    
    return round($result, 2);
  }

  private function getCommission($data)
  {
   
    $result = 0;
    
    foreach($data as $i){
      $result += ($i->valor - ($i->valor*($i->total_imp_inc/100)))*($i->comissao_cn/100);
    }
    
    return round($result, 2);
  }

  private function getEarningsByMonth($data, $months)
  {
    
    $result = [];
    foreach($months as $month)
    {
      $value = $data->where('period', $month)->first();

      if($value){
        array_push($result, $value->earning);
      }else{
        array_push($result, 0);
      }
    }
    
    return $result;
  }

  private function getPeriod($data)
  {
    $months = [
      '01' => 'Janeiro',
      '02' => 'Fevereiro',
      '03' => 'Março',
      '04' => 'Abril',
      '05' => 'Maio',
      '06' => 'Junho',
      '07' => 'Julho',
      '08' => 'Agosto',
      '09' => 'Setembro',
      '10' => 'Outubro',
      '11' => 'Novembro',
      '12' => 'Dezembro'
    ];

    $date = Carbon::parse($data);

    return $months[$date->format('m')] .' ' . $date->format('Y');
  }
  
  private function getRelatorio($data)
  {
    $r = $this->getConsultants($data);

    return $this->calculateRelatorio($r);
  }

  private function getTotalRelatorio($data)
  {
    
    $consultants = [];
    $earnings  = [];

    foreach($data as $consultant)
    {
      array_push($consultants, $consultant->no_usuario);
      $earning = 0;
      foreach($consultant->orders as $order)
      {
        $earning += $this->getReceita($order->invoices);
         
      }
      
      array_push($earnings, $earning);
       
      $total = array_sum($earnings) === 0.0 ? 1 : array_sum($earnings);

      $percents = array_map(function($value) use ($total)
      {
        return round(($value *100)/$total,2);
      }, $earnings); 
    }

    return [$consultants, $percents];

  }

  //Calcular relatorio
  private function calculateRelatorio($consultants)
  {
    $results = [];
    foreach($consultants as $consultant)
    {
      
      $salary = $consultant->salary;
      $relatorio = $consultant->invoices->map(function($item) use ($salary){
          $earning = $this->getReceita($item);
          $commission = $this->getCommission($item);

          $data = (object)[
            'period' => $this->getPeriod($item->first()->data_emissao),
            'earning' => $earning,
            'commission' => $commission,
            'profit' =>  $earning - ($commission + $salary)
          ];

          return $data;  
      });
      
      $data = (object)[
        'consultant' => $consultant->consultant,
        'salary' => $consultant->salary,
        'relatorio' => $relatorio,
      ];

      array_push($results, $data);
    }

    return $results;
  }

  //Obtener los consultores con el salario y facturas agrupadas por mes
  private function getConsultants($data)
  {
    return $consultants = $data->map(function($item){  
      
      $invoices = $item->orders->map(function($i){
        return $i->invoices;
      })
      ->collapse()
      ->sortBy('data_emissao')
      ->groupBy(function($q){
        return Carbon::parse($q->data_emissao)->format('m-Y');
      });
    
      $data = (object)[
        'salary' => !$item->salary ? 0 : $item->salary->brut_salario,
        'consultant' => $item->no_usuario,
        'invoices' => $invoices
      ];
      return $data;
    });
  }

  private function grafica($data)
  {
    $data = $this->getRelatorio($data);

    $months = collect($data)->map(function($i){
      return $i->relatorio->map(function($i){
        return $i->period;
      });
    })
    ->collapse()
    ->values();
     
    $total_salary = collect($data)->sum('salary');

    $consultants = collect($data)->map(function($item) use ($months){
      $earnings = $this->getEarningsByMonth($item->relatorio, $months);

      $data = (object)[
        'consultant' => $item->consultant,
        'earnings' => $earnings
      ];

      return $data;
    });
    
    return [$months, $total_salary, $consultants];
  }
}