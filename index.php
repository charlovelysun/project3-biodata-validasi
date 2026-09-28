<?php

$nama = $email = $umur = $alamat = "";
$errors = [];
$sukses = false;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitasi input dasar
    $nama   = trim($_POST['nama']);
    $email  = trim($_POST['email']);
    $umur   = trim($_POST['umur']);
    $alamat = trim($_POST['alamat']);

    if (empty($nama)) {
        $errors['nama'] = "Nama lengkap wajib diisi!";
    }


    if (empty($email)) {
        $errors['email'] = "Email wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid (contoh: user@domain.com)!";
    }

    if (empty($umur)) {
        $errors['umur'] = "Umur wajib diisi!";
    } elseif (!is_numeric($umur) || $umur <= 0) {
        $errors['umur'] = "Umur harus berupa angka bulat positif!";
    }


    if (empty($alamat)) {
        $errors['alamat'] = "Alamat wajib diisi!";
    }

    if (empty($errors)) {
        $sukses = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proyek 3 - Form Biodata & Validasi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        .card { max-width: 500px; margin: auto; padding: 25px; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, button { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .error-text { color: red; font-size: 13px; margin-top: 4px; display: block; }
        .alert-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .result-box { background: #f8f9fa; padding: 15px; border-left: 4px solid #28a745; margin-top: 15px; }
        button { background-color: #007bff; color: white; border: none; font-weight: bold; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="card">
    <h2>Form Biodata Siswa</h2>

    <?php if ($sukses): ?>
        <div class="alert-success">
            <strong>Berhasil!</strong> Data biodata telah memenuhi semua syarat validasi.
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($nama); ?>">
            <?php if (isset($errors['nama'])): ?>
                <span class="error-text"><?= $errors['nama']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" value="<?= htmlspecialchars($email); ?>">
            <?php if (isset($errors['email'])): ?>
                <span class="error-text"><?= $errors['email']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Umur (Tahun):</label>
            <input type="text" name="umur" value="<?= htmlspecialchars($umur); ?>">
            <?php if (isset($errors['umur'])): ?>
                <span class="error-text"><?= $errors['umur']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Alamat Lengkap:</label>
            <textarea name="alamat" rows="3"><?= htmlspecialchars($alamat); ?></textarea>
            <?php if (isset($errors['alamat'])): ?>
                <span class="error-text"><?= $errors['alamat']; ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" name="submit">Kirim Biodata</button>
    </form>

    <?php if ($sukses): ?>
        <div class="result-box">
            <h3>Data Terverifikasi:</h3>
            <p><strong>Nama:</strong> <?= htmlspecialchars($nama); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email); ?></p>
            <p><strong>Umur:</strong> <?= htmlspecialchars($umur); ?> Tahun</p>
            <p><strong>Alamat:</strong> <?= nl2br(htmlspecialchars($alamat)); ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>