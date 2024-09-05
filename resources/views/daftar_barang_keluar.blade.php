@extends('dashboard_layout')

@section('body_content')
    <h2 class="text-4xl text-[#434040] font-medium">Daftar Barang Keluar</h2>

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
        <button id="openTambahBarangKeluarModalBtn" class="py-3 px-4 bg-[#096BA2] text-white rounded-md">Tambah Barang Keluar</button>
        <div class="mt-4">
            @if($products_out->isEmpty())
                <p class="text-center text-gray-500">There are no products.</p>
            @else
                <table class="min-w-full border-collapse">
                    <thead>
                    <tr class="bg-[#597697] text-white">
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">List nama Toko</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Produk</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        @if(auth()->user()->role == "manager")
                            <th class="px-4 py-2 border">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products_out as $index => $product)
                        <tr class="{{ $index % 2 == 0 ? 'bg-[#FFFFFF00]' : 'bg-[#FFFFFF]' }}">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $product->stall->name }}</td>
                            <td class="px-4 py-2 border">{{ $product->date }}</td>
                            <td class="px-4 py-2 border">{{ $product->product->name }}</td>
                            <td class="px-4 py-2 border">{{ $product->quantity }}</td>
                            @if(auth()->user()->role == "manager")
                                <td class="px-4 py-2 border space-x-1">
                                    <button class="bg-[#27B847] px-3.5 py-1.5 rounded-sm text-white" onclick="openEditModal({{ $product }})">Edit</button>
                                    <button class="bg-[#EB4335] px-3.5 py-1.5 rounded-sm text-white" onclick="openDeleteModal({{ $product->id }})">Delete</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Add Product Out Modal -->
    <div id="tambahBarangKeluarModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-2/3">
            <h2 class="text-2xl mb-4">Tambah Barang Keluar</h2>
            <form action="/daftar_barang_keluar" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="stall_id" class="block text-sm font-medium text-gray-700">Search Nama Toko</label>
                    <select id="stall_id" name="stall_id" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" placeholder="Search for stall..." required>
                        <option value="">Select a stall...</option>
                        @foreach($stalls as $stall)
                            <option value="{{ $stall->id }}">{{ $stall->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <table class="min-w-full border-collapse">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">Produk</th>
                            <th class="px-4 py-2 border">Jumlah</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="products-container">
                        <tr class="product-item">
                            <td class="px-4 py-2 border">
                                <select name="products[0][product_id]" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                                    <option value="">Select a product...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-2 border">
                                <input type="number" name="products[0][quantity]" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <button type="button" class="remove-product-btn text-red-500">Remove</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" id="addProductBtn" class="py-2 px-4 bg-green-500 text-white rounded-md mb-4">Add Another Product</button>
                <div class="flex justify-end">
                    <button type="button" id="closeTambahBarangKeluarModalBtn" class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                    <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('openTambahBarangKeluarModalBtn').addEventListener('click', function () {
            document.getElementById('tambahBarangKeluarModal').classList.remove('hidden');
        });

        document.getElementById('closeTambahBarangKeluarModalBtn').addEventListener('click', function () {
            document.getElementById('tambahBarangKeluarModal').classList.add('hidden');
        });

        document.getElementById('addProductBtn').addEventListener('click', function () {
            const productsContainer = document.getElementById('products-container');
            const productCount = productsContainer.getElementsByClassName('product-item').length;
            const newProductItem = document.createElement('tr');
            newProductItem.classList.add('product-item');
            newProductItem.innerHTML = `
                <td class="px-4 py-2 border">
                    <select name="products[${productCount}][product_id]" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                        <option value="">Select a product...</option>
                        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
            </select>
        </td>
        <td class="px-4 py-2 border">
            <input type="number" name="products[${productCount}][quantity]" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                </td>
                <td class="px-4 py-2 border text-center">
                    <button type="button" class="remove-product-btn text-red-500">Remove</button>
                </td>
            `;
            productsContainer.appendChild(newProductItem);
        });

        document.getElementById('products-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-product-btn')) {
                e.target.closest('.product-item').remove();
            }
        });
    </script>
@endsection
