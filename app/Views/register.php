<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Anggota</title>
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
  <div class="flex w-full h-screen bg-cover bg-top p-12" style="background-image: url('<?= base_url('assets/img/LP_Admin.jpg') ?>');">
    <div class="flex w-full h-full">

      <!-- KATA-KATA -->
      <div class="w-full h-full flex flex-col items-center justify-center gap-y-10">
        <h1 class="font-bold text-[52px] text-white">Selamat Datang di E-Library SDN Jelambar Baru 07</h1>
        <p class="text-white font-semibold">Daftar untuk menjadi anggota perpustakaan dan nikmati akses buku-buku yang tersedia.</p>
      </div>

      <!-- FORM REGISTER -->
      <div class="flex flex-col w-full h-full p-8 pl-40 items-center justify-center">
        <div class="flex flex-col justify-center bg-white rounded-xl text-black py-8 w-full px-10 gap-y-5">
          <h1 class="font-bold text-[24px]">Pendaftaran Anggota</h1>
          <form id="registerForm">
            <div class="mb-4">
              <label for="nama_anggota" class="block text-black font-semibold mb-2">Nama Anggota</label>
              <input type="text" id="nama_anggota" name="nama_anggota" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="mb-4">
              <label for="username" class="block text-black font-semibold mb-2">Username</label>
              <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
              <label for="password" class="block text-black font-semibold mb-2">Password</label>
              <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan password" required>
            </div>
            <div class="mb-4">
              <label for="jk_anggota" class="block text-black font-semibold mb-2">Jenis Kelamin</label>
              <select id="jk_anggota" name="jk_anggota" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <div class="mb-4">
              <label for="level_anggota" class="block text-black font-semibold mb-2">Level Ang
                            <input type="text" id="level_anggota" name="level_anggota" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan kelas" required>
            </div>
            <div class="mb-4">
              <label for="alamat_anggota" class="block text-black font-semibold mb-2">Alamat Anggota</label>
              <input type="text" id="alamat_anggota" name="alamat_anggota" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan alamat lengkap" required>
            </div>
            <button type="submit" class="w-full bg-[#FF5A1F] text-white font-semibold py-2 rounded-lg hover:bg-[#ff703c] transition duration-300">Daftar</button>
          </form>

          <p class="font-semibold">Sudah memiliki akun? <a href="login" class="text-[#FF5A1F]">Login di sini</a></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("registerForm").addEventListener("submit", function(event) {
      event.preventDefault();

      const nama_anggota = document.getElementById("nama_anggota").value;
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;
      const jk_anggota = document.getElementById("jk_anggota").value;
      const level_anggota = document.getElementById("level_anggota").value;
      const alamat_anggota = document.getElementById("alamat_anggota").value;

      // Menggunakan Fetch API untuk mengirim request register
      fetch("<?= base_url('api/register') ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          nama_anggota: nama_anggota,
          username: username,
          password: password,
          jk_anggota: jk_anggota,
          level_anggota: level_anggota,
          alamat_anggota: alamat_anggota
        })
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        console.log("Register berhasil:", data);
        // Redirect ke halaman login setelah registrasi sukses
        window.location.href = "login.html";
      })
      .catch(error => {
        alert("Pendaftaran gagal");
        console.error("Register error:", error);
      });
    });
  </script>
</body>
</html>
