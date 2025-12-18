<?php
/**
 * ============================================
 * Halaman Detail Project (project-detail.php)
 * ============================================
 * Menampilkan detail lengkap project berdasarkan ID
 */

require_once '../db.php';

// Ambil ID project dari query string
$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($project_id <= 0) {
    die("ID project tidak valid.");
}

// Ambil data project
$query = "SELECT id, judul, deskripsi, gambar, link, created_at, updated_at FROM projects WHERE id = $project_id LIMIT 1";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    die("Project tidak ditemukan.");
}

$project = $result->fetch_assoc();

// Tentukan path gambar jika ada
$imagePath = '';
if (!empty($project['gambar'])) {
    $possiblePath = __DIR__ . '/../uploads/' . $project['gambar'];
    if (file_exists($possiblePath)) {
        $imagePath = '../uploads/' . $project['gambar'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($project['judul']); ?> - Detail Project</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
      <div class="container">
        <a class="navbar-brand fw-bold" href="../index.php#about">Fadli Haedar Fawwaz</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../index.php#about">Home Page</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php#projects">Project</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="container my-5">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="row g-0">
          <!-- Gambar Utama -->
          <div class="col-md-6">
            <?php if (!empty($imagePath)): ?>
                <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($project['judul']); ?>" class="img-fluid h-100 object-fit-cover">
            <?php else: ?>
                <div class="img-fluid h-100 object-fit-cover">📱</div>
            <?php endif; ?>
          </div>

          <!-- Deskripsi -->
          <div class="col-md-6 d-flex flex-column justify-content-center p-4">
            <h2 class="fw-bold mb-3 text-primary"><?php echo htmlspecialchars($project['judul']); ?></h2>
            <p class="text-muted">
              <?php echo htmlspecialchars($project['deskripsi']); ?>
            </p>
          </div>
        </div>
      </div>

      <!-- Gambar Pendukung
      <div class="row mt-4 g-3">
        <div class="col-md-6">
          <img
            src="../images/Screenshot 2025-10-27 200111.png"
            class="img-fluid rounded-4 shadow-sm"
            alt="Preview Web Portfolio Section"
          />
        </div>
        <div class="col-md-6">
          <img
            src="../images/Screenshot 2025-10-27 205135.png"
            class="img-fluid rounded-4 shadow-sm"
            alt="Portfolio Layout Showcase"
          />
        </div> -->
      </div>
    </div>

    <footer class="text-center py-4 bg-white border-top mt-5">
      <p class="mb-0 text-muted">&copy; 2025 Fadli Haedar Fawwaz</p>
    </footer>   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
