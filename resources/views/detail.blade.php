@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<h1 class="mb-4">商品情報詳細画面</h1>

    
<table>
    <tr>
        <td>ID</td>
        <td>{{ $product->id }}</td>
    </tr>
    <tr>
        <td>商品画像</td>
        <td><img src="{{ asset($product->img_path) }}"</td>
    </tr>
    <tr>
        <td>商品名</td>
        <td>{{ $product->product_name }}</td>
    </tr>
    <tr>
        <td>メーカー</td>
        <td>{{ $product->company_name }}</td>
    </tr>
    <tr>
        <td>価格</td>
        <td>{{ $product->price }}</td>
    </tr>
    <tr>
        <td>在庫数</td>
        <td>{{ $product->stock }}</td>
    </tr>
    <tr>
        <td>コメント</td>
        <td>{{ $product->comment }}</td>
    </tr>
    <tr>
        <td><a href ="{{ route('edit', $product->id) }}" class="btn btn-primary">編集</a></td>
    </tr>
    <tr>
        <td><a href ="{{ route('list') }}" class="btn btn-primary">戻る</a></td>
    </tr>    
</table>
</div>
</div>
@endsection
