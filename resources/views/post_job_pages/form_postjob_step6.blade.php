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
            <div class="text-center text-xl font-bold text-gray-800">
                Rp. {{ number_format($jobData['step3']['salary_minimal'] ?? 0, 0, ',', '.') }} -
                Rp. {{ number_format($jobData['step3']['maximum_salary'] ?? 0, 0, ',', '.') }}
            </div>

            <!-- Deskripsi Pekerjaan -->
            <div>
                <h4 class="text-lg font-bold text-gray-900 mb-3">Deskripsi Pekerjaan</h4>
                <div class="prose max-w-none text-sm text-gray-700">
                    {!! App\Helpers\HtmlHelper::cleanJobHtml(
                        $jobData['step3']['job_description'] ?? 'Detail deskripsi pekerjaan...',
                    ) !!}
                </div>
            </div>

            <!-- Persyaratan Pekerjaan -->
            <div class="mt-6">
                <h4 class="text-lg font-bold text-gray-900 mb-3">Persyaratan Pekerjaan</h4>
                <div class="prose max-w-none text-sm text-gray-700">
                    {!! App\Helpers\HtmlHelper::cleanJobHtml(
                        $jobData['step3']['job_requirements'] ?? 'Detail persyaratan pekerjaan...',
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
                            <td class="py-2">: {{ $value }}</td>
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
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold mb-4">Konfirmasi Pengiriman</h3>
            <p class="mb-6">Apakah data yang Anda masukkan sudah benar dan ingin melanjutkan pengiriman?</p>
            <div class="flex justify-end gap-3">
                <button onclick="hideConfirmation()" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                    Batal
                </button>
                <button onclick="submitForm()" class="px-4 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600">
                    Ya, Kirim
                </button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmation() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function hideConfirmation() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        function submitForm() {
            // Show loading indicator
            const submitBtn = document.querySelector('#confirmationModal button[onclick="submitForm()"]');
            submitBtn.innerHTML = 'Mengirim...';
            submitBtn.disabled = true;

            // Submit the form
            document.getElementById('jobForm').submit();
        }
    </script>
@endsection
