@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-poppins relative overflow-hidden">
        <div
            class="absolute top-[-100px] right-[-100px] w-[300px] h-[300px] rounded-full border-55 border-gray-300 opacity-25 pointer-events-none z-0">
        </div>

        <div class="mb-10 pl-10">
            <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-9 mb-6">
        </div>

        <!-- FORM WRAPPER -->
        <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
            <form id="main-form" method="POST" action="{{ route('store_step3') }}" x-data="{
                open: false,
                selected: '{{ old('location', $step3['location'] ?? '') }}',
                selectedLabel() {
                    return this.selected === '' ? 'Lokasi' : this.selected;
                },
                selectLocation(value) {
                    this.selected = value;
                    this.open = false;
                    $refs.hiddenLokasi.value = value;
                }
            }" novalidate>
                @csrf

                <!-- Job Description -->
                <div class="mb-6">
                    <label for="job_description" class="block font-semibold text-black mb-2">Deskripsi Pekerjaan</label>
                    <div class="relative">
                        <textarea id="job_description" name="job_description" class="hidden">
                            {{ old('job_description', $step3['job_description'] ?? '') }}
                        </textarea>
                        <div id="job_description_editor" class="ckeditor-container"></div>
                    </div>
                    @error('job_description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Requirements -->
                <div class="mb-6">
                    <label for="job_requirements" class="block font-semibold text-black mb-2">Persyaratan Pekerjaan</label>
                    <div class="relative">
                        <textarea id="job_requirements" name="job_requirements" class="hidden">
                            {{ old('job_requirements', $step3['job_requirements'] ?? '') }}
                        </textarea>
                        <div id="job_requirements_editor" class="ckeditor-container"></div>
                    </div>
                    @error('job_requirements')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-6">
                    <label class="block font-semibold text-black mb-2">Lokasi</label>
                    <div @click="open = !open"
                        class="flex items-center justify-between w-full border border-orange-400 rounded-lg px-4 py-2 bg-white cursor-pointer">
                        <span x-text="selectedLabel()" class="text-gray-700"></span>
                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="hidden" name="location" x-ref="hiddenLokasi" :value="selected" required>

                    <!-- Dropdown -->
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="mt-2 bg-white border rounded-lg shadow-lg p-4 space-y-3 max-h-96 overflow-y-auto z-50 relative">
                        <template
                            x-for="loc in ['Prajurit Kulon','Magersari','Dawarblandong','Kemlagi','Jetis','Gedeg','Mojoanyar','Sooko','Bangsal','Puri','Trowulan','Jatirejo','Dlanggu','Mojosari','Pungging','Kutorejo','Ngoro','Gondang','Trawas','Pacet']">
                            <label class="flex items-center text-sm space-x-2 cursor-pointer">
                                <input type="radio" name="lokasi_radio" :value="loc"
                                    @click="selectLocation(loc)">
                                <span x-text="loc"></span>
                            </label>
                        </template>
                    </div>
                    @error('location')
                        <p class="text-red-600 text-sm mt-1">Lokasi harus dipilih.</p>
                    @enderror
                </div>

                <!-- Salary -->
                <div class="mb-8 grid grid-cols-2 gap-4">
                    <div class="relative">
                        <label for="salary_minimal" class="block font-semibold text-black mb-1">Rentang Gaji&nbsp; <span
                                class="mr-2 text-gray-400"> (opsional)</span></label>

                        <div class="flex items-center border border-orange-400 rounded-lg px-3 py-2">
                            <span class="mr-2 text-gray-500">Rp.</span>
                            <input id="salary_minimal" type="text" name="salary_minimal"
                                class="w-full border-none outline-none" placeholder="Gaji Minimum"
                                value="{{ old('salary_minimal', $step3['salary_minimal'] ?? '') }}">
                        </div>
                    </div>
                    <div class="relative">
                        <label class="block font-semibold text-black mb-1 invisible">Gaji Maksimum</label>
                        <div class="flex items-center border border-orange-400 rounded-lg px-3 py-2">
                            <span class="mr-2 text-gray-500">Rp.</span>
                            <input id="maximum_salary" type="text" name="maximum_salary"
                                class="w-full border-none outline-none" placeholder="Gaji Maksimum"
                                value="{{ old('maximum_salary', $step3['maximum_salary'] ?? '') }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <!-- NAVIGATION BUTTONS -->
        <div class="max-w-8x1 mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="flex justify-between">
                <a href="{{ route('form_postjob_step2') }}"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    ← Sebelumnya
                </a>
                <button type="submit" form="main-form"
                    class="bg-yellow-400 hover:bg-yellow-300 text-black px-8 py-4 rounded-full text-sm font-semibold transition">
                    Selanjutnya →
                </button>
            </div>
        </div>
    </div>

    <!-- Add CKEditor script -->
    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@41.3.1/build/ckeditor.js"></script>
    <style>
        .ckeditor-container {
            min-height: 200px;
        }

        .ck-editor__editable {
            min-height: 200px;
            border: 1px solid #f59e0b !important;
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .ck-toolbar {
            border: 1px solid #f59e0b !important;
            border-bottom: none !important;
            border-radius: 0.5rem 0.5rem 0 0 !important;
            background-color: #f97316 !important;
        }

        .ck-toolbar__separator {
            background-color: #fff !important;
        }

        /* Button styling */
        .ck-button {
            color: white !important;
        }

        .ck-button:hover {
            background-color: #ea580c !important;
        }

        /* Active/selected button styling */
        .ck-button.ck-on {
            background-color: #ea580c !important;
            color: white !important;
        }

        /* Heading dropdown text color */
        .ck-heading-dropdown .ck-button__label {
            color: black !important;
        }

        /* Dropdown panel styling */
        .ck-dropdown__panel {
            background-color: white !important;
            border: 1px solid #f59e0b !important;
        }

        /* Dropdown items styling */
        .ck-list__item .ck-button {
            color: black !important;
        }

        .ck-list__item .ck-button:hover {
            background-color: #fef3c7 !important;
            color: black !important;
        }

        .hidden {
            display: none;
        }
    </style>

    <script>
        // Initialize CKEditor
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah CKEditor terload
            if (typeof ClassicEditor === 'undefined') {
                console.error('CKEditor tidak terload!');
                // Fallback ke textarea biasa
                document.querySelectorAll('.ckeditor-container').forEach(el => {
                    el.style.display = 'none';
                    const textarea = document.getElementById(el.previousElementSibling.id);
                    textarea.classList.remove('hidden');
                    textarea.style.display = 'block';
                });
                return;
            }

            const editors = [{
                    id: 'job_description_editor',
                    inputId: 'job_description',
                    placeholder: 'Masukkan deskripsi pekerjaan...'
                },
                {
                    id: 'job_requirements_editor',
                    inputId: 'job_requirements',
                    placeholder: 'Masukkan persyaratan pekerjaan...'
                }
            ];

            editors.forEach(config => {
                const container = document.querySelector(`#${config.id}`);
                const textarea = document.getElementById(config.inputId);

                // Cek jika elemen ada
                if (!container || !textarea) {
                    console.error(`Element dengan ID ${config.id} atau ${config.inputId} tidak ditemukan`);
                    return;
                }

                // Coba inisialisasi editor
                ClassicEditor.create(container, {
                        placeholder: config.placeholder,
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'underline', '|',
                                'numberedList', '|',
                                'outdent', 'indent', '|',
                                'undo', 'redo'
                            ]
                        },
                        alignment: {
                            options: ['left', 'center', 'right', 'justify']
                        }
                    })
                    .then(editor => {
                        console.log(`${config.id} berhasil diinisialisasi`, editor);

                        // Set data awal
                        editor.setData(textarea.value);

                        // Update textarea saat editor berubah
                        editor.model.document.on('change:data', () => {
                            textarea.value = editor.getData();
                        });
                    })
                    .catch(error => {
                        console.error(`Gagal inisialisasi editor ${config.id}:`, error);

                        // Fallback: tampilkan textarea asli
                        container.style.display = 'none';
                        textarea.classList.remove('hidden');
                        textarea.style.display = 'block';
                    });
            });



            // Salary input formatting
            const minInput = document.getElementById('salary_minimal');
            const maxInput = document.getElementById('maximum_salary');

            function formatRupiah(input) {
                let value = input.value.replace(/\D/g, ''); // Hanya ambil digit
                if (!value) return input.value = '';

                const formatted = parseInt(value, 10).toLocaleString('id-ID'); // Format ribuan
                input.value = formatted;
            }

            function getRawValue(formatted) {
                return formatted.replace(/\./g, '').replace(/[^0-9]/g, '');
            }

            function validateSalaryRange() {
                const min = parseInt(getRawValue(minInput.value)) || 0;
                const max = parseInt(getRawValue(maxInput.value)) || 0;

                if (min > max && max !== 0) {
                    maxInput.setCustomValidity("Gaji maksimum tidak boleh lebih kecil dari gaji minimum");
                } else {
                    maxInput.setCustomValidity("");
                }

                if (max < min && min !== 0) {
                    minInput.setCustomValidity("Gaji minimum tidak boleh lebih besar dari gaji maksimum");
                } else {
                    minInput.setCustomValidity("");
                }
            }

            minInput.addEventListener('input', function() {
                formatRupiah(minInput);
                validateSalaryRange();
            });

            maxInput.addEventListener('input', function() {
                formatRupiah(maxInput);
                validateSalaryRange();
            });

            // Agar nilai tetap bersih saat form submit
            document.querySelector('form').addEventListener('submit', function() {
                minInput.value = getRawValue(minInput.value);
                maxInput.value = getRawValue(maxInput.value);
            });
        });

        function goBack() {
            window.location.href = "{{ route('form_postjob_step2') }}";
        }
    </script>
@endsection
