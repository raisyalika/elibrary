<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
  <div class="flex w-full h-screen bg-cover bg-center p-12" style="background-image: url('<?= base_url('assets/img/sdn.jpg') ?>');">
    <div class="flex w-full h-full">
      
      <!-- KATA-KATA -->
      <div class="w-full h-full flex flex-col items-center justify-center gap-y-10">
        <h1 class="font-bold text-[52px] text-white">Selamat Datang di E-Library SDN Jelambar Baru 07</h1>
        <p class="text-white font-semibold">Jelajahi berbagai koleksi buku yang ada di perpustakaan SDN Jelambar Baru 07. Kamu dapat membaca dan mencari buku yang kamu inginkan.</p>
      </div>

      <!-- FORM LOGIN ADMIN -->
      <div id="adminLoginForm" class="flex flex-col w-full h-full p-8 pl-40 items-center justify-center">
        <div class="flex flex-col justify-center bg-white rounded-xl text-black py-8 w-full px-10 gap-y-5">
          <h1 class="font-bold text-[24px]">Masuk Admin</h1>
          <form id="loginForm">
            <div class="mb-4">
              <label for="username" class="block text-black font-semibold mb-2">Username</label>
              <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
              <label for="password" class="block text-black font-semibold mb-2">Password</label>
              <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="w-full bg-[#FF5A1F] text-white font-semibold py-2 rounded-lg hover:bg-[#ff703c] transition duration-300">Login</button>
          </form>

          <p class="">Masuk sebagai <span id="toAnggota" class="text-[#FF5A1F] cursor-pointer">Anggota</span></p>
        </div>
      </div>

      <!-- FORM LOGIN ANGGOTA (Awalnya disembunyikan) -->
      <div id="anggotaLoginForm" class="flex flex-col w-full h-full p-8 pl-40 items-center justify-center" style="display: none;">
        <div class="flex flex-col justify-center bg-white rounded-xl text-black py-8 w-full px-10 gap-y-5">
          <h1 class="font-bold text-[24px]">Masuk</h1>
          <form id="anggotaLoginFormSubmit">
            <div class="mb-4">
              <label for="anggotaUsername" class="block text-black font-semibold mb-2">Username</label>
              <input type="text" id="anggotaUsername" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
              <label for="anggotaPassword" class="block text-black font-semibold mb-2">Password</label>
              <input type="password" id="anggotaPassword" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="w-full bg-[#FF5A1F] text-white font-semibold py-2 rounded-lg hover:bg-[#ff703c] transition duration-300">Login</button>
          </form>

          <p class="">Masuk sebagai <span id="toAdmin" class="text-[#FF5A1F] cursor-pointer">Admin</span></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Menangani klik untuk berpindah ke halaman login Anggota
    document.getElementById("toAnggota").addEventListener("click", function() {
      // Sembunyikan form login Admin dan tampilkan form login Anggota
      document.getElementById("adminLoginForm").style.display = "none";
      document.getElementById("anggotaLoginForm").style.display = "flex";
    });

    // Menangani klik untuk berpindah ke halaman login Admin
    document.getElementById("toAdmin").addEventListener("click", function() {
      // Sembunyikan form login Anggota dan tampilkan form login Admin
      document.getElementById("anggotaLoginForm").style.display = "none";
      document.getElementById("adminLoginForm").style.display = "flex";
    });

    // Menangani submit untuk login Admin
    document.getElementById("loginForm").addEventListener("submit", function(event) {
      event.preventDefault();

      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      fetch("<?= base_url('api/login') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          username: username,
          password: password
        })
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        console.log("Login berhasil:", data);
        window.location.href = "<?= base_url('dashboard') ?>";
      })
      .catch(error => {
        alert("Login gagal");
        console.error("Login error:", error);
      });
    });

    // Menangani submit untuk login Anggota
    document.getElementById("anggotaLoginFormSubmit").addEventListener("submit", function(event) {
      event.preventDefault();

      const username = document.getElementById("anggotaUsername").value;
      const password = document.getElementById("anggotaPassword").value;

      fetch("<?= base_url('api/login') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          username: username,
          password: password
        })
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        console.log("Login berhasil:", data);
        window.location.href = "<?= base_url('dashboard') ?>";
      })
      .catch(error => {
        alert("Login gagal");
        console.error("Login error:", error);
      });
    });
  </script>
</body>
</html>
