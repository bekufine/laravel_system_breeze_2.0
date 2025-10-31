@props(['id' => null,'historyPage'=>false, 'changepage'=>false ,'order' => null, "coordinatorOrders" =>null])

@if($historyPage) 
    @php
    if (!function_exists('isChangable')) {
        function isChangable($date){
            $today = new DateTime();
            date_default_timezone_set('UTC'); 
            $orderDate = new DateTime($date) ; 
            $orderWeekday = (int)$orderDate->format('w'); 
            $daysUntilWed = ($orderWeekday - 3 + 7) % 7; // here i calculated how many days to nearest wednesday 
            if ($daysUntilWed === 0) {
                $daysUntilWed = 7;
            }  // here i did so for easier calculation
            $daysUntilWed+=6;
            $deadline = $orderDate->modify("-{$daysUntilWed} days");
            return($today < $deadline);
        }
    }
    @endphp


<tr id="{{$id}}">

    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_date]" type="date" id="input0" class="w-full border-0" value="{{$order->event_date}}" readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input  name="orders[0][work_start_time]"  id="input1" type="time"  class="w-auto border-0" value="{{$order->work_start_time}}" readonly />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][work_end_time]"  id="input2" type="time" class="w-auto border-0" value="{{$order->work_end_time}}" readonly />
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][workers_number]" id="input3" type="number" class="w-full border-0" value="{{$order->workers_number}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_start_time]" id="input4" type="time"  class="w-auto border-0" value="{{$order->event_start_time}}" readonly />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_end_time]"   id="input5" type="time"  class="w-auto border-0" value="{{$order->event_end_time}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][guests_number]" id="input6" type="number" class="w-full border-0" value="{{$order->guests_number}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][duty_content]" id="input7" type="text" class="w-full border-0" value="{{$order->duty_content}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][venue_name]"  id="input8" type="text" class="w-full border-0" value="{{$order->venue_name}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][position]"   id="input9" type="text" class="w-full border-0" value="{{$order->position}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][comments]"  id="input10" type="text" class="w-full border-0"  value="{{$order->comments}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_style]"  id="input11" type="text" class="w-full border-0"  value="{{$order->event_style}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        @if (isChangable($order->event_date))
            <a href="{{ route("order.update", ["id"=>$order->id])}}" class="button text-red-500 cursor-pointer">🔄</a>
        @endif
    </td>

</tr>
@elseif($coordinatorOrders)
<tr id="{{$order->id}}">
    
    <input type="hidden" name="orders[0][hotel_id]" value="{{ auth()->user()->hotel_id }}">

    <input type="hidden" name="orders[0][dep_id]" value="{{ auth()->user()->dep_id }}">

    <input type="hidden" name="orders[0][user_id]" value="{{ auth()->user()->id }}">

    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_date]" type="text" id="input0" class="w-full border-0 " value="{{$order->event_date}}" readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_style]"  id="input11" type="text" class="w-full border-0"  value="{{$order->hotel_name}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_style]"  id="input11" type="text" class="w-full border-0"  value="{{$order->name}}" readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[0][venue_name]"  id="input8" type="text" class="w-full border-0" value="{{$order->venue_name}}"  readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_style]"  id="input11" type="text" class="w-full border-0"  value="{{$order->event_style}}" readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_start_time]" id="input4" type="time"  class="w-auto border-0" value="{{$order->event_start_time}}"  readonly />
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_end_time]"   id="input5" type="time"  class="w-auto border-0" value="{{$order->event_end_time}}"  readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[0][position]"   id="input9" type="text" class="w-full border-0" value="{{$order->position}}"  readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input  name="orders[0][work_start_time]"  id="input1" type="time"  class="w-auto border-0" value="{{$order->work_start_time}}"  readonly />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][work_end_time]"  id="input2" type="time" class="w-auto border-0" value="{{$order->work_end_time}}"   readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][workers_number]" id="input3" type="number" class="w-full border-0" value="{{$order->workers_number}}" readonly />
    </td>
   
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][guests_number]" id="input6" type="number" class="w-full border-0" value="{{$order->guests_number}}" readonly/>
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][duty_content]" id="input7" type="text" class="w-full border-0" value="{{$order->duty_content}}"  readonly/>
    </td>
   
    <td class="border border-gray-700 p-2">
        <input name="orders[0][comments]"  id="input10" type="text" class="w-full border-0"  value="{{$order->comments}}"  readonly/>
    </td>

    <td class="border border-gray-700 p-2">
        <input class="p-2.5" id="{{"input" . $order->id}}" type="checkbox">
    </td>
    
</tr>


