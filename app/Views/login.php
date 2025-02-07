<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-900">
  <!-- Background with Overlay -->
  <div class="absolute inset-0 bg-cover bg-center brightness-50" style="background-image: url('<?= base_url('assets/img/sdn.jpg') ?>');"></div>

  <div class="relative z-10 w-full max-w-3xl bg-white rounded-xl shadow-lg p-8 sm:p-12 flex flex-col items-center">
    <h1 class="font-bold text-2xl sm:text-3xl mb-6 text-orange-600">Masuk Admin</h1>
    
    <div class="w-full">
      <form id="adminLoginForm" class="space-y-4">
        <div>
          <label for="email" class="block font-semibold">Email</label>
          <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Masukkan email" required>
        </div>
        <div>
          <label for="password" class="block font-semibold">Password</label>
          <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="w-full bg-orange-500 text-white font-semibold py-2 rounded-lg hover:bg-orange-600 transition duration-300">Login</button>
      </form>
    </div>

    <p class="mt-4">
      Masuk sebagai <a href="<?= base_url('login-user') ?>" class="text-orange-500 font-semibold">Anggota</a>
    </p>
  </div>

  <script>
    document.getElementById("adminLoginForm").addEventListener("submit", function(event) {
      event.preventDefault();

      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
      const requestBody = {
        username_or_email: email,
        password: password,
        user_type: "admin"
      };

      fetch("<?= base_url('api/login') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(requestBody)
      })
      .then(response => response.json())
      .then(data => {
        if (data.token) {
          localStorage.setItem("token", data.token);
          localStorage.setItem("user", JSON.stringify(data.user));
          alert("Login berhasil!");
          window.location.href = "<?= base_url('/beranda') ?>";
        } else {
          alert("Login gagal: " + (data.message || "Email atau password salah!"));
        }
      })
      .catch(error => {
        alert("Login gagal, silakan coba lagi.");
        console.error("Login error:", error);
      });
    });
  </script>
</body>
</html>