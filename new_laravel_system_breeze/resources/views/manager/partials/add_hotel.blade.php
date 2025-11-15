<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ホテル追加') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("ホテル追加フォームです。") }}
        </p>
    </header>


    <form method="POST" action="{{ route('manager.store.hotel') }}" class="mt-6 space-y-6">
        @csrf
        <input name ="city" type="hidden" value="{{Auth::user()->city}}">
        <div>
            <x-input-label for="name" :value="__('ホテル名')" /> 
            <x-text-input id="name" name="hotel_name" type="text" class="mt-1 block w-full" placeholder="例：Okura Kyoto" required />
            <x-input-error :messages="$errors->create_hotel->get('hotel_name')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存する') }}</x-primary-button>
{{-- 
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif --}}
        </div>
    </form>
</section>
