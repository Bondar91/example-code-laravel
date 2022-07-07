@extends('admin.layouts.app')
@section('admin-content')
    <div class="card shadow m-4">
        <div class="m-5">
            <h2 class="text-3xl">Utwótrz kupon</h2>
        </div>
        <div>
            <form method="POST" action="{{ url('/admin/discount-coupons') }}">
                @csrf
                @include('admin.discountCoupons.forms.createOrUpdateForm')
                <button type="submit" class="ml-20 mb-20 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-40 rounded">
                    Dodaj
                </button>
                <hr>
            </form>
        </div>
    </div>
@endsection
