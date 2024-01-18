<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataTransactions extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'customer',
        'email',
        'phone',
        'customer_since',
        'brand',
        'group_product',
        'category_product',
        'product',
        'name_product',
        'gender',
        'color',
        'size',
        'qty',
        'transaction_date',
        'billing',
        'price',
        'name_store',
        'disc',
        'netto',
        'tipe_trancation'


    ];
}
