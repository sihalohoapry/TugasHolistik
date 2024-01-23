<?php

namespace App\Imports;

use App\Models\DataTransactions as Transactions;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportTransaction implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!array_filter($row)) {
            return null;
        } 
        return new Transactions([
            'customer'=> $row['name'],
            'email'=> $row['email'],
            'phone'=> $row['phone'],
            'customer_since'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['customer_since'])),
            'brand'=> $row['brand'],
            'group_product'=> $row['group_product'],
            'category_product'=> $row['category_product'],
            'product'=> $row['product'],
            'name_product'=> $row['nama_product'],
            'gender'=> $row['gender'],
            'color'=> $row['warna'],
            'size'=> $row['size'],
            'qty'=> $row['qty'],
            'transaction_date'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['transaction_date'])) ,
            'billing'=> $row['billing'],
            'price'=> $row['harga'],
            'domisili'=>$row['domisili'],
            'tipe_trancation'=>'ONLINE',
            'netto'=> $row['harga'],
        ]);
    }
}
