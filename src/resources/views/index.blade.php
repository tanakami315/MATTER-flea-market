@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
商品一覧

@foreach ($items as $item)
<tr class="result__content">
    <td>
        @if (Str::startsWith($item->image, ['http://', 'https://']))
            <img class="item-image" src="{{ $item->image }}" alt="">
        @else
            <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="">
        @endif
    </td>
    <td>{{ $item->name }}</td>
</tr>
@endforeach

@endsection