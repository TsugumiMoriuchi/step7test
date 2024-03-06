@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">
<h1 class="mb-4">商品情報編集画面</h1>

<form method="POST"
    action="{{ route('editSubmit', $product->id) }}"  enctype="multipart/form-data">

    @csrf
<div>
    <tr>
        <td>ID</td>
        <td>{{ $product->id }}</td>
    </tr>
    
</div>

<div class="mb-3>
    <label for="product_name">商品名</label>
    <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" required>
    @if($errors->has('product_name'))
       <p>{{ $errors->first('product_name') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="company_id">メーカー名</label>
    <select name="company_id" class="form-control" id="" value="{{ $product->company_name }}" required>
        @foreach($companies as $company)
            <option value="{{$company->id}}">{{ $company->company_name}}</option>
        @endforeach
    </select>
    @if($errors->has('company_id'))
       <p>{{ $errors->first('company_id') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="price">価格</label>
    <input type="text" class="form-control" name="price" value="{{$product->price}}" required>
    @if($errors->has('price'))
       <p>{{ $errors->first('price') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="stock">在庫数</label>
    <input type="text" class="form-control" name="stock" value="{{$product->stock}}" required>
    @if($errors->has('stock'))
       <p>{{ $errors->first('stock') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="comment">コメント</label>
    <input type="comment" class="form-control" name="comment" value="{{$product->comment}}">
    @if($errors->has('comment'))
       <p>{{ $errors->first('comment') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="img_path">商品画像</label>
    <input id="img_path" type="file" name="img_path" class="form-control"  value="{{$product->img_path}}">
    @if($errors->has('img_path'))
       <p>{{ $errors->first('img_path') }}</p>
    @endif
</div>  

<button class="btn btn-primary"type=“button”>更新</button>
<a href ="{{ route('detail', $product->id) }}" class="btn btn-primary">戻る</a>

</form>
</div>
</div>
@endsection