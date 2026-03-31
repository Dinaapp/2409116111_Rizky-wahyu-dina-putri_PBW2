<?php
require 'koneksi.php';

// Ambil semua data dari database
$profile      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profile WHERE id = 1"));
$skillsTech   = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM skills WHERE category = 'technical' ORDER BY id"), MYSQLI_ASSOC);
$skillsSoft   = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM skills WHERE category = 'soft' ORDER BY id"),      MYSQLI_ASSOC);
$experiences  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM experiences ORDER BY id"),  MYSQLI_ASSOC);
$certificates = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM certificates ORDER BY id"), MYSQLI_ASSOC);
mysqli_close($conn);

$nameParts = explode(' ', trim($profile['name']));
$heroLine1 = $nameParts[0] . ' ' . ($nameParts[1] ?? '');
$heroLine2 = implode(' ', array_slice($nameParts, 2));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio | <?= htmlspecialchars($profile['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="app">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top glass-nav">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#"><?= htmlspecialchars($profile['name']) ?></a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-tabs ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" :class="{ active: currentSection === 'home' }"
                        aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{ active: currentSection === 'about' }"
                        href="#about">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{ active: currentSection === 'certificates' }"
                        href="#certificates">Certificates</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section Home (Hero) -->
    <section id="home" class="vh-100 d-flex align-items-center justify-content-center position-relative overflow-hidden">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
        <div class="container text-center z-2">
            <div class="hero-text-wrapper">
                <p :class="heroClass('hero-eyebrow')">Hello, I'm</p>
                <h1 :class="heroClass('hero-name')">
                    <?= htmlspecialchars($heroLine1) ?><br>
                    <span class="hero-name-accent"><?= htmlspecialchars($heroLine2) ?></span>
                </h1>
                <p :class="heroClass('hero-subtitle')"><?= htmlspecialchars($profile['hero_subtitle']) ?></p>
            </div>
            <a href="#about" :class="heroClass('btn explore-btn mt-4')">
                <span>Explore</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12l7 7 7-7"/>
                </svg>
            </a>
        </div>
    </section>

</div><!-- /#app -->


<!-- Section About Me -->
<section id="about" class="py-5 section-pad">
    <div class="container">
        <h2 class="section-title text-center mb-5">About Me</h2>

        <!-- Foto + Deskripsi -->
        <div class="about-layout position-relative mb-5">

            <div class="about-desc-left">
                <p class="about-desc-label">Who I Am</p>
                <h3 class="about-desc-title"><?= htmlspecialchars($profile['who_i_am_title']) ?></h3>
                <p class="about-desc-text"><?= htmlspecialchars($profile['who_i_am_desc1']) ?></p>
                <p class="about-desc-text"><?= htmlspecialchars($profile['who_i_am_desc2']) ?></p>
            </div>

            <!-- Foto Profil -->
            <div class="about-photo-center">
                <div class="photo-ring">
                    <div class="photo-inner">
                        <img src="<?= htmlspecialchars($profile['photo']) ?>"
                            alt="<?= htmlspecialchars($profile['name']) ?>"
                            class="profile-photo"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div class="photo-placeholder" style="display:none">
                            <span>📷</span><small>Foto Kamu</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-desc-right">
                <p class="about-desc-label">What I Do</p>
                <h3 class="about-desc-title"><?= htmlspecialchars($profile['what_i_do_title']) ?></h3>
                <p class="about-desc-text"><?= htmlspecialchars($profile['what_i_do_desc1']) ?></p>
                <p class="about-desc-text"><?= htmlspecialchars($profile['what_i_do_desc2']) ?></p>
            </div>

        </div>

        <!-- Skill Cards -->
        <div class="skills-row-wrapper mb-5" id="skillWrapper">

            <div class="skills-row-group">
                <?php foreach ($skillsTech as $skill): ?>
                <div class="skill-chip glass-card">
                    <div class="skill-chip-header">
                        <span class="skill-name"><?= htmlspecialchars($skill['name']) ?></span>
                    </div>
                    <div class="skill-bar-wrap">
                        <div class="skill-bar-fill"
                            data-level="<?= (int)$skill['level'] ?>"
                            style="width:0%; transition:width 1.2s cubic-bezier(0.22,1,0.36,1);">
                        </div>
                    </div>
                    <span class="skill-percent"><?= (int)$skill['level'] ?>%</span>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="skills-row-group">
                <?php foreach ($skillsSoft as $skill): ?>
                <div class="skill-chip glass-card">
                    <div class="skill-chip-header">
                        <span class="skill-name"><?= htmlspecialchars($skill['name']) ?></span>
                    </div>
                    <div class="skill-bar-wrap">
                        <div class="skill-bar-fill"
                            data-level="<?= (int)$skill['level'] ?>"
                            style="width:0%; transition:width 1.2s cubic-bezier(0.22,1,0.36,1);">
                        </div>
                    </div>
                    <span class="skill-percent"><?= (int)$skill['level'] ?>%</span>
                </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Experience Carousel -->
        <h4 class="text-white text-center mb-4 fw-semibold">Experience</h4>
        <div id="carouselExperience" class="carousel slide experience-carousel">

            <div class="carousel-indicators">
                <?php foreach ($experiences as $i => $exp): ?>
                <button type="button"
                        data-bs-target="#carouselExperience"
                        data-bs-slide-to="<?= $i ?>"
                        <?= $i === 0 ? 'class="active" aria-current="true"' : '' ?>
                        aria-label="Slide <?= $i + 1 ?>">
                </button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach ($experiences as $i => $exp): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <div class="exp-slide position-relative overflow-hidden">
                        <img src="<?= htmlspecialchars($exp['photo']) ?>"
                            class="exp-bg-photo" alt="Experience Photo"
                            onerror="this.src='https://placehold.co/900x400/a18cd1/ffffff?text=Foto+Kegiatan'">
                        <div class="exp-overlay"></div>
                        <div class="exp-content text-center position-relative">
                            <div class="exp-year-badge mb-3"><?= htmlspecialchars($exp['year']) ?></div>
                            <h4 class="text-white fw-bold"><?= htmlspecialchars($exp['role']) ?></h4>
                            <p class="text-white-50 mb-3"><?= htmlspecialchars($exp['company']) ?></p>
                            <p class="text-white" style="opacity:0.9; line-height:1.8;"><?= htmlspecialchars($exp['description']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExperience" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExperience" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>

    </div>
</section>


<!-- Section Certificates -->
<section id="certificates" class="py-5 section-pad">
    <div class="container">
        <h2 class="section-title text-center mb-5">Certificates</h2>
        <div class="row g-4 justify-content-center" id="certGrid">
            <?php foreach ($certificates as $cert): ?>
            <div class="col-md-6 col-lg-4 cert-card-wrapper" style="opacity:0; transform:translateY(40px);">
                <div class="card h-100 glass-card cert-card border-0">
                    <img src="<?= htmlspecialchars($cert['image']) ?>"
                        class="card-img-top p-3 rounded"
                        alt="Certificate" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white fw-bold"><?= htmlspecialchars($cert['title']) ?></h5>
                        <p class="card-text text-white-50 small"><?= htmlspecialchars($cert['issuer']) ?></p>
                        <button class="btn btn-light btn-sm rounded-pill mt-2 btn-cert"
                                data-img="<?= htmlspecialchars($cert['image']) ?>">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Modal Sertifikat -->
<div id="certBackdrop" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.75); z-index:1040;"></div>
<div id="certModal" style="display:none; position:fixed; inset:0; z-index:1050; overflow-y:auto;"
    onclick="if(event.target===this) closeCertModal()">
    <div class="modal-dialog modal-dialog-centered modal-lg"
        style="margin:auto; min-height:100%; display:flex; align-items:center;">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative">
                <button type="button"
                        class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        style="z-index:3;" onclick="closeCertModal()"></button>
                <img id="certModalImg" src="" class="img-fluid rounded shadow-lg"
                    style="width:100%; height:auto; max-height:90vh; object-fit:contain;">
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="text-center py-4 text-white glass-footer">
    <p class="mb-0">&copy; 2026 <?= htmlspecialchars($profile['name']) ?>.</p>
</footer>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>

<!-- Vue JS -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<script>
// 1. VUE

const { createApp } = Vue;

createApp({
    data() {
        return {
            scrollY:        0,
            currentSection: 'home'
        }
    },
    computed: {
        heroVisible() { return this.scrollY < 400; }
    },
    methods: {
        heroClass(elClass) {
            return this.heroVisible
                ? `${elClass} hero-text-in`
                : `${elClass} hero-text-out`;
        },
        handleScroll() {
            this.scrollY = window.scrollY;
            ['home', 'about', 'certificates'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    const r = el.getBoundingClientRect();
                    if (r.top <= 150 && r.bottom >= 150) this.currentSection = id;
                }
            });
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
    }
}).mount('#app');



// 2. CAROUSEL 
document.addEventListener('DOMContentLoaded', function () {
    var carouselEl = document.getElementById('carouselExperience');
    if (carouselEl) {
        new bootstrap.Carousel(carouselEl, {
            interval: 3000,
            ride:     'carousel',
            wrap:     true,
            touch:    true
        });
    }
});

// 3. SKILL BAR ANIMASI 

const skillObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            document.querySelectorAll('.skill-bar-fill').forEach(function (bar) {
                bar.style.width = bar.getAttribute('data-level') + '%';
            });
            skillObserver.disconnect();
        }
    });
}, { threshold: 0.3 });

