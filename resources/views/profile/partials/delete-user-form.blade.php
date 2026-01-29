<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ __('Account verwijderen') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            {{ __('Zodra je account is verwijderd, worden alle gegevens permanent gewist. Download vooraf alles wat je wilt bewaren.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" id="delete-account-form" class="space-y-6" onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan worden gemaakt.');">
        @csrf
        @method('delete')

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Wachtwoord (ter bevestiging)') }}</label>
            <input id="password" name="password" type="password" placeholder="{{ __('Je wachtwoord') }}"
                class="input-field w-full max-w-xs px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            @if ($errors->userDeletion->get('password'))
                <ul class="mt-1 text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ((array) $errors->userDeletion->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-500 border border-transparent transition-colors">
            {{ __('Account verwijderen') }}
        </button>
    </form>
</section>
