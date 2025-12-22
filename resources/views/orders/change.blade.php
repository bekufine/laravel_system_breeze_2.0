<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('発注変化') }}
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
                <form  class="border-b border-white/10 p-7" action="{{ route('order.update' , ['order' => $order->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <table class="table-fixed w-full border border-gray-700 text-center">
                        <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="border border-gray-700 w-1/10 p-2">
                                <label>日付</label>
                            </th>

                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">会場名</label>
                            </th>

                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">イベントスタイル</label>
                            </th>

                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">開始時刻</label>
                            </th>

                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">終了時刻</label>
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
                            <x-order-form id="0" :order="$order" :changepage="true"/>
                        </tbody>
                    </table>
                    <div class="flex justify-center w-full">
                        <a href="{{route("order.history")}}">
                            <button type="button" class="btn btn-primary bg-gray-800 p-2 rounded-md w-40 mt-7 text-white cursor-pointe mx-10"> キャンセル </button>
                        </a>
                        <button type="submit" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer">変化する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
</script>