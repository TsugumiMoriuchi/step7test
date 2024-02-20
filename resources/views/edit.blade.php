@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">
<h1 class="mb-4">商品情報編集画面</h1>

<form method="POST"
    action="{{ route('edit', $product->id) }}"  enctype="multipart/form-data">

    @csrf
    @method('PUT')
<div class="mb-3>
    <label for="">ID</label>
    <input type="number" class="form-control" name="product_id">
</div>

<div class="mb-3>
    <label for="">商品名</label>
    <input type="text" class="form-control" name="product_name">
    @if($errors->has('product_name'))
       <p>{{ $errors->first('product_name') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="">メーカー名</label>
    <select name="company_id" class="form-control" id="">
        @foreach($companies as $company)
            <option value="{{$company->id}}">{{ $company->company_name}}</option>
        @endforeach
    </select>
    @if($errors->has('company_id'))
       <p>{{ $errors->first('company_id') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="">価格</label>
    <input type="text" class="form-control" name="price">
    @if($errors->has('price'))
       <p>{{ $errors->first('price') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="">在庫数</label>
    <input type="text" class="form-control" name="stock">
    @if($errors->has('stock'))
       <p>{{ $errors->first('stock') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="">コメント</label>
    <input type="comment" class="form-control" name="comment">
    @if($errors->has('comment'))
       <p>{{ $errors->first('comment') }}</p>
    @endif
</div>

<div class="mb-3>
    <label for="">商品画像</label>
    <input id="img_path" type="file" name="img_path" class="form-control" required>
    @if($errors->has('img_path'))
       <p>{{ $errors->first('img_path') }}</p>
    @endif
</div>  

<button class="btn btn-primary"type=“button”>更新</button>
<a href ="{{ rouote('detail', $product->id) }}" class="btn btn-primary">戻る</a>

</form>
</div>
</div>
@endsection