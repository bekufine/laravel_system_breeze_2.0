<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('コーディネーター追加') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("コーディネーター追加フォームです。") }}
        </p>
    </header>


    <form method="post" action="{{ route('manager.store.coordinator') }}" class="mt-6 space-y-6">
        @csrf

        <input type="hidden" name="role" value="coordinator">
        <input type="hidden" name="city" value="{{Auth::user()->city}}">
        <div>
            <x-input-label for="name" :value="__('お名前')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required  />
            
        </div>

        <div>
            <x-input-label for="email" :value="__('メールアドレッス')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->create_coordinator->get('email')" class="mt-2" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="name" :value="__('ユーザー名')" />
            <x-text-input id="name" name="user_logid" type="text" class="mt-1 block w-full"  required  />
            <x-input-error :messages="$errors->create_coordinator->get('user_logid')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('パスワード')" />
            <x-text-input id="name" name="password" type="password" class="mt-1 block w-full"  required   />
            <x-input-error :messages="$errors->create_coordinator->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('パスワード確認')" />
            <x-text-input id="name" name="password_confirmation" type="password" class="mt-1 block w-full"  required  />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存する') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
