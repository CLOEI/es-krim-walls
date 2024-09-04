@extends('layout')

@section('content')
    <div class="px-10">
        <div class="flex flex-col items-center justify-center mt-20">
            <h1 class="font-bold text-4xl">Laporan Barang Masuk</h1>
            <p class="font-bold text-2xl max-w-xl mt-2 text-center">PT Aldora sukses perkasa</p>
            <p class="text-xl font-medium max-w-xl mt-2 text-center">Jl. Surya Kencana No.1, Pamulang Bar., Kec.
                Pamulang, Kota Tangerang Selatan, Banten 15417</p>
        </div>
        <div class="h-1 bg-black mt-16 mb-7"></div>
        <div>
            <p class="text-right text-lg">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</p>
            <div class="grid grid-cols-2">
                <p class="text-lg">Tanggal Awal</p>
                <p class="text-lg" id="tanggal-awal">: </p>
                <p class="text-lg">Tanggal Akhir</p>
                <p class="text-lg" id="tanggal-akhir">: </p>
            </div>
            <table class="min-w-full border-collapse mt-9">
                <thead>
                <tr class="bg-[#597697] text-white">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Barcode</th>
                    <th class="px-4 py-2 border">Nama Produk</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Total Harga Pembelian</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const tanggalAwal = document.querySelector('#tanggal-awal');
        const tanggalAkhir = document.querySelector('#tanggal-akhir');
        function getCurrentQueryParams() {
            const params = new URLSearchParams(window.location.search);
            const queryParams = {};
            for (const [key, value] of params.entries()) {
                if (queryParams[key]) {
                    if (Array.isArray(queryParams[key])) {
                        queryParams[key].push(value);
                    } else {
                        queryParams[key] = [queryParams[key], value];
                    }
                } else {
                    queryParams[key] = value;
                }
            }
            return queryParams;
        }

        const currentQueryParams = getCurrentQueryParams();

        fetch(`/get-products?from_date=${currentQueryParams["from_date"]}&to_date=${currentQueryParams["to_date"]}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('tbody');
                console.log(data)
                tanggalAwal.textContent = `: ${currentQueryParams["from_date"]}`;
                tanggalAkhir.textContent = `: ${currentQueryParams["to_date"]}`;
                tbody.innerHTML = '';
                data.products.forEach((product, index) => {
                    const row = document.createElement('tr');
                    row.className = index % 2 === 0 ? 'bg-[#FFFFFF00]' : 'bg-[#FFFFFF]';

                    row.innerHTML = `
                    <td class="px-4 py-2 border">${index + 1}</td>
                    <td class="px-4 py-2 border">${product.product.barcode}</td>
                    <td class="px-4 py-2 border">${product.product.name}</td>
                    <td class="px-4 py-2 border">${product.date}</td>
                    <td class="px-4 py-2 border">${product.product.stock.quantity}</td>
                    <td class="px-4 py-2 border">Rp ${product.product.stock.quantity * product.product.price.purchase_price}</td>
                `;
                    tbody.appendChild(row);
                });
            });
    </script>
@endsection
