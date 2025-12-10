@extends('layouts.app')

@section('content')


    <!-- Banner -->
    <section
      class="h-screen flex items-center justify-center text-center text-white relative overflow-hidden"
      style="
        background: linear-gradient(
            to top,
            rgba(0, 0, 0, 0.9),
            rgba(0, 0, 0, 0.2)
          ),
          url('https://lh3.googleusercontent.com/p/AF1QipPtWkDfdxIL1AZsam4HN6kDrxYyCb1af_yLE1zV=s1134-k-no')
            center/cover;
      "
    >
      <div class="fade-in visible">
        <h1 class="text-4xl md:text-5xl font-bold">
          Selamat Datang di "GalSeko"
        </h1>
        <p class="text-lg mt-4">
          Galeri Sekolah penuh kenangan, Mari isi Kenangan dan momen smkn4 bogor
          disini.
        </p>

        <div class="flex justify-center gap-6 mt-10 max-w-lg mx-auto">
          <a
            href="/upload"
            class="group inline-flex items-center gap-2 px-5 py-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-800 transition-all duration-300"
          >
            Abadikan Sekarang
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-5 h-5 transform transition-all duration-300 group-hover:translate-x-1"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 7l5 5m0 0l-5 5m5-5H6"
              />
            </svg>
          </a>
        </div>
      </div>
    </section>

    <!-- Informasi -->
    <section id="informasi" class="py-16 container mx-auto px-4">
      <h3 class="text-3xl font-bold text-center mb-12 text-blue-600">
        Informasi Aplikasi GalSeko
      </h3>

      <div class="grid md:grid-cols-2 gap-10 items-center">
        <!-- Banner Kiri -->
        <div>
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRq4RcOJiClUn81StL0xxf1KMAK8oh_U081CA&s"
            alt="GalSeko Banner"
            class="rounded-2xl shadow-lg object-cover w-full h-80"
          />
        </div>

        <!-- Informasi Kanan -->
        <div class="space-y-4">
          <div class="flex gap-2 items-end">
            <h2 class="text-3xl font-bold text-gray-800">GalSeko</h2>
            <p class="m-0 p-0 text-gray-400">Galeri Sekolah Digital</p>
          </div>

          <p class="text-lg text-gray-600 leading-relaxed">
            GalSeko adalah aplikasi galeri sekolah tempat siswa, guru, dan warga
            sekolah dapat mengunggah foto kegiatan atau momen penting. Setiap
            foto yang diunggah akan masuk ke proses verifikasi admin sebelum
            dipublikasikan di halaman galeri utama sekolah.
          </p>

          <p class="text-gray-600">
            Dengan sistem moderasi ini, seluruh foto yang tampil di website akan
            lebih terkontrol, aman, dan berkualitas, sehingga mencerminkan citra
            sekolah yang lebih profesional.
          </p>

          <div class="pt-4">
            <a
              href="/upload"
              class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-3 rounded-lg shadow-md hover:bg-blue-700 transition"
            >
              Unggah Foto Sekarang
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 8l4 4m0 0l-4 4m4-4H3"
                />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Galeri -->
    <section id="galeri" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-10 text-blue-600">
                Galeri Kami
            </h3>

            @php
                $isFew = $galeri->count() > 0 && $galeri->count() < 4;
            @endphp

            <div class="
                grid gap-4
                @if($isFew)
                    grid-cols-1 md:grid-cols-{{ $galeri->count() }} justify-items-center
                @else
                    grid-cols-2 md:grid-cols-4
                @endif
            ">

                @forelse ($galeri as $g)
                    @if($g->gambar && file_exists(public_path($g->gambar)))
                        <img src="{{ asset($g->gambar) }}" 
                            alt="Gambar" 
                            class="rounded-lg shadow-md h-full object-cover w-full max-w-xs cursor-pointer"
                            onclick="openPreview('{{ asset($g->gambar) }}', '{{ $g->judul }}', '{{ $g->tanggal }}', '{{ addslashes($g->deskripsi) }}')">
                    @else
                        <span class="text-gray-500">Tidak ada gambar</span>
                    @endif
                @empty
                    <div class="col-span-4 text-center py-10">
                        <p class="text-gray-500 text-lg font-semibold">
                            Belum ada galeri
                        </p>
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if ($galeri->count() > 0)
                <div class="mt-10">
                    {{ $galeri->links() }}
                </div>
            @endif

        </div>
    </section>
    <!-- Popup Preview -->
    <div id="previewModal"
        class="fixed inset-0 bg-black bg-opacity-60 hidden items-center w-full flex justify-center z-50 p-4">

        <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 relative animate-fadeIn">

            <!-- Tombol Close -->
            <button onclick="closePreview()" 
                    class="absolute top-3 right-3 text-gray-700 hover:text-black text-2xl">
                &times;
            </button>

            <!-- Gambar -->
            <img id="previewImage" 
                src="" 
                class="w-full max-h-[400px] object-cover rounded-lg shadow-md mb-5" />

            <!-- Judul -->
            <h2 id="previewTitle" class="text-2xl font-bold text-gray-800 mb-2"></h2>

            <!-- Tanggal -->
            <p id="previewDate" class="text-gray-500 text-sm mb-4"></p>

            <!-- Deskripsi -->
            <p id="previewDesc" class="text-gray-700 leading-relaxed"></p>
        </div>
    </div>

    <!-- Contact Us -->
    <section id="kontak" class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <h3 class="text-3xl font-bold text-center mb-10 text-blue-600">
          Kontak Kami
        </h3>

        <div class="grid md:grid-cols-2 gap-10">
          <!-- Info Kontak -->
          <div class="bg-blue-50 p-6 rounded-xl shadow-md">
            <h4 class="text-2xl font-bold mb-4">Hubungi Kami</h4>
            <p class="mb-3">
              Jika Anda memiliki pertanyaan, saran, atau membutuhkan informasi
              lebih lanjut, silakan hubungi kami melalui kontak berikut:
            </p>

            <div class="space-y-2 mt-4">
              <p>
                <strong>📍 Alamat:</strong> Jl. Raya Tajur No. 45, Kota Bogor
              </p>
              <p><strong>📞 Telepon:</strong> (0251) 1234 567</p>
              <p><strong>✉️ Email:</strong> info@smkn4bogor.sch.id</p>
            </div>
          </div>

          <!-- Form Kontak -->
          <form
            class="bg-white p-6 rounded-xl shadow-md space-y-4"
            id="form-kontak"
          >
            <div>
              <label class="font-medium">Nama</label>
              <input
                type="text"
                class="w-full border border-gray-300 mt-2 p-2 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Masukkan nama Anda"
                required
              />
            </div>

            <div>
              <label class="font-medium">Email</label>
              <input
                type="email"
                class="w-full border border-gray-300 mt-2 p-2 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Masukkan email Anda"
                required
              />
            </div>

            <div>
              <label class="font-medium">Pesan</label>
              <textarea
                class="w-full border border-gray-300 mt-2 p-2 rounded-lg focus:ring-2 focus:ring-blue-400"
                rows="5"
                placeholder="Tulis pesan Anda..."
                required
              ></textarea>
            </div>

            <button
              class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition"
            >
              Kirim Pesan
            </button>
          </form>
        </div>
      </div>
    </section>
