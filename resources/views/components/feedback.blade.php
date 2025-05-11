<section class="px-6 py-25 bg-[#f8f8f8] min-h-screen">
    <div class="container mx-auto flex flex-wrap items-center justify-between">
        <div class="w-full md:w-1/2 mb-8">
            <h2 class="text-orange-500 text-4xl font-bold mb-4">Feedback dan Saran</h2>
            <p class="text-gray-600 mb-6">Beritahu kami pendapat Anda! Kami siap mendengarkan dan menjadikan website ini lebih baik bagi Anda.</p>
            <form action="/submit-feedback" method="POST" class="space-y-4">
                @csrf
                <div class="flex gap-4">
                    <input type="text" name="name" placeholder="Nama" class="w-3/5 p-3 border-2 border-orange-400 rounded-full bg-white focus:outline-none text-sm">
                    <input type="email" name="email" placeholder="E-mail" class="w-3/5 p-3 border-2 border-orange-400 rounded-full bg-white focus:outline-none text-sm">
                </div>
                <textarea name="message" rows="6" placeholder="Tuliskan feedback dan saran anda disini." class="w-full p-3 border-2 border-orange-400 rounded-3xl bg-white focus:outline-none text-sm"></textarea>
                <button type="submit" class="mt-6 w-full bg-orange-500 text-white py-3 rounded-full hover:bg-orange-600 transition">Kirim</button>
            </form>
        </div>
        <div class="w-full md:w-1/2 flex items-center justify-center">
            <img src="{{ asset('images/feedbackicon.png') }}" alt="Illustration" class="w-80 md:w-110">
        </div>
    </div>
</section>