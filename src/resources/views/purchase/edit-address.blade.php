@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit-address.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>住所の変更</h1>
    <form action="/purchase/address/{{ $item->id }}" method="post" novalidate>
        @csrf
        <div class="form-group">
            <label for="postal_code">郵便番号</label>
            <input
                type="text"
                class="form-control"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', $purchaseAddress['postal_code']) }}"
                required
            />
        </div>
        <div class="form-group">
            <label for="address">住所</label>
            <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                value="{{ old('address', $purchaseAddress['address']) }}"
                required
            />
        </div>
        <div class="form-group">
            <label for="building_name">建物名</label>
            <input
                type="text"
                class="form-control"
                id="building_name"
                name="building_name"
                value="{{ old('building_name', $purchaseAddress['building_name']) }}"
            />
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection 