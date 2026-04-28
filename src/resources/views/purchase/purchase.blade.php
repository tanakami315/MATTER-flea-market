@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
    <div class="purchase-card">
        <form
            class="purchase-form-area"
            action="/purchase/finish/{{ $item->id }}"
            method="post"
            enctype="multipart/form-data"
            novalidate
        >
            @csrf
            <div class="purchase-form">
                <div class="item-info">
                    @if (Str::startsWith($item->image, ['http://', 'https://']))
                        <img class="item-image" src="{{ $item->image }}" alt="">
                    @else
                        <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="">
                    @endif
                    <div class="item-text">
                        <div class="item-name">{{ $item->name }}</div>
                        <p class="item-price">¥{{ number_format($item->price) }}</p>
                    </div>
                </div>

                <div class="purchase-form__content">
                    <div class="purchase-form__title">
                        支払方法
                    </div>
                    <select
                        class="purchase-form__payment_method"
                        name="payment_method"
                        id="payment_method"
                    >
                        <option
                            value=""
                            disabled
                            hidden
                            {{ old('payment_method') ? '' : 'selected' }}
                        >
                            選択してください
                        </option>
                        <option value="1">コンビニ払い</option>
                        <option value="2">カード支払い</option>
                    </select>
                    <div class="purchase-form__error">
                        @error('payment_method')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="purchase-form__content">
                    <div class="purchase-form__edit-address">    
                        <div class="purchase-form__title">
                            配送先
                        </div>
                        <a
                            href="{{ url('/purchase/address/' . $item->id) }}"
                            class="edit-address-link"
                        >
                            変更する
                        </a>
                    </div>
                    <div class="purchase-form__address">
                        <div>〒{{ $purchaseAddress['postal_code'] }}</div>
                        <div>{{ $purchaseAddress['address'] }}</div>
                        <div>{{ $purchaseAddress['building_name'] }}</div>
                    </div>
                </div>
            </div>

            <div class="purchase-side">
                <div class="purchase-information">
                    <div class="purchase-information__section">
                        <div class="purchase-information__title">商品代金</div>
                        <div class="purchase-information__content">
                            ¥{{ number_format($item->price) }}
                        </div>
                    </div>
                    <div class="purchase-information__section border-bottom">
                        <div class="purchase-information__title">支払い方法</div>
                        <div
                            class="purchase-information__content"
                            id="payment_method-text"
                            >
                            選択してください
                        </div>
                    </div>
                </div>
                <div class="purchase-form__button">
                <button class="purchase-form__button--submit" type="submit">
                    購入する
                </button>
            </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('payment_method');
            const text = document.getElementById('payment_method-text');

            select.addEventListener('change', function () {
                if (this.value === '1') {
                    text.textContent = 'コンビニ払い';
                } else if (this.value === '2') {
                    text.textContent = 'カード支払い';
                } else {
                    text.textContent = '選択してください';
                }
            });
        });
    </script>
@endsection