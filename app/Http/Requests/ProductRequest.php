<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    //更新
    public function authorize(){
        return true;
    }
    
    public function rules(){
        return [
            'product_id' => 'required|string|max:255',
            'company_id' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string|max:10000',
            'img_path' => 'nullable|image',
        ];
    }
    public function attributes(){
        return [
    'product_id' => '商品名',
    'company_id' => 'メーカー名',
    'price' => '価格',
    'stock' => '在庫数',
    'comment' => 'コメント',
    'img_path' => '商品画像',
        ];
    }
    public function messages() {
        return [
            'product_id.required' => ':attributeは必須項目です。',
            'company_id.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'stock.required' => ':attributeは必須項目です。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
            'img_path' => ':attributeは:画像を選択してください。',
        ];
    }
}