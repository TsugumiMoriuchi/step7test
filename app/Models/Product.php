<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Product extends Model
{
    use HasFactory;

    //一覧画面表示
    public function getList(){
        $products = DB::table('products')
            ->join('companies','company_id', '=', 'companies.id')
            ->select('products.*','companies.company_name')
            ->get();

        return $products;

    }
    //検索
    public function searchList($keyword, $searchcompany){
        $query = DB::table('products')
         ->join('companies', 'products.company_id', '=', 'company_name')
         ->select('products.*','companies.company_name');

         if($keyword) {
             $query->where('product_name', 'like', '%'. $keyword. '%');
         }

         $products = $query->get();
         return $products;
    }

    //詳細画面表示
    public function getProductById($id){
        $products = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('product.*', 'companies.company_name')
            ->where('products.id', '=', $id)
            ->first();

        return $products;
    }
    //新規登録処理
    public function createSubmit($request){
        DB::table('products')->insert([
            'product_name' => $request->input('product_name'),
            'company_id' => $request->input('company_id'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            'img_path' => $img_path,

        ]);
    }
    //編集画面表示
    public function getedit($id){
        $products = DB::table('products')->get();

        return $products;
    }
    //更新処理 編集

    public function editProduct($request){
            DB::table('products')->update([
                'product_name' => $request->product_name,
                'company_id' => $request->company_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'comment' => $request->comment,
                'img_path' =>$request->img_path,
            ]);

    }
        
    //削除処理
    public function destroyproduct($id){
        $products = DB::table('products')->where('products.id','=' ,$id)->delete();
    }
    
    

}