<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ホテルデパート追加') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("ホテルのデパートメント追加フォームです。") }}
        </p>
    </header>


    <form method="post" action="{{ route('manager.store.department') }}" class="mt-6 space-y-6">
        @csrf

		<div>
			<x-input-label for="hotel" :value="__('ホテル名')" /> 
			<select name="hotel_id" class="mt-1 rounded-md border-gray-300" id="">
                <option value="">ーーホテルお選び下さいーー</option>
                @foreach($hotels as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                @endforeach
				
			</select>
		</div>

        <div>
            <x-input-label for="department" :value="__('デパート名')" /> 
            <x-text-input id="departmentselect" name="name" type="text" class="mt-1 block w-full" placeholder="例：宴会、スパ。。" required />
            <x-input-error :messages="$errors->create_department->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存する') }}</x-primary-button>

            {{-- @if (session('status') === 'profile-updated')
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
