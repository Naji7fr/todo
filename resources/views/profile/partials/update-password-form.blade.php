<section>
    <header class="mb-4">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ __('Wachtwoord wijzigen') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            {{ __('Gebruik een lang, willekeurig wachtwoord om je account veilig te houden.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Huidig wachtwoord') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            @if ($errors->updatePassword->get('current_password'))
                <ul class="mt-1 text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ((array) $errors->updatePassword->get('current_password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Nieuw wachtwoord') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            @if ($errors->updatePassword->get('password'))
                <ul class="mt-1 text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ((array) $errors->updatePassword->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Wachtwoord bevestigen') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            @if ($errors->updatePassword->get('password_confirmation'))
                <ul class="mt-1 text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ((array) $errors->updatePassword->get('password_confirmation') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn px-5 py-2.5 rounded-xl bg-indigo-500 text-white text-sm font-semibold hover:bg-indigo-600 shadow-lg shadow-indigo-500/25">
                {{ __('Opslaan') }}
            </button>
            @if (session('status') === 'password-updated')
                <span class="text-sm text-emerald-600 dark:text-emerald-400">{{ __('Opgeslagen.') }}</span>
            @endif
        </div>
    </form>
</section>
