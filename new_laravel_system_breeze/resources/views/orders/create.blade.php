<?php 
    $today = new DateTime();          
    $today->modify("+7 days");        
    $formatted = $today->format("Y-m-d");
    
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('受注ページ') }}
        </h2>
    </x-slot>
    <div class="py-12" >
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form  id = "orderForm" class="border-b border rounded-lg  border-white/10 pb-12" action="{{ route('order.store') }}" method="POST">    
                    @csrf
                    <table class="border rounded-lg table-fixed w-full border-gray-700 text-center">
                        <thead >
                        <tr class="bg-gray-800 text-white">
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label>イベント開催日</label>
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
                            <label class="block text-base/7 font-semibold text-white">イベント開始時刻</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">イベント終了時刻</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">ゲスト数</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">義務内容</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">会場名</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">役職</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">コメント</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                                <label class="block text-base/7 font-semibold text-white">イベントスタイル</label>
                            </th>
                            <th class="border border-gray-700 w-15 p-2"></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                            <x-order-form id="0"/>
                        </tbody>
                    </table>
                    <div class="flex justify-center w-full">
                        <button type="button" onclick="addNewRow()"  class="btn btn-primary bg-gray-800 p-2 rounded-md w-40 mt-7 text-white cursor-pointer">
                          新列
                        </button>
                    </div>
                    <div class="flex justify-center w-full">
                        <button id="previewBtn" type="button" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer">受注する</button>
                    </div>
                </form>
                <div>
                    @if ($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <dialog id="previewModal"
        class="rounded-lg p-6 bg-gray-900 text-white w-[98%] sm:w-[90%]">
        <h3 class="text-xl font-semibold mb-6 text-center">Проверьте введённые данные</h3>

        <div id="previewContent" class="overflow-x-auto">
            <!-- JS вставит сюда таблицу -->
        </div>

        <div class="mt-6 flex justify-end gap-4">
            <button id="cancelPreview"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-md">
            Исправить
            </button>
            <button id="confirmSubmit"
                    class="px-4 py-2 bg-green-600 hover:bg-green-500 rounded-md">
            Подтвердить и отправить
    </button>
  </div>
</dialog>
</x-app-layout>
<script>
    var latest = 0;
    let tBody = document.getElementById("tbody");
    //-----------
    const form = document.getElementById('orderForm');
    const modal = document.getElementById('previewModal');
    const preview = document.getElementById('previewContent');

    document.getElementById('previewBtn').addEventListener('click', () => {
    const formData = new FormData(form);

  let html = `<table class="border rounded-lg table-fixed w-full border-gray-700 text-center"> <thead>
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
                        </tr>`;

    const skipKeys = ["_token"];
    const temporaryVariable= [];

        for (const [key, value] of formData.entries()) {
            const match = key.match(/^orders\[(\d+)\]\[(.+)\]$/);
            if (!match) continue;

            const index = parseInt(match[1], 10);
            const field = match[2];

            if (!temporaryVariable[index]) temporaryVariable[index] = {};
            temporaryVariable[index][field] = value;
        }

    const orders = temporaryVariable.filter(Boolean);
    // console.log(orders);
    // console.log(orders["length"]);
    const ordersLength = Object.keys(orders).length;
    console.log(ordersLength);
    for(let i = 0; i< ordersLength; i++){
        html+='<tr>'
        for (const [key, value] of Object.entries(orders[i])) {
            
            if (["hotel_id", "user_id", "dep_id"].includes(key)) {
                continue;
            }
            html += `
            <td class="border border-gray-700 p-2">
                    <p> ${value} </p>
            </td>`;
        }
        html+='</tr>'
    }
    
    preview.innerHTML = html;
    modal.showModal();
});

document.getElementById('cancelPreview').addEventListener('click', () => modal.close());
document.getElementById('confirmSubmit').addEventListener('click', () => form.submit());

window.onload = function dateToOrderFrom() {
        const today = new Date();
        const orderWeekday = today.getDay(); 
        let daysToNextWed = (3 - orderWeekday + 7) % 7;
        if (daysToNextWed === 0) daysToNextWed = 7;
        daysToNextWed += 8; 

        const formattedDate = new Date(today.getTime() + daysToNextWed * 24 * 60 * 60 * 1000);

        const formatted =
        formattedDate.getFullYear() + '-' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(formattedDate.getDate()).padStart(2, '0');
        window.formattedDate = formatted;
};


function updateRow(){
    for (let i = 0; i < 12; i++) {
        let inputClear = document.getElementById(`input${i}`);
        inputClear.value="";
    }
}


function deleteRow(id){
    let toDelete = document.getElementById(id);
    toDelete.remove();
}

function copyRow(id){
    latest ++;
    let motherRow = document.getElementById(id);
    const inputElements = motherRow.querySelectorAll('input');
    let event_date = '';
    let event_start_time = '';
    let event_end_time = '';
    let guests_number = '';
    let duty_content = '';
    let venue_name = '';
    let comments = '';
    let event_style = '';
    // console.log(inputElements)
    // здесь нужно поработать переменными
    inputElements.forEach(element => {
        switch (element.id) {
            case 'input0':
                event_date = element.value;
                break;
            case 'input4':
                event_start_time = element.value;
                break;
            case 'input5':
                event_end_time = element.value;
                break;
            case 'input6':
                guests_number = element.value;
                break;
            case 'input7':
                duty_content = element.value;
                break;
            case 'input8':
                venue_name = element.value;
                break;
            case 'input10':
                comments = element.value;
                break;
            case 'input11':
                event_style = element.value;
                break;
        }
    });
    
    var newElement = document.createElement('tr');
    newElement.setAttribute('id', latest);
    newElement.innerHTML = `
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_date]" type="date" value="${event_date}" class="w-full border-0" min="${ formattedDate }" required/>
        </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][work_start_time]"  type="time"  class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][work_end_time]"  type="time" class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][workers_number]"  type="number" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_start_time]" value="${event_start_time}"  type="time"  class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_end_time]" value="${event_end_time}" type="time"  class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][guests_number]"  value="${guests_number}" type="number" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][duty_content]" value="${duty_content}" type="text" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][venue_name]" value="${venue_name}" type="text" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][position]"  type="text" class="w-full border-0" required/>
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][comments]" value="${comments}" type="text" class="w-full border-0" />
    <input type="hidden" name="orders[${latest}][hotel_id]" value="{{ auth()->user()->hotel_id }}">

    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_style]" value="${event_style}" type="text" class="w-full border-0" />
    <input type="hidden" name="orders[${latest}][hotel_id]" value="{{ auth()->user()->hotel_id }}">

    <input type="hidden" name="orders[${latest}][dep_id]" value="{{ auth()->user()->dep_id }}">

    <input type="hidden" name="orders[${latest}][user_id]" value="{{ auth()->user()->id }}">
    </td>
    <td class="border border-gray-700 p-2">
        <button type="button" onclick="deleteRow(${latest})" class="text-red-500 cursor-pointer">削除</button>
    </td>`;

    motherRow.after(newElement);
}

function addNewRow(){
    let tBody = document.getElementById("tbody");
    latest ++
    var newElement = document.createElement('tr');
    newElement.setAttribute('id', latest);
    newElement.innerHTML = `
    
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_date]"  id="input0" type="date" value="${formattedDate }" class="w-full border-0" min="${ formattedDate }" required/>
        </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][work_start_time]" id="input1"  type="time"  class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][work_end_time]" id="input2"  type="time" class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][workers_number]" id="input3"  type="number" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_start_time]" id="input4"  type="time"  class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_end_time]" id="input5"  type="time"  class="w-auto border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][guests_number]" id="input6"  type="number" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][duty_content]" id="input7"  type="text" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][venue_name]" id="input8"  type="text" class="w-full border-0" required/>
    </td>
    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][position]" id="input9"  type="text" class="w-full border-0" required/>
    </td>

    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][comments]" id="input10" type="text" class="w-full border-0" />
    <input type="hidden" name="orders[${latest}][hotel_id]" value="{{ auth()->user()->hotel_id }}">

    <td class="border border-gray-700 p-2">
        <input name="orders[${latest}][event_style]" id="input11" type="text" class="w-full border-0" />
    <input type="hidden" name="orders[${latest}][hotel_id]" value="{{ auth()->user()->hotel_id }}">

    <input type="hidden" name="orders[${latest}][dep_id]" value="{{ auth()->user()->dep_id }}">

    <input type="hidden" name="orders[${latest}][user_id]" value="{{ auth()->user()->id }}">
    </td>
    <td class="border border-gray-700 p-2">
        <button type="button" onclick="deleteRow(${latest})" class="text-red-500 cursor-pointer">削除</button>
        <button type="button" onclick="copyRow(${latest})" class="ml-7 border py-1 p-3 rounded-lg bg- text-blue-500 cursor-pointer">+</button>
    </td>`;
    tBody.appendChild(newElement);
}
</script>