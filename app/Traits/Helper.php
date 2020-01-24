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
    
    return $result;
  }

  private function getCommission($data)
  {
   
    $result = 0;
    
    foreach($data as $i){
      $result += ($i->valor - ($i->valor*($i->total_imp_inc/100)))*($i->comissao_cn/100);
    }
    
    return $result;
  }

  
  
  
  private function getRelatorio($data)
  {
    $r = $this->getConsultants($data);

    return $this->calculateRelatorio($r);
  }

  private function getTotalRelatorio($data)
  {
    
     function getPercent($value, $total){
     
    }
    
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
       
      $total = array_sum($earnings);

      $percents = array_map(function($value) use ($total)
      {
        return ($value *100)/$total;
      }, $earnings); 
    }

    return [$consultants, $percents];

  }

  private function calculateRelatorio($consultants)
  {
    $results = [];
    foreach($consultants as $consultant)
    {
      
      $salary = $consultant->salary;
      $relatorio = $consultant->invoices->map(function($item) use ($salary){
    
          $data['earning'] = $this->getReceita($item);
          $data['commission'] = $this->getCommission($item);
          $data['profit'] = $data['earning'] - ($data['commission']+$salary);
          return $data;  
      });

      $data = (object)[
        'consultant' => $consultant->consultant,
        'salary' => $consultant->salary,
        'relatorio' => $relatorio
      ];

      array_push($results, $data);
    }

    return $results;
  }

  private function getConsultants($data)
  {
    return $consultants = $data->map(function($item){  
      //$data['salary'] = $item->salary->brut_salario;
      //$data['consultant'] = $item->no_usuario;
      $invoices = $item->orders->map(function($i){
        return $i->invoices;
      })
      ->collapse()
      ->sortBy('data_emissao')
      ->groupBy(function($q){
        return Carbon::parse($q->data_emissao)->format('m-Y');
      });

      //$data['invoices'] = $invoices;
      $data = (object)[
        'salary' => $item->salary->brut_salario,
        'consultant' => $item->no_usuario,
        'invoices' => $invoices
      ];
      return $data;
    });
  }
}