@endsection

@section('script')
    <script>
    function openPreview(gambar, judul, tanggal, deskripsi) {
        document.getElementById('previewImage').src = gambar;
        document.getElementById('previewTitle').innerText = judul;
        document.getElementById('previewDate').innerText = "Tanggal: " + tanggal;
        document.getElementById('previewDesc').innerText = deskripsi;

        document.getElementById('previewModal').classList.remove('hidden');
    }

    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    // Klik luar modal untuk menutup
    document.getElementById('previewModal').addEventListener('click', function (e) {
        if (e.target === this) closePreview();
    });
    </script>

    <script>
      const imgInput = document.getElementById("imgInput");
      const previewImage = document.getElementById("previewImage");
      const previewContainer = document.getElementById("previewContainer");

      imgInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();

          reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove("hidden");
            previewContainer.classList.add("hidden");
          };

          reader.readAsDataURL(file);
        }
      });
    </script>
<script>
    

      const formContact = document.getElementById("form-kontak");

      formContact.addEventListener("submit", (e) => {
        e.preventDefault();

        // ambil nilai input
        const name = formContact.querySelector('input[type="text"]').value;
        const email = formContact.querySelector('input[type="email"]').value;
        const message = formContact.querySelector("textarea").value;

        // nomor whatsapp tujuan (ganti sesuai kebutuhan)
        const phone = "6287774487198";

        // format pesan ke WhatsApp
        const waText = `
Halo, saya *${name}*.
Email: ${email}

Pesan:
${message}
    `;

        // encode dan buka WhatsApp
        const url = `https://wa.me/${phone}?text=${encodeURIComponent(waText)}`;
        window.open(url, "_blank");
      });

</script>
@endsection