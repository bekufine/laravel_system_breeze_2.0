@props(['changedOrdersCount'])
<div class="overflow-hidden col-span-2 ">
    <div class="bg-white flex overflow-hidden  sm:rounded-lg h-full justify-center">
        <div class="flex flex-col  bg-white overflow-hidden  sm:rounded-lg ">
            <b class="flex  justify-center py-4">通知バー</b>
            @if($changedOrdersCount)
            <div class="flex flex-1 p-3 m-2 shadow-xs rounded-lg items-center justify-center">
                <p>変更があった受注は<a class="text-blue-700" href="{{route("coordinator.orders")}}">{{$changedOrdersCount}}件</a>あります</p>
            </div>
            @else
                <p>変更があった受注は件あります</p>
            @endif

        </div>
    </div>
</div>