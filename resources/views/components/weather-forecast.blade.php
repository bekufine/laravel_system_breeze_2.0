
<div class="col-span-1 ">
	<div class="bg-white grid grid-cols-2  grid-rows-4 overflow-hidden h-full shadow-sm sm:rounded-lg">
		<div class="col-span-2 flex items-center mx-auto  text-gray-900">
			<b>天気予報　</b>
		</div>
		<div class="flex justify-evenly row-span-3 flex flex-col gap-3 p-6 text-gray-900">
			<div>{{ Auth::user()->city }}:</div>
		
			<div>{{ $weatherData["weather"][0]["description"] }}</div>
			
			<div>{{"温度: " . $weatherData["main"]["temp"] . " ℃" }}</div>
		</div>

		<div class="  row-span-3 p-6 text-gray-900">    
			@php
				$weather = $weatherData["weather"][0]["main"];
			@endphp

			@switch($weather)
				@case('Rain')
					<img src="{{ asset('gifs/rain.gif') }}" alt="Rain" class="w-20 h-20">
					@break
				@case('Snow')
					<img src="{{ asset('gifs/snow.gif') }}" alt="Snow" class="w-20 h-20">
					@break
				@case('Clouds')
					<img src="{{ asset('gifs/clouds.gif') }}" alt="Clouds" class="w-20 h-20">
					@break
				@case('Clear')
					<img src="{{ asset('gifs/sun.gif') }}" alt="Clear" class="w-20 h-20">
					@break
				@case('Thunderstorm')
					<img src="{{ asset('gifs/storm.gif') }}" alt="Storm" class="w-20 h-20">
					@break
				@default
					
			@endswitch
		</div>
	</div>
</div>