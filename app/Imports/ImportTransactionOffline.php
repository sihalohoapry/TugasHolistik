<?php

namespace App\Imports;

use App\Models\DataTransactions as Transactions;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportTransactionOffline implements ToModel,WithHeadingRow
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
            'customer'=> $row['customer'],
            'phone'=> $row['phone'],
            'brand'=> $row['brand'],
            'transaction_date'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal'])) ,
            'name_store'=> $row['nama_toko'],
            'group_product'=> $row['group_product'],
            'category_product'=> $row['category_product'],
            'product'=> $row['product'],
            'name_product'=> $row['nama_product'],
            'gender'=> $row['gender'],
            'color'=> $row['warna'],
            'size'=> $row['size'],
            'qty'=> $row['qty'],
            'price'=> $row['harga'],
            'disc'=> $row['disc'],
            'netto'=> $row['netto'],
            'tipe_trancation'=>'OFFLINE',
            // 'customer_since'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['customer_since'])),
            // 'billing'=> $row['billing'],
        ]);
    }
}
