<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('受注ページ') }}
        </h2>
    </x-slot>
    {{-- @foreach($orders as $order)
        <p>{{$order->id}}</p>
        
    @endforeach --}}
    <div class="py-12" >
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form id = "orderForm" class="border-b border-white/10 p-7 rounded-lg" action="{{ url('/coordinator/orders') }}" method="POST">
                    @csrf 
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
                                    <label>デパート名</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">会場名</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">イベントスタイル</label>
                                </th>

                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">イベント開始時刻</label>
                                </th>
                                
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">イベント終了時刻</label>
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
                                    <label class="block text-base/7 font-semibold text-white">ゲスト数</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">義務内容</label>
                                </th>
                                
                                
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white">コメント</label>
                                </th>
                                <th class="border border-gray-700 w-1/10 p-2">
                                    <label class="block text-base/7 font-semibold text-white"> Done</label>
                                </th>
                                
                                
                            </tr>
                        </thead>
                        <tbody id="tbody">
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
        <div class="flex justify-center w-full">
            <button id="previewBtn" type="button" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer">確認する</button>
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
                                <label class="block text-base/7 font-semibold text-white">イベントスタイル</label>
                            </th>  
                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">始業時間</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">終業予定</label>
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
document.getElementById('confirmSubmit').addEventListener('click', () => form.submit());
</script>