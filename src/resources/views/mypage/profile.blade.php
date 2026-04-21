@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>プロフィールの入力</h1>
    <form action="/" method="post" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">名前</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{ old('name', auth()->user()->name) }}"
                required
            />
        </div>
        <div class="form-group">
            <label for="postal_code">郵便番号</label>
            <input
                type="text"
                class="form-control"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', auth()->user()->postal_code) }}"
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
                value="{{ old('address', auth()->user()->address) }}"
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
                value="{{ old('building_name', auth()->user()->building_name) }}"
            />
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection 