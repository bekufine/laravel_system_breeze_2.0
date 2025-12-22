<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('受注ページ') }}
        </h2>
    </x-slot>

    @if(session('success'))
            <div class="absolute top-[6%] left-[45%] p-4 bg-[#F0EDED] rounded-lg " >
                {{-- {{ session('success') }} --}}
                <p>ご注文は履歴リストに移動されました ✅</p>
            </div>
    @endif
    @if(session('error'))
        <div class="absolute top-[6%] left-[45%] p-4 bg-[#F0EDED] rounded-lg " >
            {{-- {{ session('success') }} --}}
            <p>{{session("error")}} 🛑</p>
        </div>
    @endif
    <div class="py-12" >
        <div class =" mb-9 ml-9">
            <form action="{{route("coordinator.orders")}}" method="GET" class="inline-flex items-center gap-4">

                <input type="hidden" name="filter-form" value="true"> 
                {{-- special input to give a sign --}}
                <label for="hotel">ホテル名:</label>
                <select name="hotel" id="hotel-select" onchange='departmentDefiner(this.value)'>
                    <option value="">--ホテル選んで下さい--</option>
                    @foreach($hotels as $hotel)
                        <option value="{{$hotel->id}}" {{ old('hotel') == $hotel->id ? 'selected' : '' }}>{{$hotel->hotel_name}}</option>  
                    @endforeach
                </select>
                <label for="department">デパート名:</label>
                <select  name="department" id="department-select" :value="{{old("department")}}">
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
                <form id = "orderForm" class="border-b border-white/10 p-7 rounded-lg"  method="POST">
                    @csrf 
                    <table class="table-fixed w-full border border-gray-700 text-center">
                        <thead> 
                            <tr class="bg-gray-800 text-white">

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label>変更</label>
                                </th>
                                
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

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">チェック</label>
                                </th>
                                
                                
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {{-- {{dump(count($CoordinatorsOrders))}} --}}
                            @foreach($CoordinatorsOrders as $order)
                                <x-order-form :coordinatorOrders="true" :order="$order"/>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            <dialog id="previewModal"
                class="rounded-lg p-6 bg-gray-900 text-white w-[98%] sm:w-[90%]">
                <h3 class="text-xl font-semibold mb-6 text-center"></h3>
        
                <div id="previewContent" class="overflow-x-auto">
                    <!-- JS вставит сюда таблицу -->
                </div>
            
                    <div class="mt-6 flex justify-end gap-4">
                        <button id="cancelPreview"
                                class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-md">
                        修正
                        </button>
                        <button id="confirmSubmit"
                                class="px-4 py-2 bg-green-600 hover:bg-green-500 rounded-md">
                        確認する
                        </button>
                    </div>
            </dialog>
            </div>
            
        </div>
        <div class="flex justify-center w-full gap-12">
            <button  form="orderForm" id="previewBtn" type="button" formaction="{{ route('coordinator.store') }}" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer">確認する</button>
            <button form="orderForm" type="submit" formaction="{{ route('coordinator.export') }}" class="btn btn-primary bg-gray-800 text-white p-2 rounded-md w-40 mt-7 cursor-pointer">Excel形式で<br>ダウンロード</button>
        </div> 
        <div class="my-10">
            {{$CoordinatorsOrders->links()}}
        </div>
    </div>

</x-app-layout>

<script>
    const form = document.getElementById('orderForm');
    const preview = document.getElementById('previewContent');
    const modal = document.getElementById('previewModal');
    const hotelSelect = document.getElementById("hotel-select");
    const departmentSelect = document.getElementById("department-select");

    
    document.getElementById('previewBtn').addEventListener('click', () => {
        const formData = new FormData(form);
        let html = `<table class="border rounded-lg table-fixed w-full border-gray-700 text-center"> <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label>日付</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label>ホテル名</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label>デパート名</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">会場名</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">就労形式</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">役職</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">作業開始時刻</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">作業終了時刻</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">労働者数</label>
                                </th>   
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">始業時間</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">終業予定</label>
                                </th>
                                
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">ゲスト数</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">義務内容</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">コメント</label>
                                </th>
                            </tr>`;


        formData.forEach((value, key) => {
            if (key !== '_token') {
                html+='<tr>';
                let trelement = document.getElementById(value);
                const pElements = trelement.querySelectorAll("p");
                pElements.forEach(element => {
                    html += `
                    <td class="border border-gray-700 p-2">
                            <p class="break-words" >${element.innerHTML}</p>
                    </td>`;
                });
                html+='</tr>'
        }
        });
        
        preview.innerHTML = html;
        modal.showModal();
    });
    document.getElementById('cancelPreview').addEventListener('click', () => {
        modal.close();
        document.body.classList.remove('overflow-hidden');
    });
    async function departmentDefiner(id){
        let departmentSelect = document.getElementById("department-select")
        try{
            if (id==="") return;
            const response = await fetch(`http://127.0.0.1:8000/coordinator/api/departments/${id}`)
            if (!response.ok){
                throw new Error("could not fetch resurces")
            }
            const data = await response.json();
            departmentSelect.innerHTML = '';
            departmentSelect.innerHTML = '<option value="">--デパート選んで下さい--</option>';
            Object.keys(data).forEach(key=>{
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
    document.getElementById('confirmSubmit').addEventListener('click', () => form.submit());
</script>