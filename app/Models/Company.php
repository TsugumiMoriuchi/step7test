<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Company extends Model
{
    use HasFactory;

    //一覧画面表示
    public function getCompanyById() {
        
        $companies = DB::table('companies')->get();
      
        return $companies;
    }
    //検索
    public function searchList($keyword, $searchcompany){
        $query = DB::table('products')
         ->join('companies', 'products.company_id', '=', 'company_name')
         ->select('products.*','companies.company_name');

         if($searchcompany) {
            $query->where('products.company_id', '=', $searchcompany);
        }

        $companies = $query->get();
        return $companies;

    }
    

}
