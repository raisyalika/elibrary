<?php ?>
<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
      <div class="p-4">
        <div class="flex items-center space-x-2">
          <img src="assets/img/logo.png" alt="Logo" class="w-8 h-8">
          <div>
            <h1 class="text-lg font-semibold text-gray-800">E-Library SDN</h1>
            <p class="text-sm text-gray-600">Jelambar Baru 07</p>
          </div>
        </div>
      </div>

      <nav id="nav-links" class="flex flex-col space-y-4"></nav>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let navLinks = document.getElementById("nav-links");
      let token = localStorage.getItem("token");
      let user = localStorage.getItem("admin");
      let currentPath = window.location.pathname; // Ambil URL saat ini

      function generateNavLinks() {
        if (token) {
          // Admin is logged in
          return `
            <a href="/beranda" class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100" data-path="/beranda">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
              Beranda
            </a>

            <a href="/buku" class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100" data-path="/buku">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
              </svg>
              Buku
            </a>

            <a href="/anggota" class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100" data-path="/anggota">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
              Anggota
            </a>

            <a href="#" onclick="logout()" class="flex items-center px-6 py-3 text-red-500 hover:bg-gray-100 mt-auto">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              Keluar
            </a>
          `;
        } else {
          // User is not logged in
          return `
            <a href="login-admin" class="block px-4 py-2 text-sm font-medium text-gray-800 hover:text-gray-900">Login</a>
            <a href="register" class="block px-4 py-2 text-sm font-medium text-gray-800 hover:text-gray-900">Daftar</a>
          `;
        }
      }

      // Masukkan link ke dalam sidebar
      navLinks.innerHTML = generateNavLinks();

      // Fungsi untuk menandai halaman aktif
      function setActiveNavLink() {
        document.querySelectorAll(".nav-item").forEach(link => {
          let linkPath = link.getAttribute("data-path");
          if (currentPath === linkPath) {
            link.classList.add("bg-gradient-to-b", "from-[#EC2C5A]", "to-[#FA7C54]", "text-white");
          } else {
            link.classList.remove("bg-gradient-to-b", "from-[#EC2C5A]", "to-[#FA7C54]", "text-white");
          }
        });
      }

      // Jalankan fungsi untuk menandai halaman yang aktif
      setActiveNavLink();
    });

    // Fungsi logout
    function logout() {
      localStorage.removeItem("token");
      localStorage.removeItem("admin");
      window.location.href = "<?= base_url('login-user') ?>";
    }
  </script>
</body>
