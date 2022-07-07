@extends('admin.layouts.app')
@section('admin-content')
    <div class="card shadow m-4">
        <div class="m-5">
            <h2 class="text-3xl">Wygenruj kupony</h2>
        </div>
        <div>
            <form method="POST" action="{{ url('/admin/discount-coupons/generate') }}">
                @csrf
                @include('admin.discountCoupons.forms.generateForm')
                <button name="action" value="coupon-export" type="submit" class="ml-20 mb-20 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-40 rounded">
                    Wygeneruj
                </button>
                <hr>
            </form>
        </div>
    </div>
@endsection
