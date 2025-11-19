<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ユーザー情報変化') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("ユーザーをお選びください。") }}
        </p>
    </header>


    <form method="GET" action="{{ route('user.edit') }}" class="mt-2 space-y-6">
		<select name="id" id="" required>
			<option value="">--オプション--</option>
			@foreach($users as $user)
				<option value="{{$user->id}}"  >{{$user->name}}</option>
			@endforeach
		</select>
		<div class="flex items-center gap-4">
			<x-primary-button>{{ __('修正する') }}</x-primary-button>
		</div>
    </form>  
</section>