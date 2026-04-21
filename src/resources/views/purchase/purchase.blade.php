@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection



@section('content')
<form action="/purchase/finish/{{ $item->id }}" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="item-detail">
        <div class="item-detail__image">
            @if (Str::startsWith($item->image, ['http://', 'https://']))
                <img class="item-image" src="{{ $item->image }}" alt="">
            @else
                <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="">
            @endif
        </div>

        <div class="item-detail__content">
            <h2>{{ $item->name }}</h2>
            <p>ブランド：{{ $item->brand }}</p>
            <p>価格：¥{{ number_format($item->price) }}</p>
        </div>

        <div>
            <h2>支払方法</h2>
            <select name="payment_method" id="payment_method">
                <option value="1">コンビニ払い</option>
                <option value="2">カード支払い</option>
            </select>
        </div>

        <div>
            <h2>配送先</h2>
            <div class="address">
                <p>{{ $purchaseAddress['postal_code'] }}</p>
                <p>{{ $purchaseAddress['address'] }}</p>
                <p>{{ $purchaseAddress['building_name'] }}</p>
            </div>
            <a href="{{ url('/purchase/address/' . $item->id) }}" class="edit-address-link">
                変更する
            </a>
        </div>
    </div>

    <button type="submit" class="buy-button">購入</button>
</form>