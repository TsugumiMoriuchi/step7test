@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<h1 class="mb-4">商品情報登録画面</h1>

<form method="POST"
    action="{{ route('createSubmit') }}"  enctype="multipart/form-data">

    @csrf
<div class="mb-3>
    <label for="">商品名</label>
    <input type="text" class="form-control" name="product_name" required>
</div>

<div class="mb-3>
    <label for="">メーカー名</label>
    <select name="company_id" class="form-control" id="" required>
        @foreach($companies as $company)
            <option value="{{$company->id}}">{{ $company->company_name}}</option>
        @endforeach
    </select>
</div>

<div class="mb-3>
    <label for="">価格</label>
    <input type="text" class="form-control" name="price" required>
</div>

<div class="mb-3>
    <label for="">在庫数</label>
    <input type="text" class="form-control" name="stock" required>
</div>

<div class="mb-3>
    <label for="">コメント</label>
    <input type="comment" class="form-control" name="comment">
</div>

<div class="mb-3>
    <label for="">商品画像</label>
    <input id="img_path" type="file" name="img_path" class="form-control">
</div>  

<button type="submit" class="btn btn-primary">新規登録</button> 

<a href="{{ route('list') }} "class="btn btn-primary">戻る</a>
</form>
</div>
</div>
@endsection