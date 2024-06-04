<div wire:loading.class="bg-red-500" class="flex w-full h-full px-3 py-7">
    <div class="w-full overflow-hidden">
        <div class="flex flex-col items-center h-full">
            <h1 class="p-4 text-xl text-center text-gray-600">Veuillez cocher les ues que vous voulez reclamer</h1>
            <div class="flex justify-around w-full item-center">
                @for ($i = 1; $i <=6; $i++)
                    <div class="flex items-center gap-1">
                        <p class="text-lg text-gray-800">S{{ $i }}</p>
                        <input id="vue-checkbox" type="checkbox" @if (in_array($i, $semesters)) checked @endif
                            value="" wire:click='addSemester({{ $i }})'
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    </div>
                @endfor
            </div>
            <div class="w-full p-3 m-2 rounded-xl bg-slate-100">
                <h1 class="mb-3 text-lg text-center text-gray-700">List des UE sélectionnées</h1>
                <div>
                    @forelse ($teachingUnitsSelected as $teachingUnit)
                        <div class="flex mt-1 item-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            <p class="text-gray-700"><strong
                                    class="mr-1 text-gray-600">{{ $teachingUnit->code }}</strong>{{ $teachingUnit->label }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center text-gray-700">Les ues séléctionées s'affichent ici</div>
                    @endforelse
                </div>
                <button
                    class="p-2 mt-1 text-blue-700 bg-blue-200 rounded-lg hover:bg-blue-700 hover:text-white">Valider</button>
            </div>
            <div class="w-full h-full p-4 overflow-y-scroll">
                <ul
                    class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @forelse ($teachingUnits as $teachingUnit)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="vue-checkbox" type="checkbox" value=""
                                    wire:click="addTeachingUnit({{ $teachingUnit->id }})"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="vue-checkbox"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2 dark:text-gray-300"><strong
                                        class="mr-2">{{ $teachingUnit->code }}</strong>{{ $teachingUnit->label }}</label>
                            </div>
                        </li>
                    @empty
                        <div class="text-xl text-center text-gray-700">Aucune ue n'a été trouvé</div>
                    @endforelse

                </ul>
            </div>
        </div>
    </div>
</div>
