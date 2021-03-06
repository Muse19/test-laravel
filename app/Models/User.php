<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Salary;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'cao_usuario';
    protected $primaryKey = 'co_usuario';
    protected $keyType = 'string';

    public function salary()
    {
        return $this->hasOne(Salary::class, 'co_usuario');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'co_usuario');
    }

    public function permission()
    {
        return $this->hasMany(Permission::class, 'co_usuario');
    }

    public function scopeConsultantWithOrders($q, $data){
        
        $from = $data->y1 .'-'. $data->m1 .'-01';
        $to = $data->y2 .'-'. $data->m2 .'-31';

        return $q->whereIn('co_usuario', $data->users)
            ->with(['salary','orders.invoices' => function($q) use ($data, $from, $to){
                $q->whereBetween('data_emissao',[$from, $to]);         
            }]);
            
        
    }


}
