<?php

	

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change order') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="absolute top-[6%] left-[45%] p-4 bg-[#F0EDED] rounded-lg ">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
        {{-- <div class="absolute top-[6%] left-[45%] p-4 bg-[#F0EDED] rounded-lg ">

            <p> Order is not updated<br>Please try again ❌</p>
        </div> --}}
    @endif
    {{-- <div class="absolute top-[6%] left-[45%] p-4 bg-[#F0EDED] rounded-lg " >
        <p>Order is updated! ✅ </p>
    </div> --}}
    <div class="py-12" >
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form  class="border-b border-white/10 pb-12" action="{{ route('order.update' , ['id' => $order->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <table class="table-fixed w-full border border-gray-700 text-center">
                        <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label>Event date</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Work start time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Work end time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Workers number</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Event start time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Event end time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Guests number</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Duty content</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Venue name</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Position</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Comments</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">Event style</label>
                            </th>
                            
                        </tr>
                        </thead>
                        <tbody id="tbody">
                            <x-order-form id="0" :order="$order" :changepage="true"/>
                        </tbody>
                    </table>
                    <div class="flex justify-center w-full">
                        <a href="{{route("order.history")}}">
                            <button type="button" class="btn btn-primary bg-gray-800 p-2 rounded-md w-40 mt-7 text-white cursor-pointe mx-10"> Cancel </button>
                        </a>
                        <button type="submit" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer"> Change Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- <script>
    var latest = 0;
    let tBody = document.getElementById("tbody");

    function updateRow(){
        for (let i = 0; i < 11; i++) {
            let inputClear = document.getElementById(`input${i}`);
            inputClear.value="";
        }
    }
    function deleteRow(id){
       let toDelete = document.getElementById(id);
       toDelete.remove();
    }
    function addNewRow(){
        latest ++
        var newElement = document.createElement('tr');
        newElement.setAttribute('id', latest);
        newElement.innerHTML = `
        
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][event_date]" type="date" value="{{ $formatted }}" class="w-full border-0" min="{{ $formatted }}"/>
            </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][work_start_time]"  type="time"  class="w-auto border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][work_end_time]"  type="time" class="w-auto border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][workers_number]"  type="number" class="w-full border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][event_start_time]"  type="time"  class="w-auto border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][event_end_time]"  type="time"  class="w-auto border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][guests_number]"  type="number" class="w-full border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][duty_content]"  type="text" class="w-full border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][venue_name]"  type="text" class="w-full border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][position]"  type="text" class="w-full border-0"/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][comments]
            "  type="text" class="w-full border-0" />
        </td>
        <td class="border border-gray-700 p-2">
            <button type="button" onclick="deleteRow(${latest})" class="text-red-500 cursor-pointer">削除</button>
        </td>`;
        tBody.appendChild(newElement);
    } --}}
</script>