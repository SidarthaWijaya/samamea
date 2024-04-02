@extends('layouts.template',['pageTitle'=> "Checkout",'pageCategory'=> "checkout"])

@section('content')
<div class="container">
    <div class="row m-0 col-12">
        <h3>Order Summary</h3>
    </div>
</div>

<div class="container px-3 py-4">
    <div class="col-12 row mx-auto px-0" id="itemlist">
      @foreach($order_details as $orderdetail)
      @if($orderdetail->order->session==$session)
          <div class="col-12 p-0 m-0 mb-4 menu row">
               <div class="col-3 pl-0 pr-2">
                     <img class="pic w-100" src="https://arasatu.com/images/team/HC.jpg" alt="Card image cap">
                 </div>
                 <div class="col-6 py-0 px-2">
                     <div class="body">
                         <h5 class="title">{{$orderdetail->menu->name}}</h5>
                         <p class="brief">{{$orderdetail->note}}</p>
                         <div class="row col-12 m-0 p-0">
                             <div class="number w-100">
                                 <span class="minus">-</span>
                                 <input type="text" value=" {{$orderdetail->qty}}"/>
                                 <span class="plus">+</span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-3 pl-2 pr-0">
                     <form action="/order/{{$orderdetail->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                    <button type="submit">delete</button>
                    </form>
                     <p onclick="delItem('+order[i][0]+')" class="price m-0">DELETE</p>
                 </div>
             </div>
      @endif
  @endforeach
    </div>
</div>
<a href="/checkout">checkout</a>
@endsection

@push('bottomscripts')
<script>
    function delItem (id) {
        alert("delete menu"+id);
    }
    
    $(document).ready(function() {
        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });
</script>
@endpush