<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Galeri Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      html {
        scroll-behavior: smooth;
      }
      
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn { animation: fadeIn 0.2s ease-out; }
    </style>
  </head>
  <body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <div class="w-full mt-5 fixed top-0 z-50 flex justify-center">
      <nav
        id="navbar"
        class="w-[95%] rounded-xl z-50 transition-all duration-300 text-white bg-white/10 backdrop-blur-md"
      >
        <div
          class="container cursor-pointer mx-auto px-4 py-4 flex justify-between items-center"
        >
          <div class="flex gap-4"
          onclick="window.location.href = '/'">
            <img
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeItZ8LNRBjD05grMTWt0H2M5mncveH_T1-Q&s"
              style="width: 30px"
              alt=""
            />
            <h1 class="text-2xl font-bold text-blue-600" id="logo-nav">
              GalSeko
            </h1>
          </div>
          <ul class="hidden md:flex space-x-6 font-medium">
            <li><a href="#home" class="hover:text-blue-600">Home</a></li>
            <li>
              <a href="#informasi" class="hover:text-blue-600">Informasi</a>
            </li>
            <li><a href="#galeri" class="hover:text-blue-600">Galeri</a></li>
            <li><a href="#kontak" class="hover:text-blue-600">Kontak</a></li>
            <li>
              <a
                href="/login"
                class="btn bg-blue-500 px-3 py-2 text-sm text-white m-0 rounded"
                >Login</a
              >
            </li>
          </ul>
          <button class="md:hidden" id="menuBtn">
            <span class="text-3xl">☰</span>
          </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden bg-white shadow-md md:hidden">
          <ul class="flex flex-col space-y-3 py-4 px-6">
            <li><a href="#home" class="hover:text-blue-600">Home</a></li>
            <li>
              <a href="#informasi" class="hover:text-blue-600">Informasi</a>
            </li>
            <li><a href="#galeri" class="hover:text-blue-600">Galeri</a></li>
            <li><a href="#kontak" class="hover:text-blue-600">Kontak</a></li>
            <li><a href="/login" class="btn btn-primary">Login</a></li>
          </ul>
        </div>
      </nav>
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10 mt-10">
      <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
          <!-- Identitas -->
          <div>
            <h4 class="text-xl font-bold mb-3">SMKN 4 BOGOR</h4>
            <p>Sekolah Menengah Kejuruan Negeri 4 Bogor</p>
            <p>Mencetak lulusan unggul, berkarakter, dan kompeten.</p>
          </div>

          <!-- Alamat -->
          <div>
            <h4 class="text-xl font-bold mb-3">Alamat Sekolah</h4>
            <p>Jl. Raya Tajur No. 45, Kota Bogor</p>
            <p>Jawa Barat, Indonesia</p>
            <p>Kode Pos: 16141</p>
          </div>

          <!-- Kontak -->
          <div>
            <div class="w-full max-w-full">
              <div class="relative w-full pb-[56.25%] rounded-lg overflow-hidden shadow-lg">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.049839558919!2d106.8246939!3d-6.640733399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1765354815056!5m2!1sid!2sid"
                  class="absolute top-0 left-0 w-full h-full"
                  style="border:0"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
              </div>
            </div>
          </div>
        </div>

        <div class="border-t border-white/20 mt-8 pt-4 text-center">
          <p class="text-sm">&copy; 2025 SMKN 4 Bogor By JUSTINE XI PPLG 2 2025. All rights reserved.</p>
        </div>
      </div>
    </footer>



    @yield('script')
    <script>
      const menuBtn = document.getElementById("menuBtn");
      const mobileMenu = document.getElementById("mobileMenu");

      menuBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
      });

      const navbar = document.getElementById("navbar");
      const logonav = document.getElementById("logo-nav");

      window.addEventListener("scroll", () => {
        if (window.scrollY > 80) {
          navbar.classList.remove(
            "bg-white/10",
            "text-white",
            "backdrop-blur-md"
          );
          navbar.classList.add("bg-white", "shadow-md");
          logonav.classList.add("text-blue-600");
          logonav.classList.remove("text-white");
        } else {
          navbar.classList.add("bg-white/10", "backdrop-blur-md", "text-white");
          navbar.classList.remove("bg-white", "shadow-md");
          logonav.classList.remove("text-blue-600");
          logonav.classList.add("text-white");
        }
      });

      let currentPage = 1;
      const totalPages = 5; // nanti bisa diganti dari backend

      const prevBtn = document.getElementById("prevBtn");
      const nextBtn = document.getElementById("nextBtn");
      const pageInfo = document.getElementById("pageInfo");

      function updatePagination() {
        pageInfo.textContent = `Page ${currentPage} dari ${totalPages}`;
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
      }

      prevBtn.addEventListener("click", () => {
        if (currentPage > 1) {
          currentPage--;
          updatePagination();
          // panggil AJAX fetch gambar baru di sini jika perlu
        }
      });

      nextBtn.addEventListener("click", () => {
        if (currentPage < totalPages) {
          currentPage++;
          updatePagination();
          // panggil AJAX fetch gambar baru di sini jika perlu
        }
      });

      updatePagination();
    </script>

  </body>
</html>