@elseif($changepage)
<tr id="{{$id}}">
    
    <input type="hidden" name="orders[0][hotel_id]" value="{{ auth()->user()->hotel_id }}">

    <input type="hidden" name="orders[0][dep_id]" value="{{ auth()->user()->dep_id }}">

    <input type="hidden" name="orders[0][user_id]" value="{{ auth()->user()->id }}">

    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_date]" type="date" id="input0" class="w-full border-0" value="{{$order->event_date}}" />
    </td>

    <td class="border border-gray-700 p-2">
        <input  name="orders[0][work_start_time]"  id="input1" type="time"  class="w-auto border-0" value="{{$order->work_start_time}}"  />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][work_end_time]"  id="input2" type="time" class="w-auto border-0" value="{{$order->work_end_time}}"  />
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][workers_number]" id="input3" type="number" class="w-full border-0" value="{{$order->workers_number}}" />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_start_time]" id="input4" type="time"  class="w-auto border-0" value="{{$order->event_start_time}}"  />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_end_time]"   id="input5" type="time"  class="w-auto border-0" value="{{$order->event_end_time}}" />
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][guests_number]" id="input6" type="number" class="w-full border-0" value="{{$order->guests_number}}" />
    </td>
    <td class="border border-gray-700 p-2">
        <input  name="orders[0][duty_content]" id="input7" type="text" class="w-full border-0" value="{{$order->duty_content}}" />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][venue_name]"  id="input8" type="text" class="w-full border-0" value="{{$order->venue_name}}" />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][position]"   id="input9" type="text" class="w-full border-0" value="{{$order->position}}" />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][comments]"  id="input10" type="text" class="w-full border-0"  value="{{$order->comments}}" />
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[0][event_style]"  id="input11" type="text" class="w-full border-0"  value="{{$order->event_style}}"/>
    </td>

</tr>


@else 

    @php
        $today = new DateTime();
        $todaystring = $today->format("Y/m/d");
        $orderWeekday = (int)$today->format('w');
        $daysToNextWed = (3 - $orderWeekday + 7) % 7;
        if ($daysToNextWed === 0) $daysToNextWed = 7;
        $daysToNextWed+=8;
        $formatted = (clone $today)->modify("+{$daysToNextWed} days");
        $formatted =$formatted->format("Y-m-d");
    @endphp
    <tr id="{{$id}}">
        {{-- <input type="hidden" name="orders[0][hotel_id]" value="{{ auth()->user()->hotel_id }}">

        <input type="hidden" name="orders[0][dep_id]" value="{{ auth()->user()->dep_id }}">

        <input type="hidden" name="orders[0][coor_id]" value="{{ auth()->user()->coor_id }}"> --}}

        <td class="border border-gray-700 p-2">
            <input name="orders[0][event_date]" type="date" id="input0" value="{{ $formatted }}" class="w-full border-0" min="{{ $formatted }}" required/>
        </td>
        
        <td class="border border-gray-700 p-2">
            <input  name="orders[0][work_start_time]"  id="input1" type="time"  class="w-auto border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[0][work_end_time]"  id="input2" type="time" class="w-auto border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input  name="orders[0][workers_number]" id="input3" type="number" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[0][event_start_time]" id="input4" type="time"  class="w-auto border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input class="w-full border-0" id="input5" list="swt" name="orders[0][event_end_time]" required placeholder="XX:XX"/>
            <datalist id="swt">
                <option value="S">
                <option value="W">
                <option value="T">
            </datalist>
            {{-- <input name="orders[0][event_end_time]"   id="input5" type="time"  class="w-auto border-0" required/> --}}
        </td>
        <td class="border border-gray-700 p-2">
            <input  name="orders[0][guests_number]" id="input6" type="number" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input  name="orders[0][duty_content]" id="input7" type="text" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[0][venue_name]"  id="input8" type="text" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[0][position]"   id="input9" type="text" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[0][comments]"  id="input10" type="text" class="w-full border-0" />
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[0][event_style]"  id="input11" type="text" class="w-full border-0"/>
        </td>
        <input type="hidden" name="orders[0][hotel_id]" id="input12" value="{{ auth()->user()->hotel_id }}">

        <input type="hidden" name="orders[0][dep_id]" id="input13" value="{{ auth()->user()->dep_id }}">

        <input type="hidden" name="orders[0][user_id]" id="input14" value="{{ auth()->user()->id }}">  
        {{-- changed from coor_id to user_id --}}
        <td class="border border-gray-700 p-2">
            <button type="button" onclick="updateRow()" class="text-red-500 cursor-pointer">削除</button>
            <button type="button" onclick="copyRow({{$id}})" class="ml-7 border py-1 p-3 rounded-lg bg- text-blue-500 cursor-pointer">+</button>
        </td>
        
        
    </tr>
@endif


