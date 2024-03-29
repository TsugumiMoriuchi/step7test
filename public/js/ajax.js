$(document).ready(function() {
    $("#sort").tablesorter();
});
console.log('検索');
//検索非同期
$(document).on('click', '#search-btn', function(e){
    e.preventDefault();
    var keyword = $('input[name="keyword"]').val();
    var searchCompany = $('select[name="search-company"]').val();
    var minPrice = $('input[name="min_price"]').val();
    var maxPrice = $('input[name="max_price"]').val();
    var minStock = $('input[name="min_stock"]').val();
    var maxStock = $('input[name="max_stock"]').val();

    $.ajax({
        url: "search",
        type: "GET",
        data: {
            keyword: keyword,
            'search-company': searchCompany,
            min_price: minPrice,
            max_price: maxPrice,
            min_stock: minStock,
            max_stock: maxStock
        },
        success:function(response){
            var tableHtml = $(response).find('#mytable').html();// テーブル部分を抜き出す
            $('#mytable').html(tableHtml);
            // テーブルが更新された後にソート用のJavaScriptを再度実行
            $("#sort").tablesorter();
        }
    });
});

//削除非同期
$(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
    let deleteConfirm = confirm('削除しますか？');
    if(deleteConfirm) {
        var clickEle = $(this)
        var productId = clickEle.data('product_id');
            // var productId = clickEle.closest('tr').find('.product-id').text(); // 商品IDを取得

    // 確認ダイアログを表示し、ユーザーが削除を確認したら削除リクエストを送信
        $.ajaxSetup({
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),},
        });
        $.ajax({
            type: "POST",
            url: "products/" + productId,
            data: {
               '_method': 'DELETE'},
        }).done(function(data) {
            if (data.success) {
            // 削除が成功したら該当する商品の行を非表示にする
                clickEle.parents('tr').remove();
            } else {
                alert('削除に失敗しました');
            }
        }).fail(function() {
            alert('削除に失敗しました');
        });
    } 
});


  
  






