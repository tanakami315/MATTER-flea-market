@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="page_link">
    <a href="{{ url('/?keyword=' . request('keyword')) }}">おすすめ</a>
</div>
<div class="page_link">
    <a href="{{ url('/?tab=mylist&keyword=' . request('keyword')) }}">マイリスト</a>
</div>

<!-- 以下mypage.blade.phpとおなじ -->
@foreach ($items as $item)
        <tr class="result__content">
            <td>
                <a href="{{ url('/item/' . $item->id) }}">  
                @if (Str::startsWith($item->image, ['http://', 'https://']))
                    <img class="item-image" src="{{ $item->image }}" alt="">
                @else
                    <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="">
                @endif
                </a>
            </td>
            <td>{{ $item->name }}
                @if ($item->sold)
                    <span class="sold-out">SOLD OUT</span>
                @endif
            </td>
        </tr>
@endforeach
@endsection