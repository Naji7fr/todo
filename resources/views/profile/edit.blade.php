@extends('layouts.app')

@section('title', 'Mijn profiel')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Mijn profiel</h1>
        <p class="mt-1 text-slate-500 dark:text-slate-400 text-sm">Wijzig je naam, e-mail of profielfoto.</p>
    </div>

    <div class="rounded-2xl border border-slate-200 dark:border-slate-700/50 bg-white dark:bg-slate-800/50 p-6 sm:p-8 shadow-sm space-y-8">
        {{-- Profile info (name, email, photo) --}}
        <section>
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Profielgegevens</h2>
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('patch')

                <div class="flex items-center gap-6">
                    <div class="shrink-0">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="" class="w-24 h-24 rounded-full object-cover border-4 border-slate-200 dark:border-slate-600">
                        @else
                            <span class="w-24 h-24 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="avatar" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Profielfoto</label>
                        <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/jpg,image/gif" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-indigo-50 file:text-indigo-600 dark:file:bg-indigo-900/30 dark:file:text-indigo-400">
                        <p class="mt-1 text-xs text-slate-500">JPG, PNG of GIF, max. 2 MB</p>
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Naam</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn px-5 py-2.5 rounded-xl bg-indigo-500 text-white text-sm font-semibold hover:bg-indigo-600 shadow-lg shadow-indigo-500/25">Opslaan</button>
                    @if (session('status') === 'profile-updated')
                        <span class="text-sm text-emerald-600 dark:text-emerald-400">Opgeslagen.</span>
                    @endif
                </div>
            </form>
        </section>

        {{-- Password --}}
        <section class="pt-6 border-t border-slate-200 dark:border-slate-700">
            @include('profile.partials.update-password-form')
        </section>

        {{-- Delete account --}}
        <section class="pt-6 border-t border-slate-200 dark:border-slate-700">
            @include('profile.partials.delete-user-form')
        </section>
    </div>
@endsection
