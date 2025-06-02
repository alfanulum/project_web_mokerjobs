@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#FAFAFA] py-10 px-4 sm:px-8 lg:px-12 font-poppins">

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-5xl mx-auto"
                role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Logo Website -->
        <div class="mb-10 pl-10">
            <img src="{{ asset('images/LOGO.png') }}" alt="moker.jobs" class="h-9 mb-6">
        </div>

        <!-- Pembungkus Kartu -->
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 max-w-5xl mx-auto p-8 sm:p-10 space-y-8">

            <!-- Nama Perusahaan -->
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4 mt-4">
                    {{ $jobData['step4']['company_name'] ?? 'Nama Perusahaan' }}
                </h2>
            </div>

            <!-- Bagian Header -->
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <!-- Logo Perusahaan -->
                <div
                    class="flex-shrink-0 bg-[#E5F3FF] rounded-2xl w-36 h-36 md:w-44 md:h-44 flex items-center justify-center overflow-hidden">
                    @if (!empty($jobData['step4']['company_logo_image']))
                        <img src="{{ asset('storage/' . $jobData['step4']['company_logo_image']) }}"
                            alt="Logo {{ $jobData['step4']['company_name'] ?? 'Perusahaan' }}"
                            class="object-cover w-full h-full rounded-xl">
                    @else
                        <span class="text-blue-600 font-bold text-lg">LOGO</span>
                    @endif
                </div>

                <!-- Informasi Pekerjaan -->
                <div class="flex-1 space-y-2">
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ $jobData['step1']['job_name'] ?? 'Nama Pekerjaan' }}
                    </h3>
                    <div class="text-orange-600 font-medium flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $jobData['step3']['location'] ?? 'Magersari' }}
                    </div>
                    <p class="text-sm text-gray-600">
                        {{ $jobData['step4']['company_description'] ?? 'Deskripsi perusahaan...' }}
                    </p>
                </div>
            </div>

            <!-- Lencana -->
            <div class="flex flex-wrap justify-center gap-4">
                @php
                    $badges = [
                        $jobData['step1']['job_type'] ?? 'Freelance',
                        $jobData['step2']['place_work'] ?? 'Remote',
                        $jobData['step2']['education_minimal'] ?? 'S1/D4',
                    ];
                @endphp
                @foreach ($badges as $badge)
                    <span class="bg-orange-500 text-white px-5 py-2 rounded-full font-medium shadow-sm">
                        {{ $badge }}
                    </span>
                @endforeach
            </div>

            <!-- Gaji -->
            @if (!empty($jobData['step3']['salary_minimal']) || !empty($jobData['step3']['maximum_salary']))
                <div class="text-center text-xl font-bold text-gray-800">
                    @if (!empty($jobData['step3']['salary_minimal']))
                        Rp. {{ number_format($jobData['step3']['salary_minimal'], 0, ',', '.') }}
                    @endif
                    @if (!empty($jobData['step3']['maximum_salary']))
                        - Rp. {{ number_format($jobData['step3']['maximum_salary'], 0, ',', '.') }}
                    @endif
                </div>
            @endif

            <!-- Deskripsi Pekerjaan -->
            <div>
                <h4 class="text-lg font-bold text-gray-900 mb-3">Deskripsi Pekerjaan</h4>
                <div
                    class="prose max-w-none text-sm text-gray-700 [&>div]:whitespace-pre-wrap [&>p]:whitespace-pre-wrap [&>ul]:list-disc [&>ol]:list-decimal [&>ul]:pl-5 [&>ol]:pl-5 [&>li]:mb-1">
                    {!! App\Helpers\HtmlHelper::cleanJobHtml(
                        $jobData['step3']['job_description'] ?? '<p>Detail deskripsi pekerjaan...</p>',
                    ) !!}
                </div>
            </div>

            <!-- Persyaratan Pekerjaan -->
            <div class="mt-6">
                <h4 class="text-lg font-bold text-gray-900 mb-3">Persyaratan Pekerjaan</h4>
                <div
                    class="prose max-w-none text-sm text-gray-700 [&>div]:whitespace-pre-wrap [&>p]:whitespace-pre-wrap [&>ul]:list-disc [&>ol]:list-decimal [&>ul]:pl-5 [&>ol]:pl-5 [&>li]:mb-1">
                    {!! App\Helpers\HtmlHelper::cleanJobHtml(
                        $jobData['step3']['job_requirements'] ?? '<p>Detail persyaratan pekerjaan...</p>',
                    ) !!}
                </div>
            </div>

            <!-- Tabel Informasi Perusahaan -->
            <div class="bg-yellow-50 rounded-2xl p-6 mt-6">
                <table class="w-full text-sm text-gray-800">
                    @php
                        $info = [
                            'Tingkat Pengalaman' => $jobData['step2']['experience_min'] ?? 'Kurang dari 1 Tahun',
                            'Usia' => $jobData['step2']['age'] ?? '18 - 30 Tahun',
                            'Kategori' => $jobData['step1']['category_job'] ?? 'Desain & Kreatif',
                            'Industri Perusahaan' => $jobData['step4']['company_industry'] ?? 'Telekomunikasi',
                            'Alamat Perusahaan' => $jobData['step4']['company_address'] ?? 'Jalan Mojokerto',
                            'Email Perusahaan' => $jobData['step5']['email_company'] ?? 'mokerjobs@mail.com',
                            'Formulir Online' =>
                                $jobData['step5']['social_media_company'] ?? 'https://forms.gle/abc1234EFGH5678',
                            'WhatsApp' => $jobData['step5']['no_wa_company'] ?? '+6281234567890',
                        ];
                    @endphp
                    @foreach ($info as $label => $value)
                        <tr class="border-t border-gray-200">
                            <td class="font-semibold py-2 w-1/3">{{ $label }}</td>
                            <td class="py-2">
                                @if (filter_var($value, FILTER_VALIDATE_URL))
                                    <a href="{{ $value }}" target="_blank"
                                        class="text-blue-600 hover:underline">{{ $value }}</a>
                                @elseif (str_starts_with($value, 'http'))
                                    <a href="{{ $value }}" target="_blank"
                                        class="text-blue-600 hover:underline">{{ $value }}</a>
                                @elseif (str_starts_with($value, '+') || is_numeric(str_replace(['+', ' ', '-'], '', $value)))
                                    <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $value) }}" target="_blank"
                                        class="text-blue-600 hover:underline">{{ $value }}</a>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <!-- Tombol Navigasi -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6">
                <a href="{{ route('form_postjob_step5') }}"
                    class="w-full sm:w-auto bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full text-center transition">
                    ← Sebelumnya
                </a>
                <button onclick="showConfirmation()"
                    class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full transition">
                    Kirim →
                </button>

                <!-- Hidden form -->
                <form id="jobForm" action="{{ route('submit_job') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="job_data" value="{{ json_encode($jobData) }}">
                </form>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm hidden">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 shadow-xl border border-gray-200 z-10">
            <h3 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Pengiriman</h3>
            <p class="mb-6 text-sm text-gray-600">
                Apakah data yang Anda masukkan sudah benar dan ingin melanjutkan pengiriman?
            </p>
            <div class="flex justify-end gap-3">
                <button onclick="hideConfirmation()"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 text-sm">
                    Batal
                </button>
                <button onclick="submitForm()"
                    class="px-4 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600 text-sm">
                    Ya, Kirim
                </button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmation() {
            document.getElementById('confirmationModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideConfirmation() {
            document.getElementById('confirmationModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function submitForm() {
            const submitBtn = document.querySelector('#confirmationModal button[onclick="submitForm()"]');
            submitBtn.innerHTML =
                '<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengirim...</span>';
            submitBtn.disabled = true;

            document.getElementById('jobForm').submit();
        }
    </script>
@endsection
