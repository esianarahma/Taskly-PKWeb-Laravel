<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-lg font-medium text-brand-dark">Activity Logs</h2>
            <p class="text-sm text-brand mt-1">Pantau semua aktivitas pengguna aplikasi</p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-pink p-0 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background:linear-gradient(135deg,#FBEAF0,#FDF1F5);">
                        <th class="text-left px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">Waktu</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">User</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">Aksi</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">Deskripsi</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr class="border-t border-brand-border hover:bg-pink-50 transition-colors">
                            <td class="px-6 py-3 text-gray-400 text-xs">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-white text-xs font-medium flex-shrink-0" style="background:linear-gradient(135deg,#ED93B1,#D4537E);">
                                        {{ strtoupper(substr($log->user->name ?? 'U', 0, 2)) }}
                                    </div>
                                    <span class="font-medium text-brand-dark">{{ $log->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($log->action === 'create') bg-green-100 text-green-700
                                    @elseif($log->action === 'update') bg-yellow-100 text-yellow-700
                                    @elseif($log->action === 'delete') bg-red-100 text-red-700
                                    @else bg-pink-50 text-brand-hover @endif">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-500">{{ $log->description }}</td>
                            <td class="px-6 py-3 text-gray-400 text-xs">{{ $log->ip_address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($logs->hasPages())
                <div class="px-6 py-4 border-t border-brand-border">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>