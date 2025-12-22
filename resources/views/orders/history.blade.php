<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('履歴') }}
        </h2>
    </x-slot>
    <div class="py-12" >
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-7 shadow-sm sm:rounded-lg">
                {{-- <form  class="border-b border-white/10 pb-12" action="{{ route('order.store') }}" method="POST"> --}}
                    {{-- @csrf --}}
                    <table class="table-fixed w-full border p-7 border-gray-700 text-center">
                        <thead> 
                        <tr class="bg-gray-800 text-white">
                            <th class="border border-gray-700 w-1/10 p-2">
                                <label>日付</label>
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
                            <th class="border border-gray-700 w-15 p-2"></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($orders as $order)
                                <x-order-form :historyPage="true" :order="$order"/>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="my-10">
                        {{$orders->links()}}
                    </div>
                    {{-- <div class="flex justify-center w-full">
                        <button type="button" onclick="addNewRow()"  class="btn btn-primary bg-gray-800 p-2 rounded-md w-40 mt-7 text-white cursor-pointer">
                          New row
                        </button>
                    </div>
                    <div class="flex justify-center w-full">
                        <button type="submit" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer"> Send Order</button>
                    </div> --}}
                {{-- </form> --}}
            </div>
        </div>
    </div>
</x-app-layout>