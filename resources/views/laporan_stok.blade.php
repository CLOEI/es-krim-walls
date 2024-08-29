@extends('dashboard_layout')

@section('body_content')
    <h2 class="text-4xl text-[#434040] font-medium">Daftar Barang Masuk</h2>

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

    <div class="text-left mt-12">
        <div class="flex space-x-2">
            <input type="date" name="date" id="date" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
            <input type="date" name="date" id="date" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
            <button class="px-8 py-3 bg-[#33A8E9] text-white rounded-md">Cari</button>
            <button class="px-8 py-3 bg-[#8B52D3] text-white rounded-md">Cetak</button>
        </div>
    </div>

@endsection
