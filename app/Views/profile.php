<script>
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("token");
    const user = JSON.parse(localStorage.getItem("user"));

    if (!token || !user || !user.id) {
        window.location.href = "<?= base_url('login_user') ?>";
        return;
    }

    const apiUrl = `http://localhost:8080/api/members/${user.id}`;

    try {
        const response = await fetch(apiUrl, {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${token}`,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) {
            throw new Error("Unauthorized or failed to fetch user data.");
        }

        const data = await response.json();

        // Populate profile fields
        document.getElementById("memberId").value = data.id_anggota;
        document.getElementById("fullName").value = data.nama_anggota;
        document.getElementById("password").value = "********"; // Masked
        document.getElementById("gender").value = data.jk_anggota === "L" ? "Laki-laki" : "Perempuan";
        document.getElementById("level").value = data.level_anggota;
        document.getElementById("address").value = data.alamat_anggota;

        // Update profile picture if available
        if (data.foto_url) {
            document.getElementById("profilePicture").src = data.foto_url;
        }

    } catch (error) {
        console.error("Error fetching user profile:", error);
        alert("Gagal mengambil data profil. Silakan coba lagi.");
    }
});

// Toggle password visibility
document.getElementById("togglePassword").addEventListener("click", function() {
    const passwordInput = document.getElementById("password");
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
});

// Handle profile picture upload
document.getElementById('editPictureBtn').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    
    input.onchange = async function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('profilePicture', file);

        const user = JSON.parse(localStorage.getItem('user')); 
        const token = localStorage.getItem('token');

        try {
            const response = await fetch(`http://localhost:8080/api/members/${user.id}/upload-profile-picture`, {
                method: "POST",
                headers: { "Authorization": `Bearer ${token}` },
                body: formData
            });

            const data = await response.json();

            if (data.foto_url) {
                document.getElementById('profilePicture').src = data.foto_url;
            } else {
                alert("Failed to upload profile picture.");
            }
        } catch (error) {
            console.error("Error uploading:", error);
        }
    };
    
    input.click();
});

</script>
