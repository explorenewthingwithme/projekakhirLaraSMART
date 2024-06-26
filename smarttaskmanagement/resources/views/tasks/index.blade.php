<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tasks
            </h2>
        </x-slot>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="task_name" class="block text-sm font-medium text-gray-700">Nama Tugas</label>
                    <input type="text" name="task_name" id="task_name" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('task_name') }}" required>
                    <x-input-error :messages="$errors->get('task_name')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="course_name" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                    <input type="text" name="course_name" id="course_name" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('course_name') }}" required>
                    <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('start_date') }}" required>
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('deadline') }}" required>
                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="difficulty_level" class="block text-sm font-medium text-gray-700">Tingkat Kesulitan</label>
                    <select name="difficulty_level" id="difficulty_level" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                        <option value="easy" {{ old('difficulty_level') == 'easy' ? 'selected' : '' }}>Mudah</option>
                        <option value="medium" {{ old('difficulty_level') == 'medium' ? 'selected' : '' }}>Sedang</option>
                        <option value="hard" {{ old('difficulty_level') == 'hard' ? 'selected' : '' }}>Sulit</option>
                    </select>
                    <x-input-error :messages="$errors->get('difficulty_level')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="importance" class="block text-sm font-medium text-gray-700">Tingkat Kepentingan</label>
                    <select name="importance" id="importance" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                        <option value="low" {{ old('importance') == 'low' ? 'selected' : '' }}>Rendah</option>
                        <option value="medium" {{ old('importance') == 'medium' ? 'selected' : '' }}>Sedang</option>
                        <option value="high" {{ old('importance') == 'high' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                    <x-input-error :messages="$errors->get('importance')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="estimated_time" class="block text-sm font-medium text-gray-700">Perkiraan Waktu Pengerjaan (jam)</label>
                    <input type="number" name="estimated_time" id="estimated_time" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('estimated_time') }}" required>
                    <x-input-error :messages="$errors->get('estimated_time')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="task_type" class="block text-sm font-medium text-gray-700">Tipe Tugas</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="task_type" value="individual" class="form-radio" {{ old('task_type') == 'individual' ? 'checked' : '' }}>
                            <span class="ml-2">Individu</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input type="radio" name="task_type" value="group" class="form-radio" {{ old('task_type') == 'group' ? 'checked' : '' }}>
                            <span class="ml-2">Kelompok</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('task_type')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="additional_notes" class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                    <textarea name="additional_notes" id="additional_notes" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('additional_notes') }}</textarea>
                    <x-input-error :messages="$errors->get('additional_notes')" class="mt-2" />
                </div>
                <x-primary-button class="mt-4">{{ __('Simpan Tugas') }}</x-primary-button>
            </form>
        </div>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Tugas
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Tugas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Mata Kuliah
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Mulai
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deadline
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tipe Tugas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tingkat Kepentingan
                        </th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $task->task_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $task->course_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($task->start_date)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ucfirst($task->task_type) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ucfirst($task->importance) }}
                            </td>
                            <!-- Tampilkan kolom lain sesuai kebutuhan -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
