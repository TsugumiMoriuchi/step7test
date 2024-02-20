@extends('layouts.app')
@section('title', '商品一覧画面')
@section('content')
<div class="container">
    <h1 class="mb-4">商品情報一覧</h1>
</div>

<div class="row">
<div class="col-md-4">
<form action="{{ route('list') }}" method="GET" class="form-inline">
    @csrf
    <div class="form-group mr-2">
    <input type="text" name="keyword" class="form-control" placeholder="検索キーワード">
    </div>

    <div class="form-group mr-2">
    <select name="search-company" class="form-control">
       <option value="">メーカー名</option>
       @foreach ($companies as $company) 
       <option value="{{$company->id}}">{{ $company->company_name }}</option>
       @endforeach
    </select> 
    </div>
    
    <div class="form-group">
    <input type="submit" value="検索" class="btn btn-primary">
    </div>


</form>
</div>
    <div class="col-md-6">
    <a href="{{ route('create') }} "class="btn btn-primary">新規登録</a>
    </div>

</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー名</th> 
        
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
    <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company_name }}</td>
            <td><a href ="{{ route('detail', ['id' => $product->id]) }}" class="btn btn-primary">詳細</a></td>
            
            <td>
            <form action="{{ route('destroy', ['id'=>$product->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
            </td>

    </tr>
    @endforeach
    </tbody>
</table>
@endsection