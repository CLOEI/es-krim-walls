@extends('dashboard_layout')

@section('body_content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Admin Users</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($users->isEmpty())
            <p>There are no users</p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2">Name</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="text-center">
                        <td class="py-2">{{ $user->first_name }}</td>
                        <td class="py-2">{{ $user->email }}</td>
                        <td class="py-2">
                            @if(auth()->user()->role == 'manager')
                                <form action="{{ route('remove_admin', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if(auth()->user()->role == 'manager')
            <button onclick="document.getElementById('addAdminModal').classList.remove('hidden')" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Add New Admin</button>

            <!-- Add Admin Modal -->
            <div id="addAdminModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-md shadow-md w-1/3">
                    <h2 class="text-2xl mb-4">Add New Admin</h2>
                    <form action="{{ route("tambah_admin") }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-4">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                            <select name="sex" id="sex" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="w-full border-2 border-gray-200 py-2 px-4 rounded-md mt-2" required autocomplete="off">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="document.getElementById('addAdminModal').classList.add('hidden')" class="py-2 px-4 bg-gray-500 text-white rounded-md mr-2">Cancel</button>
                            <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-md">Add Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection

<script>
    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('addAdminModal');
        if (event.target == modal) {
            modal.classList.add('hidden');
        }
    }
</script>
