 @extends('layouts.template',['pageTitle'=> "Checkout",'pageCategory'=> "checkout"])



@section('content')

<div class="container">

    <div class="row m-0 col-12">

        <h3>CHECKOUT</h3>

    </div>

</div>



<div class="container px-3 py-4">

    <div class="col-12 row mx-auto px-0">

        @foreach($order_details as $orderdetail)

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

                                <input type="text" value="{{$orderdetail->qty}}"/>

                                <span class="plus">+</span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-3 pl-2 pr-0">

                    <p class="price m-0">IDR {{number_format($orderdetail->menu->price)}}</p>

                </div>

            </div>

        @endforeach

    </div>

    <div class="col-12 row mx-auto px-0">

        <div class="col-9 pl-0 pr-2">

            <p>Subtotal</p>
            <p>Tax</p>
            <p>Service</p>
            <p>Total</p>
            
        </div>

        <div class="col-3 pl-2 pr-0">

            <p>IDR {{number_format($orders->subtotal)}}</p>

            <p>IDR {{number_format($orders->tax)}}</p>

            <p>IDR {{number_format($orders->service)}}</p>

            <p>IDR {{number_format($orders->total)}}</p>

        </div>

    </div>

</div>

@endsection
