<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class SalesController extends Controller
{
    public function index(Request $request)
{
    try{
    // リクエストから必要なデータを取得する
    $productId = $request->input('product_id'); // "product_id":7が送られた場合は7が代入される
    $quantity = $request->input('quantity', 1); // 購入する数を代入する もしも”quantity”というデータが送られていない場合は1を代入する

    // データベースから対象の商品を検索・取得
    $product = Product::find($productId); // "product_id":7 送られてきた場合 Product::find(7)の情報が代入される

    // 商品が存在しない、または在庫が不足している場合のバリデーションを行う
    if (!$product) {
        return response()->json(['message' => '商品が存在しません'], 404);
    }
    if ($product->stock < $quantity) {
        return response()->json(['message' => '商品が在庫不足です'], 400);
    }

    // 在庫を減少させる
    $product->stock -= $quantity; // $quantityは購入数を指し、デフォルトで1が指定されている
    $product->save();


    // Salesテーブルに商品IDと購入日時を記録する
    $sale = new Sale([
        'product_id' => $productId,
        // 主キーであるIDと、created_at , updated_atは自動入力されるため不要
    ]);

    $sale->save();
    DB::commit();

    // レスポンスを返す
    return response()->json(['message' => '購入成功']);
}catch(\Exception $e){
    DB::rollback();
    return response()->json(['message' => 'エラー'],500);

}
}

    // public function index()
    // {
    //    try {
    //         $version = Sales::first();
    //         $result = [
    //             'result'      => true,
    //             'product_id'  => $product_id->product_id
    //         ];
    //     } catch(\Exception $e){
    //         $result = [
    //             'result' => false,
    //             'error' => [
    //                 'messages' => [$e->getMessage()]
    //             ],
    //         ];
    //         return $this->resConversionJson($result, $e->getCode());
    //     }
    //     return $this->resConversionJson($result);
    // }

    // private function resConversionJson($result, $statusCode=200)
    // {
    //     if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
    //         $statusCode = 500;
    //     }
    //     return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    // }
}
