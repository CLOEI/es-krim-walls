@extends('dashboard_layout')

@section('body_content')
    <h2 class="text-4xl text-[#434040] font-medium">Tambah Produk Baru</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4 mt-2">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded-md mb-4 mt-2">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-md mb-4 mt-2">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="text-left mt-8">
        <form action="{{ route("tambah_barang") }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <p>Barcode</p>
                <input type="text" maxlength="8" name="barcode" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2"
                       value="{{ old('barcode') }}">
            </div>
            <div>
                <p>Nama Produk</p>
                <input type="text" name="name" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2"
                       value="{{ old('name') }}">
            </div>
            <div>
                <p>Jumlah piece per carton</p>
                <input type="number" name="ppc" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2"
                       value="{{ old('ppc') }}">
            </div>
            <div>
                <p>Harga Beli</p>
                <input type="number" name="purchase_price" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2"
                       value="{{ old('purchase_price') }}">
            </div>
            <div>
                <p>Harga Jual</p>
                <input type="number" name="selling_price" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2"
                       value="{{ old('selling_price') }}">
            </div>
            <button type="submit" class="py-3 px-4 rounded-sm bg-[#096BA2] text-white">Simpan</button>
        </form>
    </div>
@endsection
