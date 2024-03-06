<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Storage;



class Product extends Model
{
    use HasFactory;
     // Productモデルがsalesテーブルとリレーション関係を結ぶためのメソッド
     public function sales(){
         return $this->hasMany(Sale::class);
     }
 
     // Productモデルがcompanysテーブルとリレーション関係を結ぶ為のメソッド
     public function company(){
         return $this->belongsTo(Company::class);
     }


    //一覧画面表示
    public function list(){
        $products = DB::table('products')
            ->join('companies','products.company_id', '=', 'companies.id')
            ->select('products.*','companies.company_name')
            ->paginate(5);

        return $products;

    }
    //検索
    public function search($keyword, $searchcompany){
         $query = DB::table('products')
          ->join('companies', 'products.company_id', '=', 'companies.id')
          ->select('products.*','companies.company_name');

          if($keyword) {
              $query->where('product_name', 'like', '%'. $keyword. '%');
          }
          if($searchcompany) {
              $query->where('products.company_id', '=', $searchcompany);
          }

          $products = $query->get();
          
          return $products;
    }

    //詳細画面表示
    public function getProductById($id){
        $products = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id', '=', $id)
            ->first();

        return $products;
    }
    //新規登録処理
    public function createSubmit($request, $img_path){
        //$product = new Product();
        //$product->product_name = $request->input('product_name');
        //$product->company_id = $request->input('company_id');
        //$product->price = $request->input('price');
        //$product->stock = $request->input('stock');
        //$product->comment = $request->input('comment');
        //$product->img_path = $img_path;
        //$product->save();
        DB::table('products')->insert([
            'product_name' => $request->input('product_name'),
            'company_id' => $request->input('company_id'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            'img_path' => $img_path
        ]);
        
    }
    //編集画面表示
    public function getedit($id){
        $products = Product::find($id);

        return $products;
    }
    //更新処理 編集

    public function editProduct($id, ProductRequest $request, $img_path){
        DB::table('products')
        ->where('id', '=', $id)
        ->update([
            'product_name' => $request->input('product_name'),
            'company_id' => $request->input('company_id'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            'img_path' => $img_path
        ]);
    }

    public function editProductno($id, ProductRequest $request){
        DB::table('products')
        ->where('id', '=', $id)
        ->update([
            'product_name' => $request->input('product_name'),
            'company_id' => $request->input('company_id'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
        ]);
    
    }
        
    //削除処理
    public function destroyproduct($id){

        $products = DB::table('products')->where('products.id','=',$id)->delete();
    }
    
    

}