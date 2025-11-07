<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('履歴ページ') }}
        </h2>
    </x-slot>
    <div class="py-12" >
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
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($orders as $order)
                                <x-order-form :coordinatorHistory="true" :order="$order"/>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>

            <div class="my-7">
                {{$orders->links()}}
            </div>
            
        </div>
    </div>
</x-app-layout>
