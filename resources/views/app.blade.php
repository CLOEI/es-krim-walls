@extends('dashboard_layout')

@section('body_content')
    <h2 class="text-4xl text-[#434040] font-medium">Dashboard</h2>
    <div class="grid grid-cols-3 gap-3 mt-6">
        <div class="flex p-10 rounded-md bg-white space-x-4 items-center shadow-md">
            <img src="/assets/daftar_barang.png" width="80" height="80">
            <div>
                <p class="text-3xl font-bold text-[#464255]">{{ $productsCount }}</p>
                <p>Daftar Barang</p>
            </div>
        </div>
        <div class="flex p-10 rounded-md bg-white space-x-4 items-center shadow-md">
            <img src="/assets/daftar_barang_keluar.png" width="80" height="80">
            <div>
                <p class="text-3xl font-bold text-[#464255]">{{ $productsOutCount }}</p>
                <p>Daftar Barang Keluar</p>
            </div>
        </div>
        <div class="flex p-10 rounded-md bg-white space-x-4 items-center shadow-md">
            <img src="/assets/daftar_barang_masuk.png" width="80" height="80">
            <div>
                <p class="text-3xl font-bold text-[#464255]">{{ $productsInCount }}</p>
                <p>Daftar Barang Masuk</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-3 mt-3">
        <div class="flex p-10 rounded-md bg-white space-x-4 items-center shadow-md">
            <img src="/assets/kapasitas_maksimal.png" width="80" height="80">
            <div>
                <p class="text-3xl font-bold text-[#464255]">{{ $currentStockQuantity }}/1500</p>
                <p>Kapasitas Maksimal Stok</p>
            </div>
        </div>
        <div class="flex p-10 rounded-md bg-white space-x-4 items-center shadow-md">
            <img src="/assets/rata_rata.png" width="80" height="80">
            <div>
                <p class="text-3xl font-bold text-[#464255]">{{ $averageDailyStatistics->average_items_gone }}</p>
                <p>Rata - rata Barang Keluar Per Hari</p>
            </div>
        </div>
    </div>
    <div class="w-full flex-1 bg-white rounded-md mt-3 shadow-md flex items-center justify-center">
        <img src="/assets/hero.png" alt="Hero image" class="w-[500px]">
    </div>
@endsection
