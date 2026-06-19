<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log Aktivitas (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="w-full text-sm text-left">
                    <thead class="border-b text-gray-500">
                        <tr>
                            <th class="py-2">Waktu</th>
                            <th class="py-2">User</th>
                            <th class="py-2">Aksi</th>
                            <th class="py-2">Deskripsi</th>
                            <th class="py-2">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr class="border-b">
                                <td class="py-2 text-gray-500">{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td class="py-2 font-medium">{{ $log->user->name ?? 'Unknown' }}</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        {{ ucfirst($log->action) }}
                                    </span>
                                </td>
                                <td class="py-2 text-gray-600">{{ $log->description }}</td>
                                <td class="py-2 text-gray-400">{{ $log->ip_address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>