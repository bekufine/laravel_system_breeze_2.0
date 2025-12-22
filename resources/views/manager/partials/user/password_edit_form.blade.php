<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('パスワード更新') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('アカウントのセキュリティを確保するため、長くてランダムなパスワードを使用していることを確認してください。') }}
        </p>
    </header>

    <form method="post" action="{{ route('user.password.update', $user->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="update_password_password" :value="__('あらたなパスワード')" />
            <x-text-input id="update_password_password" value="" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('パスワード確認')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存する') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
