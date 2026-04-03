<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Mitra
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                Welcome, {{ auth()->user()->name }}
            </div>
        </div>
    </div>

    <a href="{{ route('permohonan.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
    Kelola Permohonan
</a>
</x-app-layout>