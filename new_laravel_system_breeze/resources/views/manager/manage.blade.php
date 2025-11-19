<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('管理ページ') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="absolute top-[7%] left-[45%] p-4 bg-[#F0EDED] rounded-lg ">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-[200px] mx-auto mt-10">
        <!-- Кнопки вкладок -->
        <div class="flex justify-center border-b border-gray-300">
            <button
                class="tab-btn px-4 py-2 text-sm font-medium border-b-2 border-blue-500 text-blue-600"
                data-target="tab-1">
                追加
            </button>
            <button
                class="tab-btn px-4 py-2 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700"
                data-target="tab-2"
            >
                情報修正
            </button>
        </div>
    </div>

    <div class="py-12">
        <div id="tab-1" class="tab-panel">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('manager.partials.add_hotel')
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('manager.partials.add_department')
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('manager.partials.add_user')
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('manager.partials.add_coordinator')
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-2" class="tab-panel hidden">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('manager.partials.change_coordinator_info')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('manager.partials.change_user_info')
                    </div>
                </div>

            </div>
        </div>
    </div>

   

</x-app-layout>
<script>
const buttons = document.querySelectorAll('.tab-btn');
const panels = document.querySelectorAll('.tab-panel');
async function departmentDefiner(id) {
    let departmentSelect = document.getElementById("department-select");
    try{
        if(id==="") return;
        const response = await fetch(`http://127.0.0.1:8000/coordinator/api/departments/${id}`);
        if (!response.ok){
            throw new Error("could not fetch recources")
        }
        const data = await response.json();
        departmentSelect.innerHTML = "";
        departmentSelect.innerHTML ="<option value=''>--デパート選んで下さい--</option>";
        Object.keys(data).forEach(key => {
            const option = document.createElement("option");
            option.value  = data[key]["id"];
            option.textContent = data[key]["name"];
            departmentSelect.appendChild(option);
        });
    }
    catch(error){
        console.log(error)
    }
}


    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.target;

            // скрываем все панели
            panels.forEach(panel => panel.classList.add('hidden'));

            // убираем активные стили у всех кнопок
            buttons.forEach(b => {
                b.classList.remove('border-blue-500', 'text-blue-600');
                b.classList.add('border-transparent', 'text-gray-500');
            });

            // показываем нужную панель
            document.getElementById(targetId).classList.remove('hidden');

            // делаем текущую кнопку активной
            btn.classList.remove('border-transparent', 'text-gray-500');
            btn.classList.add('border-blue-500', 'text-blue-600');
        });
    });
</script>
