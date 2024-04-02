@extends('layouts.template',['pageTitle'=> "Menu",'pageCategory'=> "menu"])

@push('css')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endpush 

@section('content')
<div class="search-container">
    <form action="/action_page.php">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>   

<h6>{{$session}}</h6>
<!-- <div class="container menu-list pt-3">
    <div class="col-12 row mx-auto px-0">
        @foreach($menus as $menu)
            <a href="/menu/{{$menu->id}}" class="col-12 col-md-6 col-lg-3 p-0">
                <div class="menu row p-2 m-0 mb-3">
                    <div class="col-4 pl-0 pr-2">
                        <img class="pic w-100" src="https://arasatu.com/images/team/HC.jpg" alt="Card image cap">
                    </div>
                    <div class="col-8 pl-2 pr-0">
                        <div class="body">
                            <h5 class="title m-0">{{$menu->name}}</h5>
                            <p class="brief">{{$menu->description}}</p>
                            <p class="price m-0">IDR {{number_format($menu->price)}}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div> -->

<div class="container">
    <div class="row">
    @foreach($menus as $menu)
    
        <div class="col-md-3 mb-3 menu">
        <a href="/menu/{{$menu->id}}" >
            <div class="card  border-none mb-3 h-100">
                
                <img  src="https://arasatu.com/images/team/HC.jpg" alt="Card image cap"  class="card-img-top">
            
            <div class="card-body">
                <h5 class="card-title">{{$menu->name}}</h5>
                <p class="card-text">{{$menu->description}}</p>
                <p class="card-text">{{number_format($menu->price)}}</p>
            </div>
            </div>
            </a>
            </div>
     
        @endforeach
    </div>
</div>

 
@endsection

@push('bottomscripts')
<script>
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