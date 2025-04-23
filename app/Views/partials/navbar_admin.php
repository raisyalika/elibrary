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
    <aside id="sidebar" class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
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
    </aside>

    <!-- Main Content -->
    <div class="flex-1 relative p-6 md:ml-24">
      <button id="openSidebar" class="md:hidden p-2 bg-white text-gray-800 rounded-md fixed top-4 left-4 z-50">☰</button>
      <main id="mainContent">
        <!-- Your page content here -->
        <h2 class="text-2xl font-bold text-center">Dashboard</h2>
      </main>
    </div>
  </div>

  <!-- Logout Confirmation Modal -->
  <div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Keluar</h2>
      <p class="text-gray-600 mb-4">Apakah Anda yakin ingin keluar?</p>
      <div class="flex justify-end space-x-4">
        <button id="cancelLogout" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
        <button id="confirmLogout" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Ya, saya yakin</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.getElementById('nav-links');
      const token = localStorage.getItem('token');
      const currentPath = window.location.pathname;

      function parseJwt(token) {
        try {
          const base64Url = token.split('.')[1];
          const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
          const jsonPayload = decodeURIComponent(atob(base64).split('').map(c => '%'+('00'+c.charCodeAt(0).toString(16)).slice(-2)).join(''));
          return JSON.parse(jsonPayload);
        } catch (e) {
          console.error('Invalid token:', e);
          return null;
        }
      }

      if (!token) {
        window.location.href = '/login-user';
        return;
      }
      const decoded = parseJwt(token);
      if (!decoded || decoded.role !== 'admin') {
        window.location.href = '/login-user';
        return;
      }

      const links = [
        { href: '/beranda', label: 'Beranda' },
        { href: '/buku',    label: 'Buku'    },
        { href: '/anggota',label: 'Anggota' }
      ];

      navLinks.innerHTML = links.map(link => {
        const isActive = currentPath === link.href;
        const classes = isActive
          ? 'bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] text-white'
          : 'text-gray-600 hover:bg-gray-100';
        return `<a href="${link.href}" class="nav-item flex items-center px-6 py-3 ${classes}" data-path="${link.href}">${link.label}</a>`;
      }).join('') + `<a href="#" id="logoutButton" class="flex items-center px-6 py-3 text-red-500 hover:bg-gray-100">Keluar</a>`;

      // Sidebar toggle
      const sidebar = document.getElementById('sidebar');
      const openBtn = document.getElementById('openSidebar');
      const closeBtn = document.getElementById('closeSidebar');
      openBtn.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        openBtn.classList.add('hidden');
      });
      closeBtn.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        openBtn.classList.remove('hidden');
      });

      // Logout modal logic
      const logoutBtn = document.getElementById('logoutButton');
      const logoutModal = document.getElementById('logoutModal');
      const cancelBtn   = document.getElementById('cancelLogout');
      const confirmBtn  = document.getElementById('confirmLogout');

      logoutBtn.addEventListener('click', e => {
        e.preventDefault();
        logoutModal.classList.remove('hidden');
      });
      cancelBtn.addEventListener('click', () => logoutModal.classList.add('hidden'));
      confirmBtn.addEventListener('click', () => {
        localStorage.removeItem('token');
        window.location.href = '/login-user';
      });
    });
  </script>
</body>
</html>
