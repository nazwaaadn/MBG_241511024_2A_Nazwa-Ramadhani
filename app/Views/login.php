<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
  <style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fa;
    }
    .card {
      width: 350px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .card img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin-top: -50px;
      border: 3px solid white;
    }
    h4 {
      font-size: 20px;
      margin-top: 10px;
    }
    .toggle-password {
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="card p-4 text-center">
    <div class="d-flex justify-content-center">
      <img src="<?= base_url('image/polban.png') ?>" alt="Profile">
    </div>
    <h4 class="mb-4">Login</h4>

    <?php if(session()->getFlashdata('error')): ?>
      <p class="text-danger small"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/auth/loginProcess') ?>" method="post" class="text-start">
      <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="text" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="Password" name="password">
          <span class="input-group-text toggle-password" onclick="togglePassword()">
            <i id="toggleIcon" class="bi bi-eye-slash"></i>
          </span>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>

<script>
  function togglePassword() {
    const passwordField = document.getElementById("Password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (passwordField.type === "password") {
      passwordField.type = "text";
      toggleIcon.classList.remove("bi-eye-slash");
      toggleIcon.classList.add("bi-eye");
    } else {
      passwordField.type = "password";
      toggleIcon.classList.remove("bi-eye");
      toggleIcon.classList.add("bi-eye-slash");
    }
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
