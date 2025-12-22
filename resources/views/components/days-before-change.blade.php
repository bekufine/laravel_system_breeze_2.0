@php
    $nextWednesdayTimestamp = strtotime('next Wednesday');
    $nextWednesdayDate = date('Y-m-d', $nextWednesdayTimestamp);
@endphp
<div class="overflow-hidden col-span-2 ">
    <div class="bg-white flex overflow-hidden  sm:rounded-lg h-full justify-center">
        <div class="flex flex-col  bg-white overflow-hidden  sm:rounded-lg ">
            <b class="flex  justify-center py-4">通知バー</b>
            <div class="flex flex-1 p-3 m-2 shadow-xs rounded-lg items-center justify-center">
                <p>今週変更の締め切りは {{$nextWednesdayDate}} までです❗️</p>
            </div>
        </div>
    </div>
</div>