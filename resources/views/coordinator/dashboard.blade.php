

<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ダッシボード') }}
        </h2>
    </x-slot>
    <div id="app" class="min-h-screen py-12">
        <div class=" grid h-[900px] grid-rows-[200px_auto] grid-cols-3 grid-rows-2 gap-4 max-w-7xl mx-auto px-6">
            <x-notifications :changedOrdersCount="$changedOrdersCount"/>
            <x-weather-forecast :weatherData="$weatherData"/>
            <div class="overflow-hidden col-span-3 ">
                <div class="bg-white flex overflow-hidden shadow-sm sm:rounded-lg justify-center">
                    <div class="flex flex bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 ">
                        <x-calendar/>
                        <x-day-plan/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{dd($todaysOrders);}} --}}
    {{-- <div class="py-12 grid grid-cols-3  gap-4" >
        <x-weather-forecast :weatherData="$weatherData"/>
        <x-notifications/>
        <x-greeting/>
        <x-day-plan :todaysOrders="$todaysOrders"/>
        
    </div> --}}
   
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    flatpickr("#calendar", {
        inline: true,          // календарь виден постоянно
        dateFormat: "Y-m-d",   // формат для Laravel
    });
    const orders = @json($todaysOrders);
    let dayPlanTbody = document.getElementById("day_plan_body");
    let noOrderHtml = `<tr>
                <td colspan="7" class="border border-gray-700 p-2">
                    <p class="w-full border-0">当日受注は無しです。休みましょう🤠🍻♨️</p>
                </td>
            </tr>  `
    dayPlanTbody.innerHTML = noOrderHtml;
    function showOrders (date){
        let dayHasOrders = false;
        let html = ``;
        let counter  = 0;
        orders.forEach(element => {
                if (element.event_date==date && counter<4){
                    dayPlanTbody.innerHTML = ``;
                    dayHasOrders = true;
                    html += `<tr id="${element.id}">
                        <td class="border border-gray-700 p-2">
                            <p class="w-auto border-0 my-3">${element.event_date}</p>
                        </td>

                        <td class="border border-gray-700 p-2 max-w-[200px] break-words border">
                            <p class="w-auto border-0">${element.hotel_name}</p>
                        </td>
                
                        <td class="border border-gray-700 p-2">
                            <p class="w-auto border-0">${element.name}</p>
                        </td>
                
                        <td class="border border-gray-700 p-2">
                            <p class="w-auto border-0">${element.venue_name}</p>
                        </td>

                        <td class="border border-gray-700 p-2">
                            <p class="w-auto border-0">${element.event_style}</p>
                        </td>

                        <td class="border border-gray-700 p-2">
                            <p class="w-auto border-0">${element.workers_number}</p>
                        </td>

                        <td class="border border-gray-700 p-2">
                            <p class="w-auto border-0"><a href="/coordinator/orders/${element.id}">詳しくこちら</a></p>
                        </td>
                    </tr>`;
                    counter++;
                }
        
        });
        if (!dayHasOrders){
            dayPlanTbody.innerHTML = noOrderHtml;
            
        }
        else{
            // if (counter==4){
            //     html +=`<p></p>`;
            // }
            dayPlanTbody.innerHTML = html;
        }

    }
</script>