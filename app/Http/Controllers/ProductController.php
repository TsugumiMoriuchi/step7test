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
    public function list(){
        $productModel = new Product();
        $products = $productModel->list();
    
        $companyModel = new Company();
        $companies = $companyModel->list();

        return view('list',['products' => $products , 'companies' => $companies]);
    }  
    //検索
    public function search(Request $request){
         $keyword = $request->input('keyword');
         $searchcompany = $request->input('search-company');
         $min_price = $request->input('min_price');
         $max_price = $request->input('max_price');
         $min_stock = $request->input('min_stock');
         $max_stock = $request->input('max_stock');
         

         $productModel = new Product();
         $companyModel = new Company();
         $products = $productModel->search($keyword, $searchcompany, $min_price, $max_price, $min_stock, $max_stock);
         $companies = $companyModel ->list();
    
        // $products = Product::all();
        return view('list', [
            'products' => $products,
            'companies' => $companies,
            'keyword' => $keyword,
            'searchcompany' => $searchcompany,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'min_stock' => $min_stock,
            'max_stock' => $max_stock,
        ]);
    }
    //詳細画面表示
    public function detail($id){
        $model = new Product();
        $product = $model->getProductById($id);
        return view('detail',['product' => $product]);
    }  
    //新規登録画面表示
    public function showRegistForm(Request $request){
        $companies = DB::table('companies')->get();
        return view('create',compact('companies'));
    }  
    //新規登録処理
    public function createSubmit(ProductRequest $request){
        $model = new Product();
        DB::beginTransaction();
       
        try{
            $image = $request->file('img_path');
            if($image){
                $file = $image->getClientOriginalName();
                $image->storeAs('public/image', $file);
                $img_path = 'storage/image/'.$file;
                
            }else{
                $img_path = null;
            }
            $companies = DB::table('companies')->get();
            $product = $model->createSubmit($request, $img_path);
            DB::commit();
            return redirect(route('list'))->with('success', '商品が正常に登録されました。')->with('companies', $companies);
            


        } catch (\Exception $e) {
            DB::rollback();
        }
        
    } 
    //編集画面表示
    public function showEdit($id){
        $model = new Product();
        $product = $model->getedit($id);
        $companyModel = new Company();
        $companies = $companyModel -> list();

        return view('edit',['product' => $product , 'companies' => $companies]);

    }

    //更新処理 編集
    public function createEdit(ProductRequest $request, $id){
        $model = new Product();
        DB::beginTransaction();
        
        try{
            $image = $request->file('img_path');
            if($image){
                $file = $image->getClientOriginalName();
                $image->storeAs('public/image', $file);
                $img_path = 'storage/image/'.$file;
                $model->editProduct($id, $request, $img_path);
            
            }else{
                $model->editProductno($id, $request);
            }
       

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back();
        }
        return redirect()->route('detail', ['id' => $id ]);

    }
    //削除処理
    //   public function destroy($id){
    //      DB::beginTransaction();
    //      try{
    //          $model = new Product();
    //          $model->destroyproduct($id);

    //          DB::commit();

    //      }catch(\Exception $e){
    //          DB::rollback();
    //          return back();
    //      }

    //      return redirect()->route('list');
    //  }

     public function destroy($id) {
        try {
            DB::beginTransaction();
            
            // Product モデルのインスタンスを作成して destroyproduct メソッドを呼び出す
            $product = new Product();
            $product->destroyproduct($id);
    
            DB::commit();
    
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => '削除に失敗しました'], 500);
        }
    }

     

    
   
}