@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#FAFAFA] py-10 px-4 sm:px-8 lg:px-12" x-data="{ showApplyModal: false }">

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
                <h4 class="text-lg font-bold text-gray-900 mb-1">Deskripsi Pekerjaan</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $jobData['step3']['job_description'] ?? 'Detail deskripsi pekerjaan...' }}
                </p>
            </div>

            <!-- Persyaratan Pekerjaan -->
            <div>
                <h4 class="text-lg font-bold text-gray-900 mb-1">Persyaratan Pekerjaan</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $jobData['step3']['job_requirements'] ?? 'Detail persyaratan pekerjaan...' }}
                </p>
            </div>

            <!-- Tabel Informasi Perusahaan -->
            <div class="bg-yellow-50 rounded-2xl p-6">
                <table class="w-full text-sm text-gray-800">
                    @php
                        $info = [
                            'Tingkat Pengalaman' => $jobData['step2']['experience_min'] ?? 'Kurang dari 1 Tahun',
                            'Usia' => $jobData['step2']['age'] ?? '18 - 30 Tahun',
                            'Kategori' => $jobData['step1']['category_job'] ?? 'Desain & Kreatif',
                            'Industri Perusahaan' => $jobData['step4']['company_industry'] ?? 'Telekomunikasi',
                            'Alamat Perusahaan' => $jobData['step4']['company_address'] ?? 'Jalan Mojokerto',
                            'Formulir Online' =>
                                $jobData['step5']['social_media_company'] ?? 'https://forms.gle/abc1234EFGH5678',
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
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
                <a href="{{ url()->previous() }}"
                    class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-black font-semibold px-6 py-3 rounded-full text-center transition">
                    ← Kembali
                </a>

                <div class="flex gap-4">
                    <button @click="showApplyModal = true"
                        class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full transition">
                        Lamar Sekarang
                    </button>

                    <button onclick="shareJob()"
                        class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-full transition">
                        <i class="fas fa-share-alt mr-2"></i> Bagikan
                    </button>
                </div>
            </div>
        </div>

        <!-- Apply Now Modal -->
        <div x-cloak x-show="showApplyModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.away="showApplyModal = false"
                class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 mx-4 sm:mx-auto relative">
                <!-- Modal Header -->
                <div class="flex items-start space-x-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Lamar
                            {{ $jobData['step1']['job_name'] ?? 'Pekerjaan Ini' }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Hubungi perusahaan langsung menggunakan salah satu metode
                            berikut:</p>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="space-y-3">
                    <a href="mailto:{{ $jobData['step5']['email_company'] }}"
                        class="flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        Email: {{ $jobData['step5']['email_company'] }}
                    </a>
                    <a href="https://wa.me/{{ $jobData['step5']['no_wa_company'] }}"
                        class="flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium bg-green-600 text-white hover:bg-green-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        WhatsApp: {{ $jobData['step5']['no_wa_company'] }}
                    </a>
                </div>

                <!-- Tombol Tutup -->
                <div class="mt-5 text-right">
                    <button @click="showApplyModal = false"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm font-medium text-gray-700 transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>


        <script>
            function shareJob() {
                if (navigator.share) {
                    navigator.share({
                            title: '{{ $jobData['step1']['job_name'] }} di {{ $jobData['step4']['company_name'] }}',
                            text: 'Lihat lowongan pekerjaan ini di MokerJobs',
                            url: window.location.href,
                        })
                        .then(() => console.log('Berhasil berbagi'))
                        .catch((error) => console.log('Error sharing:', error));
                } else {
                    // Fallback for browsers that don't support Web Share API
                    const shareUrl = `whatsapp://send?text=Lihat lowongan pekerjaan ini: ${window.location.href}`;
                    window.open(shareUrl, '_blank');
                }
            }
        </script>
    @endsection
