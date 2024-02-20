<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    //一覧画面表示
    public function showList(Request $request){
        $model = new product();
        $allproducts = $model -> getList();
        $model = new company();
    
        $keyword = $request->input('keyword');
        $searchcompany = $request->input('search-company');
        $query = Product::query();
        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%")
                ->orWhere('detail', 'LIKE', "%{$keyword}%")
                ->get();
        }
        $products = $model->searchList($keyword, $searchcompany);
        $companies = $model ->getCompanyById();
        //return view('list',compact('products', 'companies')) ;
        return view('list',['products' => $products , 'companies' => $companies]);
    }  
    //詳細画面表示
    public function showDetail($id){
        $model = new product();
        $product = $model->getProductById($id);
        return view('detail',compact('product') );
    }  
    //新規登録画面表示
    public function showRegistForm(Request $request){
        $companies = DB::table('companies')->get();
        return view('create',compact('companies'));
    }  
    //新規登録処理
    public function createSubmit(ProductRequest $request){
        DB::beginTransaction();
        try{
            $model = new product();
            $companies = DB::table('companies')->get();
            $products = $model->createSubmit($request);
            DB::commit();
            return redirect(route('list'));
        }catch (\Exception $e){
            DB::rollback();
            return back();

        }
        return redirect(route('list'));
 
    } 
    //編集画面表示
    public function showEdit($id){
        $model = new products();
        $products = $model->getedit($id);
        $companies = DB::table('companies')->get();

        return view('edit',['products' => $products , 'companies => $companies']);

    }

    //更新処理 編集
    public function createEdit(ProductRequest $request){
        
        DB::beginTransaction();
        try{
            $model = new product();
            $model->editProduct($request);

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back();
        }
        return redirect(route('detail'));

    }
    //削除処理
    public function destroy($id){
        DB::beginTransaction();
        try{
            $model = new product();
            $model->destroyproduct($id);

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            return back();
        }

        return redirect()->route('list');
    }
   
}