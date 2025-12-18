<?php
/**
 * ============================================
 * Halaman Home (index.php)
 * ============================================
 * Menampilkan ringkasan profil dan project terbaru
 * secara dinamis dari database
 */

// Include database connection
require_once 'db.php';

// ============================================
// Ambil Project Terbaru (Maksimal 3 Project)
// ============================================
$query_projects = "SELECT id, judul, deskripsi, gambar, link FROM projects ORDER BY created_at";
$result_projects = $conn->query($query_projects);
$projects = [];

if ($result_projects && $result_projects->num_rows > 0) {
    while ($row = $result_projects->fetch_assoc()) {
        $projects[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Portofolio Saya</title>

    <!-- ✅ Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- ✅ Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />

    <!-- ✅ CSS Tambahan -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#home">Fadli Haedar Fawwaz</a>
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

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#home">Home Page</a></li>
            <li class="nav-item"><a class="nav-link" href="#projects">Project</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>

   
    
    <section id="home" class="min-vh-100 d-flex align-items-center bg-light" data-aos="fade-up">
      <div class="container text-center">
        <img
          src="images/profilphoto.jpg" 
          alt="Foto Profil" 
          class="profile-img mb-3"
          width="150"
        />
        <h1 class="fw-bold">Fadli Haedar Fawwaz</h1>
        <p class="lead text-muted">
          an Informatics Students that interseted in web-development and mostly DESIGN 
        </p>
        <h4 class="mt-4 fw-semibold">INTEREST</h4>
        <div class="mt-3">
          <span class="badge bg-primary m-1">HTML</span>
          <span class="badge bg-success m-1">CSS</span>
          <span class="badge bg-warning text-dark m-1">JavaScript</span>
          <span class="badge bg-info text-dark m-1">Python</span>
          <span class="badge bg-secondary m-1">Photography</span>
          <span class="badge bg-info text-dark m-1">Design</span>
        </div>
      </div>
    </section>

    
    <section id="projects" class="py-5 bg-white">
      <div class="container">
        <h2 class="text-center fw-bold mb-5">What Did I Do</h2>
        <div class="row g-4">
          <?php if (!empty($projects)): ?>
          <!-- Proyek 1 -->
          <?php foreach ($projects as $project): ?>
            <?php 
              $imagePath = '';
              if (!empty($project['gambar'])) {
                  $possiblePath = __DIR__ . '/uploads/' . $project['gambar'];
                  if (file_exists($possiblePath)) {
                      $imagePath = 'uploads/' . $project['gambar'];
                  }
              }
          ?>
          <div class="col-md-4">
            <div class="card project-card">
              <?php if (!empty($imagePath)): ?>
                  <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($project['judul']); ?>" class="project-thumb">
              <?php else: ?>
                  <div class="image-placeholder">
                      📱
                  </div>
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title fw-semibold"><?php echo htmlspecialchars($project['judul']); ?></h5>
                <p class="card-text text-muted">
                 <?php 
                  // Tampilkan deskripsi dengan max 150 karakter
                  $deskripsi = htmlspecialchars($project['deskripsi']);
                  echo strlen($deskripsi) > 150 ? substr($deskripsi, 0, 150) . '...' : $deskripsi;
                  ?>
                </p>
                <a href="projek/project-detail.php?id=<?php echo $project['id']; ?>" class="btn btn-primary"
                  >Details</a
                >
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php else: ?>
          <!-- ============================================
                Pesan jika tidak ada project
                ============================================ -->
          <div class="no-data">
              <p>Tidak ada project yang tersedia saat ini.</p>
              <a href="login.php" class="btn btn-primary">Tambah Project</a>
          </div>
      <?php endif; ?>
    </section>

   
    <section id="contact" class="py-5 bg-light">
      <div class="container">
        <h2 class="text-center fw-bold mb-4">Contact Me!</h2>
        <div class="row justify-content-center">
          <div class="col-md-6">
            <form>
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Full Name"
                />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="email@gmail.com"
                />
              </div>
              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea
                  class="form-control"
                  id="message"
                  rows="4"
                  placeholder="Tell Me what you need here..."
                ></textarea>
              </div>
              <button type="submit" class="btn btn-success w-100">
                Sent
              </button>
            </form>

            <div class="text-center mt-4">
              <p class="mb-1">
                <a
                  href="mailto:fadlihaedarfawwaz@gmail.com"
                  class="text-decoration-none text-dark"
                  >📧 fadlihaedarfawwaz@gmail.com</a
                >
              </p>
              <p class="mb-1">
                <a
                  href="https://github.com/FeasT808"
                  target="_blank"
                  class="text-decoration-none text-dark"
                  >🐙 GitHub : FeasT808</a
                >
              </p>
              <p class="mb-0">
                <a
                  href="https://instagram.com/fa._dli"
                  target="_blank"
                  class="text-decoration-none text-dark"
                  >📷 Instagram : @fa._dli</a
                >
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

   
    <footer class="bg-dark text-white text-center py-3">
      <small>© 2025 Fadli Haedar Fawwaz. All rights reserved.</small>
    </footer>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, easing: 'ease-out-cubic', once: true });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
  </body>
</html>
