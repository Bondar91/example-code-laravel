@extends('admin.layouts.app')
@section('admin-content')

    <div class="flex flex-col">
    <div class="m-5 flex justify-between">
            <h2 class="text-3xl">Kupony</h2>
            <div>
                <a href="discount-coupons/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">Utwórz kupon</a>
                <a href="discount-coupons/generate" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">Generuj kupony</a>
            </div>
        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Produkt
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kod
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Wartość
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aktywny
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Akcje
                                    </th>
                                </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($discountCoupons as $discountCoupon)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                              @if($discountCoupon->type == 0)
                                                {{ $discountCoupon->product->name . ' - ' . $discountCoupon->product->quantity . 'szt.' }}
                                              @else
                                                Brak przypisanego produktu
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $discountCoupon->code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                  {{ convertToTotalPrice($discountCoupon->value) }}
                                </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ boolval($discountCoupon->active) ? 'Tak' : 'Nie' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium flex justify-start">
                                    <a href="discount-coupons/{{$discountCoupon->id}}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">Edytuj</a>
                                    <form action="{{ url('/admin/discount-coupons/' . $discountCoupon->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i
                                                class="fas fa-sm text-white-50"></i>Usuń</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
