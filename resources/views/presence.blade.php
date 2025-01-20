<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h1 class="mb-4 text-2xl font-semibold text-gray-800">Presensi</h1>
        <form id="attendanceForm" class="space-y-4">
            <!-- Select Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Anda adalah:</label>
                <select id="role" name="role"
                    class="block w-full mt-1 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="" selected disabled>Pilih peran Anda</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                </select>
            </div>

            <!-- NIM / NIDN -->
            <div id="idInput" class="hidden">
                <label id="idLabel" for="idField" class="block text-sm font-medium text-gray-700">Masukkan Identitas:</label>
                <input type="text" id="idField" name="idField" placeholder="Masukkan NIM atau NIDN"
                    class="block w-full mt-1 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            </div>

            <!-- Name -->
            <div class="hidden" id="nameInput">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama:</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama Anda"
                    class="block w-full mt-1 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300">
                Submit
            </button>
        </form>
    </div>

    <script>
        const roleSelect = document.getElementById('role');
        const idInput = document.getElementById('idInput');
        const idLabel = document.getElementById('idLabel');
        const idField = document.getElementById('idField');
        const nameInput = document.getElementById('nameInput');

        roleSelect.addEventListener('change', (e) => {
            const role = e.target.value;
            if (role) {
                idInput.classList.remove('hidden');
                idLabel.textContent = role === 'mahasiswa' ? 'Masukkan NIM:' : 'Masukkan NIDN:';
                idField.placeholder = role === 'mahasiswa' ? 'Masukkan NIM' : 'Masukkan NIDN';
                nameInput.classList.remove('hidden');
            } else {
                idInput.classList.add('hidden');
                nameInput.classList.add('hidden');
            }
        });
    </script>
</body>
</html>