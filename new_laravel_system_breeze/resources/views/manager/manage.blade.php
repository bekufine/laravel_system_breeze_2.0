<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロファイル') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="absolute top-[7%] left-[45%] p-4 bg-[#F0EDED] rounded-lg ">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
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
</x-app-layout>
<script>
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
</script>
