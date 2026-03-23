<x-layout title="Home">
    <x-slot:title>
        Welcome
    </x-slot:title>
    @foreach ($chirps as $chirp)
        <div class="card bg-base-100 shadow mt-4">
            <div class="card-body">
                <p>{{ $chirp['message'] }}</p>
                <div class="text-sm text-base-content/60 mt-2">
                    Posted by {{ $chirp['author'] }} on {{ $chirp['time'] }}
                </div>
            </div>
        </div>
    @endforeach
</x-layout>
