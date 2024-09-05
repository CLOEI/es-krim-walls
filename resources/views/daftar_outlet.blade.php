@extends('dashboard_layout')

@section('body_content')
    <h2 class="text-4xl text-[#434040] font-medium">Daftar Outlet</h2>

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
        <div class="mt-4">
            @if($stalls->isEmpty())
                <p class="text-center text-gray-500">There are no stall.</p>
            @else
                <table class="min-w-full border-collapse">
                    <thead>
                    <tr class="bg-[#597697] text-white">
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Alamat</th>
                        <th class="px-4 py-2 border">No. handphone</th>
                        <th class="px-4 py-2 border">Email</th>
                        @if(auth()->user()->role == "manager")
                            <th class="px-4 py-2 border">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stalls as $index => $stall)
                        <tr class="{{ $index % 2 == 0 ? 'bg-[#FFFFFF00]' : 'bg-[#FFFFFF]' }}">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $stall->name }}</td>
                            <td class="px-4 py-2 border">{{ $stall->address }}</td>
                            <td class="px-4 py-2 border">{{ $stall->phone }}</td>
                            <td class="px-4 py-2 border">{{ $stall->email }}</td>
                            @if(auth()->user()->role == "manager")
                                <td class="px-4 py-2 border space-x-1 flex">
                                    <button class="bg-[#27B847] px-3.5 py-1.5 rounded-sm text-white"
                                            onclick="openEditModal({{ $stall }})">Edit
                                    </button>
                                    <button class="bg-[#EB4335] px-3.5 py-1.5 rounded-sm text-white"
                                            onclick="openDeleteModal({{ $stall->id }})">Delete
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

    <!-- Edit Stall Modal -->
    <div id="editProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-1/3">
            <h2 class="text-2xl mb-4">Edit Outlet</h2>
            <form id="editProductForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="edit_name"
                           class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2">
                </div>
                <div class="mb-4">
                    <label for="edit_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="address" id="edit_address"
                           class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2">
                </div>
                <div class="mb-4">
                    <label for="edit_phone" class="block text-sm font-medium text-gray-700">No. handphone</label>
                    <input type="number" name="phone" id="edit_phone"
                           class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2">
                </div>
                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700">HEmail</label>
                    <input type="email" name="email" id="edit_email"
                           class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2">
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
            <h2 class="text-2xl mb-4">Hapus Outlet</h2>
            <p>Apakah Anda yakin ingin menghapus outlet ini?</p>
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
        const searchInput = document.querySelector('#search-bar');
        const productRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();

            productRows.forEach(row => {
                const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.getElementById('closeEditModalBtn').addEventListener('click', function () {
            document.getElementById('editProductModal').classList.add('hidden');
        });

        document.getElementById('closeDeleteModalBtn').addEventListener('click', function () {
            document.getElementById('deleteProductModal').classList.add('hidden');
        });

        function openEditModal(stall) {
            document.getElementById('edit_name').value = stall.name;
            document.getElementById('edit_address').value = stall.address;
            document.getElementById('edit_phone').value = stall.phone;
            document.getElementById('edit_email').value = stall.email;
            document.getElementById('editProductForm').action = `/daftar_outlet/${stall.id}`;
            document.getElementById('editProductModal').classList.remove('hidden');
        }

        function openDeleteModal(stallId) {
            document.getElementById('deleteProductForm').action = `/daftar_outlet/${stallId}`;
            document.getElementById('deleteProductModal').classList.remove('hidden');
        }
    </script>
@endsection
