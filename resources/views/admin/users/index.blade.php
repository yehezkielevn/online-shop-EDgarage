@extends('layouts.admin')

@section('title', 'Kelola User - E&Dgarage')
@section('header-title', 'Daftar Pengguna')

@section('content')
    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-center text-xs text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4 text-sm text-gray-500">#{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center text-xs font-bold mr-3 text-white">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-white">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($user->role === 'admin' || $user->is_admin)
                                    <span class="bg-red-900/40 text-red-400 px-2 py-1 rounded text-xs border border-red-800">Admin</span>
                                @else
                                    <span class="bg-blue-900/40 text-blue-400 px-2 py-1 rounded text-xs border border-blue-800">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-400 hover:text-blue-300 bg-blue-900/20 p-2 rounded hover:bg-blue-900/50 transition" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada user terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-700">{{ $users->links() }}</div>
    </div>
@endsection