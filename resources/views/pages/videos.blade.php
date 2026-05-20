@extends('layouts.app')
@section('title', 'Видео')
@section('content')
<div class="container mx-auto max-w-7xl px-4 py-12">
    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
        <span class="mx-2">/</span><span class="text-gray-600">Видео</span>
    </nav>
    <h1 class="text-3xl font-bold mb-10">Видео</h1>
    @if($videos->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($videos as $video)
        <div x-data="{ playing: false }">
            <div class="relative rounded-xl overflow-hidden cursor-pointer aspect-video bg-gray-900"
                @click="playing = true">
                <img x-show="!playing" src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                    class="w-full h-full {{ str_contains($video->thumbnail, 'logo-vtp') ? 'object-contain p-6' : 'object-cover' }}">
                <div x-show="!playing" class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center shadow-xl">
                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
                <iframe x-show="playing" x-cloak
                    src="{{ $video->embed_url }}?autoplay=1"
                    class="w-full h-full absolute inset-0"
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>
            </div>
            <h2 class="font-medium mt-3 text-gray-800">{{ $video->title }}</h2>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $videos->links() }}</div>
    @else
    <p class="text-gray-400">Видео скоро появятся</p>
    @endif
</div>
@endsection