var skillWrapper = document.getElementById('skillWrapper');
if (skillWrapper) skillObserver.observe(skillWrapper);

// 4. CERTIFICATE CARDS ANIMASI
const certObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            document.querySelectorAll('.cert-card-wrapper').forEach(function (card, i) {
                setTimeout(function () {
                    card.style.transition = 'opacity 0.7s ease, transform 0.7s ease';
                    card.style.opacity    = '1';
                    card.style.transform  = 'translateY(0)';
                }, i * 100);
            });
            certObserver.disconnect();
        }
    });
}, { threshold: 0.1 });

var certGrid = document.getElementById('certGrid');
if (certGrid) certObserver.observe(certGrid);


// 5. MODAL SERTIFIKAT
function openCertModal(src) {
    document.getElementById('certModalImg').src           = src;
    document.getElementById('certBackdrop').style.display = 'block';
    document.getElementById('certModal').style.display    = 'block';
    document.body.style.overflow = 'hidden';
}

function closeCertModal() {
    document.getElementById('certBackdrop').style.display = 'none';
    document.getElementById('certModal').style.display    = 'none';
    document.getElementById('certModalImg').src           = '';
    document.body.style.overflow = 'auto';
}

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-cert')) {
        openCertModal(e.target.getAttribute('data-img'));
    }
});
</script>

</body>
</html>