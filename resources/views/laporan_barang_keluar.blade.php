@extends('dashboard_layout')

@section('body_content')
    <h2 class="text-4xl text-[#434040] font-medium">Laporan Barang Keluar</h2>

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
        <form action="{{ route("cetak_laporan_barang_keluar") }}" method="GET" class="flex space-x-2">
            @csrf
            <input type="date" name="from_date" id="from-date"
                   class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
            <input type="date" name="to_date" id="to-date"
                   class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
            <button type="button" class="px-8 py-3 bg-[#33A8E9] text-white rounded-md" onclick="getProduct()">Cari
            </button>
            <button type="submit" class="px-8 py-3 bg-[#8B52D3] text-white rounded-md">Cetak</button>
        </form>
        <div class="flex items-center w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2 bg-white">
            <input type="text" id="search-bar" class="flex-grow border-none focus:outline-none" placeholder="Search...">
            <button class="ml-2 bg-[#096BA2] text-white py-2 px-4 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M10.2369 10.8405C9.33019 11.5456 8.19077 11.9655 6.9533 11.9655C3.996 11.9655 1.59863 9.56747 1.59863 6.60934C1.59863 3.65121 3.996 1.25317 6.9533 1.25317C9.91061 1.25317 12.308 3.65121 12.308 6.60934C12.308 7.84703 11.8883 8.98668 11.1835 9.89364L13.8931 12.6007C14.1546 12.862 14.1549 13.2859 13.8936 13.5475C13.6324 13.8092 13.2086 13.8094 12.947 13.5481L10.2369 10.8405ZM10.9693 6.60934C10.9693 8.82794 9.17128 10.6265 6.9533 10.6265C4.73533 10.6265 2.9373 8.82794 2.9373 6.60934C2.9373 4.39074 4.73533 2.59222 6.9533 2.59222C9.17128 2.59222 10.9693 4.39074 10.9693 6.60934Z"
                          fill="#FFFFFF"/>
                </svg>
            </button>
        </div>
        <div class="mt-3">
            <table class="min-w-full border-collapse">
                <thead>
                <tr class="bg-[#597697] text-white">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">List Nama Toko</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Produk</th>
                    <th class="px-4 py-2 border">Total Harga Pembelian</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const searchInput = document.querySelector('#search-bar');

        searchInput.addEventListener('input', function () {
            const productRows = document.querySelectorAll('tbody tr');
            const searchTerm = searchInput.value.toLowerCase();

            productRows.forEach(row => {
                const productName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function getProduct() {
            const fromDate = document.querySelector('#from-date').value;
            const toDate = document.querySelector('#to-date').value;

            fetch(`/get-productout?from_date=${fromDate}&to_date=${toDate}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('tbody');
                    tbody.innerHTML = '';
                    data.products.forEach((product, index) => {
                        const row = document.createElement('tr');
                        row.className = index % 2 === 0 ? 'bg-[#FFFFFF00]' : 'bg-[#FFFFFF]';

                        row.innerHTML = `
                    <td class="px-4 py-2 border">${index + 1}</td>
                    <td class="px-4 py-2 border">${product.stall.name}</td>
                    <td class="px-4 py-2 border">${product.date}</td>
                    <td class="px-4 py-2 border">${product.product.name}</td>
                    <td class="px-4 py-2 border">${new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format((product.carton * product.product.ppc + product.pcs) * product.product.price.purchase_price)}</td>
                `;

                        tbody.appendChild(row);
                    });
                });
        }
    </script>
@endsection
