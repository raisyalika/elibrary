<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-900">
  <!-- Background with Overlay -->
  <div class="absolute inset-0 bg-cover bg-center brightness-50" style="background-image: url('<?= base_url('assets/img/sdn.jpg') ?>');"></div>

  <div class="relative z-10 w-full max-w-3xl bg-white rounded-xl shadow-lg p-8 sm:p-12 flex flex-col items-center">
    <h1 class="font-bold text-2xl sm:text-3xl mb-6 text-orange-600">Masuk Anggota</h1>
    
    <div class="w-full">
      <form id="userLoginForm" class="space-y-4">
        <div>
          <label for="username" class="block font-semibold">Username</label>
          <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Masukkan username" required>
        </div>
        <div>
          <label for="password" class="block font-semibold">Password</label>
          <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="w-full bg-orange-500 text-white font-semibold py-2 rounded-lg hover:bg-orange-600 transition duration-300">Login</button>
      </form>
    </div>

    <p class="mt-4">
      Masuk sebagai <a href="<?= base_url('login-admin') ?>" class="text-orange-500 font-semibold">Admin</a>
    </p>
  </div>

  <script>
    document.getElementById("userLoginForm").addEventListener("submit", function(event) {
      event.preventDefault();

      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      const requestBody = {
        username_or_email: username,
        password: password,
        user_type: "member"
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
          window.location.href = "<?= base_url('dashboard_user') ?>";
        } else {
          alert("Login gagal: " + (data.message || "Username atau password salah!"));
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