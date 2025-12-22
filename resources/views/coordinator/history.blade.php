<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('履歴ページ') }}
        </h2>
    </x-slot>
    <div class="py-12" >

        <div class =" mb-9 ml-9">
            <form action="{{route("coordinator.history")}}" method="GET" class="inline-flex items-center gap-4">

                <input type="hidden" name="filter-form" value="true"> 
                {{-- special input to give a sign --}}
                <label for="hotel">ホテル名:</label>
                <select name="hotel" id="hotel-select" onchange='departmentDefiner(this.value)' >
                    <option value="">--ホテル選んで下さい--</option>
                    @foreach($hotels as $hotel)
                        <option value="{{$hotel->id}}"  @if(request()->hotel==$hotel->id) selected @endif>{{$hotel->hotel_name}}</option>  
                    @endforeach
                </select>
                <label for="department">デパート名:</label>
                <select  name="department" id="department-select">
                    <option value="">--デパート選んで下さい--</option>
                </select>
                <label for="date">日付:</label>
                <input name="date" type="date"  id="date-select">
                <div class="inline-flex px-10 gap-7 ">
                    <button type="button" id ="clearSelectButton" onclick="clearFilterInputs()" class="bg-red-300 py-2 px-5  border rounded-lg">リセット</button>
                    <button type="submit" class="bg-green-300 py-2 px-5 border rounded-lg">検索</button>
                </div>
            </form>
        </div>
        
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div  class="border-b border-white/10 p-7 rounded-lg" >
                    <table class="table-fixed w-full border border-gray-700 text-center">
                        <thead> 
                            <tr class="bg-gray-800 text-white">
                                
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label>日付</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label>ホテル名</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label>部門名</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">会場名</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">就労形式</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">役職・ポジション</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">始業時間</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">終業時間</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">発注数</label>
                                </th>
                                
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">開宴時刻</label>
                                </th>
                                
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">終了時刻</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">ゲスト数</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">業務内容</label>
                                </th>
                                
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">コメント</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">ファイル</label>
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($history_orders as $order)
                                <x-order-form :coordinatorHistory="true" :order="$order"/>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>

            <div class="my-7">
                {{$history_orders->links()}}
            </div>
            
        </div>
    </div>
</x-app-layout>

<script>
    let hotelSelect = document.getElementById("hotel-select");
    let departmentSelect = document.getElementById("department-select");
async function departmentDefiner(id) {
    let departmentSelect = document.getElementById("department-select")
    try{
        if (id==="") return
        const response = await fetch(`http://127.0.0.1:8000/coordinator/api/departments/${id}`);
        if (!response.ok){
            throw new Error("could not fetch data");
        }
        const data = await response.json();
        departmentSelect.innerHTML = '';
        departmentSelect.innerHTML = '<option value="">--デパート選んで下さい--</option>';
        Object.keys(data).forEach(key => {
            const option = document.createElement("option");
                option.value = data[key]["id"];
                option.textContent = data[key]["name"];
                departmentSelect.appendChild(option);
        });
    }
    catch(error){
        console.error(error);
    }
    
}
function clearFilterInputs(){
        hotelSelect.selectedIndex = "";
        departmentSelect.selectedIndex = "";
    }
</script>
