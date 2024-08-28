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
        <button id="openModalBtn" class="py-3 px-4 bg-[#096BA2] text-white rounded-md">Tambah Barang Keluar</button>
        <div class="mt-4">
            @if($products->isEmpty())
                <p class="text-center text-gray-500">There are no products.</p>
            @else
                <table class="min-w-full border-collapse">
                    <thead>
                    <tr class="bg-[#597697] text-white">
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Barcode</th>
                        <th class="px-4 py-2 border">Nama Produk</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Jumlah Stok</th>
                        <th class="px-4 py-2 border">Harga Beli</th>
                        <th class="px-4 py-2 border">Harga Jual</th>
                        <th class="px-4 py-2 border">Nilai Stok</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $index => $product)
                        <tr class="{{ $index % 2 == 0 ? 'bg-[#FFFFFF00]' : 'bg-[#FFFFFF]' }}">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $product->barcode }}</td>
                            <td class="px-4 py-2 border">{{ $product->name }}</td>
                            <td class="px-4 py-2 border">{{ $product->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 border">{{ $product->stock->quantity }}</td>
                            <td class="px-4 py-2 border">{{ $product->price->purchase_price }}</td>
                            <td class="px-4 py-2 border">{{ $product->price->selling_price }}</td>
                            <td class="px-4 py-2 border">{{ $product->stock->quantity * $product->price->purchase_price }}</td>
                            <td class="px-4 py-2 border space-x-1">
                                <button class="bg-[#27B847] px-3.5 py-1.5 rounded-sm text-white" onclick="openEditModal({{ $product }})">Edit</button>
                                <button class="bg-[#EB4335] px-3.5 py-1.5 rounded-sm text-white" onclick="openDeleteModal({{ $product->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-1/3">
            <h2 class="text-2xl mb-4">Tambah Produk Baru</h2>
            <form action="{{ route('tambah_barang') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                    <input type="text" name="barcode" id="barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="selling_price" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                    <input type="number" name="selling_price" id="selling_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModalBtn" class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                    <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-1/3">
            <h2 class="text-2xl mb-4">Edit Produk</h2>
            <form id="editProductForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                    <input type="text" name="barcode" id="edit_barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="name" id="edit_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="edit_stock_quantity" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                    <input type="number" name="stock_quantity" id="edit_stock_quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="edit_purchase_price" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                    <input type="number" name="purchase_price" id="edit_purchase_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="edit_selling_price" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                    <input type="number" name="selling_price" id="edit_selling_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeEditModalBtn" class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                    <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-1/3">
            <h2 class="text-2xl mb-4">Hapus Produk</h2>
            <p>Apakah Anda yakin ingin menghapus produk ini?</p>
            <form id="deleteProductForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end mt-4">
                    <button type="button" id="closeDeleteModalBtn" class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                    <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded-md">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('openModalBtn').addEventListener('click', function() {
            document.getElementById('addProductModal').classList.remove('hidden');
        });

        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('addProductModal').classList.add('hidden');
        });

        document.getElementById('closeEditModalBtn').addEventListener('click', function() {
            document.getElementById('editProductModal').classList.add('hidden');
        });

        document.getElementById('closeDeleteModalBtn').addEventListener('click', function() {
            document.getElementById('deleteProductModal').classList.add('hidden');
        });

        function openEditModal(product) {
            document.getElementById('edit_barcode').value = product.barcode;
            document.getElementById('edit_name').value = product.name;
            document.getElementById('edit_stock_quantity').value = product.stock.quantity;
            document.getElementById('edit_purchase_price').value = product.price.purchase_price;
            document.getElementById('edit_selling_price').value = product.price.selling_price;
            document.getElementById('editProductForm').action = `/barang/${product.id}`;
            document.getElementById('editProductModal').classList.remove('hidden');
        }

        function openDeleteModal(productId) {
            document.getElementById('deleteProductForm').action = `/barang/${productId}`;
            document.getElementById('deleteProductModal').classList.remove('hidden');
        }
    </script>
@endsection
