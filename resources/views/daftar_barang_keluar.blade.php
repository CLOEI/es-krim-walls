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
        <button id="openTambahBarangKeluarModalBtn" class="py-3 px-4 bg-[#096BA2] text-white rounded-md">Tambah Barang
            Keluar
        </button>
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
                        <th class="px-4 py-2 border">Carton</th>
                        <th class="px-4 py-2 border">Piece</th>
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
                            <td class="px-4 py-2 border">{{ $product->carton }}</td>
                            <td class="px-4 py-2 border">{{ $product->pcs }}</td>
                            @if(auth()->user()->role == "manager")
                                <td class="px-4 py-2 border text-center">
                                    <button type="button" class="py-2 px-4 bg-[#27B847] text-white rounded-md"
                                            onclick="openEditModal({{ $product }})">Edit
                                    </button>
                                    <button type="button" class="py-2 px-4 bg-[#EB4335] text-white rounded-md"
                                            onclick="openDeleteModal({{ $product->id }})">Delete
                                    </button>
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
    <div id="tambahBarangKeluarModal"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-2/3 max-h-full overflow-y-auto">
            <h2 class="text-2xl mb-4">Tambah Barang Keluar</h2>
            <form action="/daftar_barang_keluar" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="stall_id" class="block text-sm font-medium text-gray-700">Search Nama Toko</label>
                    <select id="stall_id" name="stall_id"
                            class="select2 w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
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
                            <th class="px-4 py-2 border">Carton</th>
                            <th class="px-4 py-2 border">Piece</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="products-container">
                        <tr class="product-item">
                            <td class="px-4 py-2 border">
                                <select name="products[0][product_id]" class="select2" required>
                                    <option value="">Select a product...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-2 border">
                                <input type="number" name="products[0][carton]"
                                       class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                            </td>
                            <td class="px-4 py-2 border">
                                <input type="number" name="products[0][piece]"
                                       class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <button type="button" class="remove-product-btn text-red-500">Remove</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" id="addProductBtn" class="py-2 px-4 bg-green-500 text-white rounded-md mb-4">Add
                    Another Product
                </button>
                <div class="flex justify-end">
                    <button type="button" id="closeTambahBarangKeluarModalBtn"
                            class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel
                    </button>
                    <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-1/3">
            <h2 class="text-2xl mb-4">Edit Barang Keluar</h2>
            <form id="editProductForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="stall_id2" class="block text-sm font-medium text-gray-700">Nama Toko</label>
                    <select id="stall_id2" name="stall_id"
                            class="select2 w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
                        <option value="">Select a stall...</option>
                        @foreach($stalls as $stall)
                            <option value="{{ $stall->id }}">{{ $stall->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="product_id" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <select id="product_id" name="product_id"
                            class="select2 w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
                        <option value="">Select a product...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="carton" class="block text-sm font-medium text-gray-700">Carton</label>
                    <input type="number" name="carton" id="carton"
                           class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
                </div>
                <div class="mb-4">
                    <label for="piece" class="block text-sm font-medium text-gray-700">Piece</label>
                    <input type="number" name="piece" id="piece"
                           class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="date" id="date"
                           class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeEditModalBtn"
                            class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel
                    </button>
                    <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteProductModal"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-1/3">
            <h2 class="text-2xl mb-4">Hapus Barang Keluar</h2>
            <p>Apakah Anda yakin ingin menghapus produk ini?</p>
            <form id="deleteProductForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end mt-4">
                    <button type="button" id="closeDeleteModalBtn"
                            class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel
                    </button>
                    <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded-md">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('select.select2').select2();
        });

        document.getElementById('openTambahBarangKeluarModalBtn').addEventListener('click', function () {
            document.getElementById('tambahBarangKeluarModal').classList.remove('hidden');
        });

        document.getElementById('closeTambahBarangKeluarModalBtn').addEventListener('click', function () {
            document.getElementById('tambahBarangKeluarModal').classList.add('hidden');
        });

        document.getElementById('closeEditModalBtn').addEventListener('click', function () {
            document.getElementById('editProductModal').classList.add('hidden');
        });

        document.getElementById('closeDeleteModalBtn').addEventListener('click', function () {
            document.getElementById('deleteProductModal').classList.add('hidden');
        });

        function openEditModal(product) {
            document.getElementById('editProductForm').action = `/daftar_barang_keluar/${product.id}`;
            document.querySelector('#editProductForm #stall_id2').value = product.stall_id;
            document.querySelector('#editProductForm #product_id').value = product.product_id;
            document.querySelector('#editProductForm #carton').value = product.carton;
            document.querySelector('#editProductForm #piece').value = product.pcs;
            document.querySelector('#editProductForm #date').value = product.date;
            document.querySelector('#editProductModal').classList.remove('hidden');
            $('.select2').select2();
        }

        function openDeleteModal(productId) {
            document.getElementById('deleteProductForm').action = `/daftar_barang_keluar/${productId}`;
            document.getElementById('deleteProductModal').classList.remove('hidden');
        }

        document.getElementById('addProductBtn').addEventListener('click', function () {
            const productsContainer = document.getElementById('products-container');
            const productCount = productsContainer.getElementsByClassName('product-item').length;
            const newProductItem = document.createElement('tr');
            newProductItem.classList.add('product-item');
            newProductItem.innerHTML = `
                <td class="px-4 py-2 border">
                    <select name="products[${productCount}][product_id]" class="select2" required>
                        <option value="">Select a product...</option>
                        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
            </select>
        </td>
        <td class="px-4 py-2 border">
            <input type="number" name="products[${productCount}][carton]" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                </td>
                <td class="px-4 py-2 border">
            <input type="number" name="products[${productCount}][piece]" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md" required>
                </td>
                <td class="px-4 py-2 border text-center">
                    <button type="button" class="remove-product-btn text-red-500">Remove</button>
                </td>
            `;
            productsContainer.appendChild(newProductItem);
            $('.select2').select2();
        });

        document.getElementById('products-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-product-btn')) {
                e.target.closest('.product-item').remove();
            }
        });
    </script>
@endsection
