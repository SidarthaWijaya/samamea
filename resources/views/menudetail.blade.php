@extends('layouts.template',['pageTitle'=> "Menu Detail",'pageCategory'=> "menu"])



@push('css')

<link rel="stylesheet" href="{{ asset('css/menudetail.css') }}">

@endpush



@section('content')

<div class="parallax"></div>

<div class="container px-3 py-4">

    <div class="col-12 row mx-auto px-0">

        <div class="body">

            <h3 class="title">{{$menu->name}}</h3>

            <p class="brief">{{$menu->description}}</p>

            <p class="price h4">IDR {{number_format($menu->price)}}</p>

            <form action="/menudetail" class="py-4" method="POST">

                @csrf

                <input type="hidden" id="menuID" value="{{$menu->id}}" name="menu_id">

                <div class="form-group">

                    <label for="notes">Note</label>

                    <textarea class="w-100" name="note" id="notes" rows="4"></textarea>

                </div>

                <div class="form-group">

                    <div class="number text-center">

                        <span class="minus">-</span>

                        <input type="text" value="1"id="qty" name="qty"/> 

                        <span class="plus">+</span>

                    </div>

                </div>

                <button type="submit" id="submit" class="btn btn-primary w-100">Add to cart</button>

            </form>

        </div>

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

    


</script>

@endpush