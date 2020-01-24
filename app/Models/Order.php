<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'cao_os';
    protected $primaryKey = 'co_os';

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'co_os');
    }

}
