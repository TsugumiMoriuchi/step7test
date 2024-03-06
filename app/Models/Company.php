<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Company extends Model
{
    use HasFactory;
    public function products(){

        return $this->hasMany(Product::class);
    }

    //検索
    public function list() {
        
        $companies = DB::table('companies')->get();
      
        return $companies;
    }
    

}
