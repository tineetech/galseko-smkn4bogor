@extends('layouts.app')

@section('content')

    <section
      class="h-[80vh] flex items-center justify-center text-center text-white relative overflow-hidden"
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
        <h1 class="text-4xl md:text-5xl font-bold">Mari Upload Karya Mu</h1>
        <p class="text-lg mt-4">
          Penuhi isi galeri web ini dengan karya kenangan mu disini.
        </p>

        <!-- <div class="flex justify-center gap-6 mt-10 max-w-lg mx-auto">
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
        </div> -->
      </div>
    </section>

    <section id="upload-galeri" class="py-16 container mx-auto px-4">

      <div class="bg-white shadow-xl rounded-2xl p-8 md:p-10 max-w-4xl mx-auto">
        <form
          action="/upload-galeri"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6"
        >
        @csrf
        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800">
                {{ session('success') }}
            </div>
        @endif
          <!-- Input Gambar -->
          <div>
            <label class="block font-semibold text-gray-700 mb-2"
              >Gambar Galeri</label
            >

            <div
              class="w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-blue-500 transition relative"
            >
              <input
                type="file"
                id="imgInput"
                name="image"
                accept="image/*"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
              />

              <div
                id="previewContainer"
                class="flex flex-col items-center justify-center gap-3"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="w-12 h-12 text-gray-400"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l7 5 7-5"
                  />
                </svg>
                <p class="text-gray-500">Klik untuk memilih gambar</p>
              </div>

              <img
                id="previewImage"
                class="hidden w-full h-64 object-cover rounded-xl shadow-md mt-3"
              />
            </div>
          </div>

          <!-- Judul Galeri -->
          <div>
            <label class="block font-semibold text-gray-700 mb-2"
              >Judul Galeri</label
            >
            <input
              type="text"
              name="judul"
              placeholder="Masukkan judul galeri..."
              class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
              required
            />
          </div>

          <!-- Tanggal -->
          <div>
            <label class="block font-semibold text-gray-700 mb-2"
              >Tanggal Kegiatan</label
            >
            <input
              type="date"
              name="tanggal"
              class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
              required
            />
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="block font-semibold text-gray-700 mb-2"
              >Deskripsi</label
            >
            <textarea
              name="deskripsi"
              rows="4"
              placeholder="Masukkan deskripsi kegiatan..."
              class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
              required
            ></textarea>
          </div>

          <!-- Tombol Submit -->
          <div class="pt-4 flex justify-end">
            <button
              type="submit"
              class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition"
            >
              Unggah Sekarang
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
            </button>
          </div>
        </form>
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
            <img id="previewImage2" 
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

@endsection
@section('script')
    <script>
    function openPreview(gambar, judul, tanggal, deskripsi) {
        document.getElementById('previewImage2').src = gambar;
        console.log(gambar)
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
@endsection