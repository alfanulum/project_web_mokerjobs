@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-[#F9F9F9] py-12 px-4 sm:px-6 lg:px-8">
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
                        <!-- Toolbar -->
                        <div class="bg-orange-500 text-white text-sm px-4 py-1 flex flex-wrap gap-2 items-center">
                            <!-- Bold -->
                            <button type="button" onclick="formatText('job_description_editor', 'bold')"
                                class="p-1 hover:bg-orange-600" title="Tebal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8.21 13c2.106 0 3.412-1.087 3.412-2.823 0-1.306-.984-2.283-2.324-2.386v-.055a2.176 2.176 0 0 0 1.852-2.14c0-1.51-1.162-2.46-3.014-2.46H3.843V13H8.21zM5.908 4.674h1.696c.963 0 1.517.451 1.517 1.244 0 .834-.629 1.32-1.73 1.32H5.908V4.673zm0 3.633h1.89c1.384 0 2.085.935 2.085 2.239 0 1.315-1.164 2.11-2.72 2.11H5.907V8.307z" />
                                </svg>
                            </button>

                            <!-- Italic -->
                            <button type="button" onclick="formatText('job_description_editor', 'italic')"
                                class="p-1 hover:bg-orange-600" title="Miring">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.991 11.674 9.53 4.455c.123-.595.246-.71 1.347-.807l.11-.52H7.211l-.11.52c1.06.096 1.128.212 1.005.807L6.57 11.674c-.123.595-.246.71-1.346.806l-.11.52h3.774l.11-.52c-1.06-.095-1.129-.211-1.006-.806z" />
                                </svg>
                            </button>

                            <!-- Align Left -->
                            <button type="button" onclick="formatText('job_description_editor', 'justifyLeft')"
                                class="p-1 hover:bg-orange-600" title="Rata Kiri">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>

                            <!-- Center -->
                            <button type="button" onclick="formatText('job_description_editor', 'justifyCenter')"
                                class="p-1 hover:bg-orange-600" title="Rata Tengah">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>

                            <!-- Align Right -->
                            <button type="button" onclick="formatText('job_description_editor', 'justifyRight')"
                                class="p-1 hover:bg-orange-600" title="Rata Kanan">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>

                            <!-- Indent Left (←) -->
                            <button type="button" onclick="formatText('job_description_editor', 'outdent')"
                                class="p-1 hover:bg-orange-600" title="Kurangi Indentasi">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M5.854 4.146a.5.5 0 0 1 0 .708L2.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0z" />
                                    <path fill-rule="evenodd" d="M2 8.5h11a.5.5 0 0 0 0-1H2a.5.5 0 0 0 0 1z" />
                                </svg>
                            </button>

                            <!-- Indent Right (→) -->
                            <button type="button" onclick="formatText('job_description_editor', 'indent')"
                                class="p-1 hover:bg-orange-600" title="Tambah Indentasi">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.146 4.146a.5.5 0 0 1 .708 0l3.5 3.5a.5.5 0 0 1 0 .708l-3.5 3.5a.5.5 0 1 1-.708-.708L13.293 8l-3.147-3.146a.5.5 0 0 1 0-.708z" />
                                    <path fill-rule="evenodd" d="M14 8.5H3a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Editable Content -->
                        <div id="job_description_editor" contenteditable="true"
                            class="w-full border-none rounded-none h-32 p-4 bg-white shadow-inner resize-none focus:outline-none overflow-auto"
                            oninput="syncContent('job_description')">{!! old('job_description', $step3['job_description'] ?? '') !!}</div>

                        <!-- Hidden input to store the real value -->
                        <input type="hidden" id="job_description" name="job_description"
                            value="{{ old('job_description', $step3['job_description'] ?? '') }}">
                    </div>
                    @error('job_description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Requirements -->
                <div class="mb-6">
                    <label for="job_requirements" class="block font-semibold text-black mb-2">Persyaratan Pekerjaan</label>
                    <div class="relative">
                        <!-- Toolbar (same as above) -->
                        <div class="bg-orange-500 text-white text-sm px-4 py-1 flex flex-wrap gap-2 items-center">
                            <!-- Bold -->
                            <button type="button" onclick="formatText('job_requirements_editor', 'bold')"
                                class="p-1 hover:bg-orange-600" title="Tebal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M8.21 13c2.106 0 3.412-1.087 3.412-2.823 0-1.306-.984-2.283-2.324-2.386v-.055a2.176 2.176 0 0 0 1.852-2.14c0-1.51-1.162-2.46-3.014-2.46H3.843V13H8.21zM5.908 4.674h1.696c.963 0 1.517.451 1.517 1.244 0 .834-.629 1.32-1.73 1.32H5.908V4.673zm0 3.633h1.89c1.384 0 2.085.935 2.085 2.239 0 1.315-1.164 2.11-2.72 2.11H5.907V8.307z" />
                                </svg>
                            </button>

                            <!-- Italic -->
                            <button type="button" onclick="formatText('job_requirements_editor', 'italic')"
                                class="p-1 hover:bg-orange-600" title="Miring">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M7.991 11.674 9.53 4.455c.123-.595.246-.71 1.347-.807l.11-.52H7.211l-.11.52c1.06.096 1.128.212 1.005.807L6.57 11.674c-.123.595-.246.71-1.346.806l-.11.52h3.774l.11-.52c-1.06-.095-1.129-.211-1.006-.806z" />
                                </svg>
                            </button>

                            <!-- Align Left -->
                            <button type="button" onclick="formatText('job_requirements_editor', 'justifyLeft')"
                                class="p-1 hover:bg-orange-600" title="Rata Kiri">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>

                            <!-- Center -->
                            <button type="button" onclick="formatText('job_requirements_editor', 'justifyCenter')"
                                class="p-1 hover:bg-orange-600" title="Rata Tengah">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>

                            <!-- Align Right -->
                            <button type="button" onclick="formatText('job_requirements_editor', 'justifyRight')"
                                class="p-1 hover:bg-orange-600" title="Rata Kanan">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>

                            <!-- Indent Left (←) -->
                            <button type="button" onclick="formatText('job_requirements_editor', 'outdent')"
                                class="p-1 hover:bg-orange-600" title="Kurangi Indentasi">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M5.854 4.146a.5.5 0 0 1 0 .708L2.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0z" />
                                    <path fill-rule="evenodd" d="M2 8.5h11a.5.5 0 0 0 0-1H2a.5.5 0 0 0 0 1z" />
                                </svg>
                            </button>

                            <!-- Indent Right (→) -->
                            <button type="button" onclick="formatText('job_requirements_editor', 'indent')"
                                class="p-1 hover:bg-orange-600" title="Tambah Indentasi">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.146 4.146a.5.5 0 0 1 .708 0l3.5 3.5a.5.5 0 0 1 0 .708l-3.5 3.5a.5.5 0 1 1-.708-.708L13.293 8l-3.147-3.146a.5.5 0 0 1 0-.708z" />
                                    <path fill-rule="evenodd" d="M14 8.5H3a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Editable Content -->
                        <div id="job_requirements_editor" contenteditable="true"
                            class="w-full border-none rounded-none h-32 p-4 bg-white shadow-inner resize-none focus:outline-none overflow-auto"
                            oninput="syncContent('job_requirements')">{!! old('job_requirements', $step3['job_requirements'] ?? '') !!}</div>

                        <!-- Hidden input to store the real value -->
                        <input type="hidden" id="job_requirements" name="job_requirements"
                            value="{{ old('job_requirements', $step3['job_requirements'] ?? '') }}">
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
                        <label for="salary_minimal" class="block font-semibold text-black mb-1">Rentang Gaji&nbsp; <span class="mr-2 text-gray-400">  (opsional)</span></label> 

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

    <script>
        function goBack() {
            window.location.href = "{{ route('form_postjob_step2') }}";
        }
    </script>
    <script>
        function formatText(editorId, command) {
            const editor = document.getElementById(editorId);

            // Focus the editor first
            editor.focus();

            // Save current selection
            const selection = window.getSelection();
            const range = selection.getRangeAt(0);

            // Execute the command
            document.execCommand(command, false, null);

            // Restore selection if it was lost
            if (selection.rangeCount === 0) {
                selection.addRange(range);
            }

            // Sync the content
            syncContent(editorId.replace('_editor', ''));
        }

        function syncContent(fieldId) {
            const editor = document.getElementById(fieldId + '_editor');
            const hiddenInput = document.getElementById(fieldId);

            // Create a temporary div to work with
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = editor.innerHTML;

            // Remove unwanted attributes
            tempDiv.querySelectorAll('*').forEach(el => {
                Array.from(el.attributes).forEach(attr => {
                    if (attr.name.startsWith('data-')) {
                        el.removeAttribute(attr.name);
                    }
                });
            });

            // Save cleaned HTML
            hiddenInput.value = tempDiv.innerHTML;
        }
    </script>

    <script>
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

    minInput.addEventListener('input', function () {
        formatRupiah(minInput);
        validateSalaryRange();
    });

    maxInput.addEventListener('input', function () {
        formatRupiah(maxInput);
        validateSalaryRange();
    });

    // Agar nilai tetap bersih saat form submit
    document.querySelector('form').addEventListener('submit', function () {
        minInput.value = getRawValue(minInput.value);
        maxInput.value = getRawValue(maxInput.value);
    });
</script>

@endsection
