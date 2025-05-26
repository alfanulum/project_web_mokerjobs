<div x-data="{
    open: false,
    selected: '{{ request('lokasi') ?? '' }}',
    selectedLabel() {
        return this.selected === '' ? 'Lokasi' : this.selected;
    },
    selectLocation(value) {
        this.selected = value;
        this.open = false;
    },
    clearSelection() {
        this.selected = '';
        this.open = false;
    }
}" class="relative w-full md:w-1/2 z-[1000]">
    <div @click="open = !open"
        class="flex items-center border border-orange-500 px-4 py-2 rounded-full cursor-pointer bg-white relative z-20">
        <img src="{{ asset('images/iconlokasi.png') }}" class="w-4 h-5 mr-2" alt="Location Icon">
        <span class="text-gray-500 opacity-70 font-semibold" x-text="selectedLabel()"></span>
        <div class="ml-auto flex items-center">
            <template x-if="selected !== ''">
                <button type="button" @click.stop="clearSelection()" class="mr-2 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </template>
            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <div x-show="open" @click.outside="open = false"
        class="absolute mt-2 w-[350px] bg-white rounded-xl shadow-xl z-50 p-4 space-y-4 max-h-96 overflow-y-auto"
        style="display: none;">
        <div class="flex justify-between items-center mb-2">
            <h3 class="text-sm font-bold text-gray-800">Pilih Lokasi</h3>
            <button type="button" @click="clearSelection()" class="text-xs text-orange-500 hover:text-orange-700">
                Hapus Pilihan
            </button>
        </div>

        <div>
            <div class="bg-orange-100 px-3 py-2 rounded-t-md">
                <h3 class="text-sm font-bold text-gray-800">Kota Mojokerto</h3>
            </div>
            <div class="bg-orange-50 px-3 py-2 space-y-2">
                <label class="flex items-center text-sm">
                    <input type="radio" name="lokasi" value="Prajurit Kulon" class="mr-2"
                        :checked="selected === 'Prajurit Kulon'" @click="selectLocation('Prajurit Kulon')">
                    Prajurit Kulon
                </label>
                <label class="flex items-center text-sm">
                    <input type="radio" name="lokasi" value="Magersari" class="mr-2"
                        :checked="selected === 'Magersari'" @click="selectLocation('Magersari')">
                    Magersari
                </label>
            </div>
        </div>

        <div>
            <div class="bg-orange-100 px-3 py-2 rounded-t-md mt-4">
                <h3 class="text-sm font-bold text-gray-800">Kabupaten Mojokerto</h3>
            </div>
            <div class="bg-orange-50 px-3 py-2 grid grid-cols-2 gap-2 text-sm">
                @php
                    $kabupatenLocations = [
                        'Dawarblandong',
                        'Kemlagi',
                        'Jetis',
                        'Gedeg',
                        'Mojoanyar',
                        'Sooko',
                        'Bangsal',
                        'Puri',
                        'Trowulan',
                        'Jatirejo',
                        'Dlanggu',
                        'Mojosari',
                        'Pungging',
                        'Kutorejo',
                        'Ngoro',
                        'Gondang',
                        'Trawas',
                        'Pacet',
                    ];
                @endphp

                @foreach ($kabupatenLocations as $loc)
                    <label class="flex items-center">
                        <input type="radio" name="lokasi" value="{{ $loc }}" class="mr-2"
                            :checked="selected === '{{ $loc }}'"
                            @click="selectLocation('{{ $loc }}')">
                        {{ $loc }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hidden input to submit the selected value -->
    <input type="hidden" name="lokasi" x-model="selected" form="search-form">
</div>
