<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ユーザー追加') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("ホテルユーザ追加フォームです。") }}
        </p>
    </header>


    <form method="post" action="{{ route('manager.store.user') }}" class="mt-6 space-y-6">
        @csrf

        <input name ="city" type="hidden" value="{{Auth::user()->city}}">

        <div>
			<x-input-label for="hotel_id" :value="__('ホテル名')" /> 
            <select name="hotel_id" id="hotel-select" onchange="departmentDefiner(this.value)" class="mt-1 rounded-md border-gray-300">
                <option value="">ーーホテルお選び下さいーー</option>
                @foreach($hotels as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                @endforeach
			</select>
		</div>

        <div>
			<x-input-label for="dep_id" :value="__('デパート名')" /> 
			<select name="dep_id" id ="department-select" class="mt-1 rounded-md border-gray-300">
				<option value="">ーーデパートお選び下さいーー</option>
			</select>
		</div>

        <div>
            <x-input-label for="name" :value="__('お名前')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required />
            <x-input-error :messages="$errors->create_user->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('メールアドレッス')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->create_user->get('email')" class="mt-2" />
            

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
            <x-input-label for="user_logid" :value="__('ユーザー名')" />
            <x-text-input id="name" name="user_logid" type="text" class="mt-1 block w-full"  required  />
            <x-input-error :messages="$errors->create_user->get('user_logid')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('パスワード')" />
            <x-text-input id="name" name="password" type="password" class="mt-1 block w-full"  required  />
            <x-input-error :messages="$errors->create_user->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('パスワード確認')" />
            <x-text-input id="name" name="password_confirmation" type="password" class="mt-1 block w-full"   />

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
