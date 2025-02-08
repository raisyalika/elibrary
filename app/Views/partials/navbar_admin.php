<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Sidebar with Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
      <div class="p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
          <img src="assets/img/logo.png" alt="Logo" class="w-8 h-8">
          <div>
            <h1 class="text-lg font-semibold text-gray-800">E-Library SDN</h1>
            <p class="text-sm text-gray-600">Jelambar Baru 07</p>
          </div>
        </div>
        <button id="closeSidebar" class="md:hidden text-gray-800 text-2xl">&times;</button>
      </div>
      <nav id="nav-links" class="flex flex-col space-y-4 p-4"></nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 md:hidden absolute">
      <!-- Tombol untuk membuka sidebar di mobile -->
      <button id="openSidebar" class="md:hidden p-2 bg-white text-gray-800 rounded-md fixed top-4 left-4 z-50">☰</button>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const navLinks = document.getElementById("nav-links");
      const token = localStorage.getItem("token");
      const currentPath = window.location.pathname;

      // Generate navigasi berdasarkan token
      function generateNavLinks() {
        if (token) {
          return `
            <a href="/beranda" class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100" data-path="/beranda">Beranda</a>
            <a href="/buku" class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100" data-path="/buku">Buku</a>
            <a href="/anggota" class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100" data-path="/anggota">Anggota</a>
            <a href="#" onclick="logout()" class="flex items-center px-6 py-3 text-red-500 hover:bg-gray-100">Keluar</a>
          `;
        } else {
          return `
            <a href="login-admin" class="block px-4 py-2 text-sm font-medium text-gray-800 hover:text-gray-900">Login</a>
            <a href="register" class="block px-4 py-2 text-sm font-medium text-gray-800 hover:text-gray-900">Daftar</a>
          `;
        }
      }

      navLinks.innerHTML = generateNavLinks();

      // Set active link
      function setActiveNavLink() {
        document.querySelectorAll(".nav-item").forEach(link => {
          if (currentPath === link.getAttribute("data-path")) {
            link.classList.add("bg-gradient-to-b", "from-[#EC2C5A]", "to-[#FA7C54]", "text-white");
          } else {
            link.classList.remove("bg-gradient-to-b", "from-[#EC2C5A]", "to-[#FA7C54]", "text-white");
          }
        });
      }
      setActiveNavLink();

      // Sidebar toggle functionality
      const sidebar = document.getElementById("sidebar");
      const openSidebar = document.getElementById("openSidebar");
      const closeSidebar = document.getElementById("closeSidebar");

      openSidebar.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");
        openSidebar.classList.add("hidden");
      });

      closeSidebar.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
        openSidebar.classList.remove("hidden");
      });
    });

    function logout() {
      localStorage.removeItem("token");
      localStorage.removeItem("admin");
      window.location.href = "<?= base_url('login-user') ?>";
    }
  </script>
</body>
</html>