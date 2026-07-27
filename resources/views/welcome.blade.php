<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>SMP Muhammadiyah Bojong Nangka | Islamic Modern Education</title>

  <meta name="description" content="SMP Muhammadiyah Bojong Nangka - Sekolah Islam modern yang unggul dalam akhlak, teknologi, dan prestasi." />
  <meta name="keywords" content="SMP Muhammadiyah, PPDB, Sekolah Islam Modern, SMP Tangerang, Sekolah Muhammadiyah" />
  <meta name="author" content="SMP Muhammadiyah Bojong Nangka" />

  <!-- Open Graph -->
  <meta property="og:title" content="SMP Muhammadiyah Bojong Nangka" />
  <meta property="og:description" content="Islamic Modern Education untuk generasi unggul dan berakhlakul mulia." />
  <meta property="og:type" content="website" />

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --primary:#0f4fa8;
      --secondary:#0da36f;
      --white:#ffffff;
      --text:#1e293b;
      --bg:#f4f9ff;
      --card:rgba(255,255,255,0.65);
      --shadow:0 8px 30px rgba(0,0,0,.08);
      --border:rgba(255,255,255,.3);
    }

    body.dark{
      --text:#f1f5f9;
      --bg:#0f172a;
      --card:rgba(15,23,42,.6);
      --shadow:0 8px 30px rgba(0,0,0,.35);
      --border:rgba(255,255,255,.1);
    }

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    html{
      scroll-behavior:smooth;
    }

    body{
      font-family:'Poppins',sans-serif;
      background:var(--bg);
      color:var(--text);
      transition:.4s ease;
      overflow-x:hidden;
    }

    img{
      max-width:100%;
      display:block;
    }

    a{
      text-decoration:none;
      color:inherit;
    }

    section{
      padding:90px 8%;
    }

    .container{
      max-width:1200px;
      margin:auto;
    }

    .section-title{
      text-align:center;
      margin-bottom:50px;
    }

    .section-title h2{
      font-size:2.2rem;
      color:var(--primary);
      margin-bottom:12px;
    }

    .section-title p{
      opacity:.8;
      max-width:700px;
      margin:auto;
      line-height:1.8;
    }

    /* Running Text */
    .running-text{
      background:linear-gradient(90deg,var(--primary),var(--secondary));
      color:#fff;
      padding:10px 0;
      overflow:hidden;
      white-space:nowrap;
      position:relative;
      z-index:999;
    }

    .running-text span{
      display:inline-block;
      padding-left:100%;
      animation:marquee 18s linear infinite;
      font-size:.95rem;
      font-weight:500;
    }

    @keyframes marquee{
      0%{transform:translateX(0)}
      100%{transform:translateX(-100%)}
    }

    /* Navbar */
    header{
      position:sticky;
      top:0;
      z-index:999;
      backdrop-filter:blur(15px);
      background:rgba(255,255,255,.1);
      border-bottom:1px solid rgba(255,255,255,.1);
    }

    body.dark header{
      background:rgba(15,23,42,.8);
    }

    nav{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:18px 8%;
    }

    .logo{
      display:flex;
      align-items:center;
      gap:10px;
      font-weight:700;
      color:var(--primary);
      font-size:1.1rem;
    }

    .logo-circle{
      width:42px;
      height:42px;
      border-radius:50%;
      background:linear-gradient(135deg,var(--primary),var(--secondary));
    }

    .nav-links{
      display:flex;
      gap:25px;
      align-items:center;
    }

    .nav-links a{
      font-size:.95rem;
      font-weight:500;
      transition:.3s;
    }

    .nav-links a:hover{
      color:var(--secondary);
    }

    .toggle-dark{
      cursor:pointer;
      padding:10px 14px;
      border-radius:50px;
      background:var(--card);
      border:1px solid var(--border);
      backdrop-filter:blur(15px);
    }

    .hamburger{
      display:none;
      flex-direction:column;
      gap:5px;
      cursor:pointer;
    }

    .hamburger span{
      width:25px;
      height:3px;
      background:var(--text);
      border-radius:10px;
    }

    /* Hero */
    .hero{
      min-height:100vh;
      display:flex;
      align-items:center;
      background:
      radial-gradient(circle at top right, rgba(13,163,111,.2), transparent 30%),
      radial-gradient(circle at bottom left, rgba(15,79,168,.2), transparent 30%);
      position:relative;
      overflow:hidden;
    }

    .hero-grid{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:60px;
      align-items:center;
    }

    .hero-text h1{
      font-size:3.5rem;
      line-height:1.2;
      margin-bottom:20px;
      color:var(--primary);
    }

    .hero-text p{
      line-height:1.9;
      margin-bottom:30px;
      opacity:.85;
    }

    .hero-buttons{
      display:flex;
      gap:15px;
      flex-wrap:wrap;
    }

    .btn{
      padding:15px 28px;
      border-radius:50px;
      font-weight:600;
      transition:.3s;
      display:inline-block;
    }

    .btn-primary{
      background:linear-gradient(135deg,var(--primary),var(--secondary));
      color:#fff;
      box-shadow:var(--shadow);
    }

    .btn-primary:hover{
      transform:translateY(-3px);
    }

    .btn-outline{
      border:2px solid var(--primary);
      color:var(--primary);
    }

    .btn-outline:hover{
      background:var(--primary);
      color:#fff;
    }

    .hero-card{
      background:var(--card);
      border:1px solid var(--border);
      backdrop-filter:blur(20px);
      padding:30px;
      border-radius:28px;
      box-shadow:var(--shadow);
    }

    .hero-card img{
      border-radius:22px;
    }

    /* Cards */
    .grid-3{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:25px;
    }

    .glass-card{
      background:var(--card);
      border:1px solid var(--border);
      backdrop-filter:blur(14px);
      border-radius:24px;
      padding:30px;
      box-shadow:var(--shadow);
      transition:.4s;
    }

    .glass-card:hover{
      transform:translateY(-8px);
    }

    .glass-card h3{
      margin:18px 0 12px;
      color:var(--primary);
    }

    .glass-card p{
      line-height:1.8;
      opacity:.85;
    }

    /* Stats */
    .stats{
      background:linear-gradient(135deg,var(--primary),var(--secondary));
      color:#fff;
      border-radius:30px;
      padding:50px;
    }

    .stats-grid{
      display:grid;
      grid-template-columns:repeat(4,1fr);
      gap:30px;
      text-align:center;
    }

    .stats-grid h3{
      font-size:3rem;
      margin-bottom:10px;
    }

    /* Gallery */
    .gallery-slider{
      overflow:hidden;
      border-radius:24px;
      position:relative;
    }

    .gallery-track{
      display:flex;
      transition:transform .5s ease;
    }

    .gallery-track img{
      width:100%;
      flex-shrink:0;
      height:450px;
      object-fit:cover;
    }

    /* Testimoni */
    .testimonial{
      position:relative;
    }

    .testimonial p{
      line-height:1.9;
      margin-bottom:20px;
    }

    /* Timeline */
    .timeline{
      position:relative;
      max-width:800px;
      margin:auto;
    }

    .timeline-item{
      padding:25px;
      margin-bottom:20px;
      border-left:4px solid var(--secondary);
      background:var(--card);
      border-radius:20px;
      box-shadow:var(--shadow);
    }

    /* Form */
    form{
      display:grid;
      gap:20px;
    }

    input, textarea, select{
      width:100%;
      padding:15px;
      border-radius:14px;
      border:none;
      outline:none;
      background:rgba(255,255,255,.7);
      font-family:inherit;
    }

    body.dark input,
    body.dark textarea,
    body.dark select{
      background:rgba(255,255,255,.08);
      color:#fff;
    }

    /* FAQ */
    .faq-item{
      background:var(--card);
      margin-bottom:15px;
      border-radius:18px;
      overflow:hidden;
      box-shadow:var(--shadow);
    }

    .faq-question{
      padding:20px;
      cursor:pointer;
      font-weight:600;
    }

    .faq-answer{
      max-height:0;
      overflow:hidden;
      transition:.4s;
      padding:0 20px;
    }

    .faq-item.active .faq-answer{
      max-height:200px;
      padding:0 20px 20px;
    }

    /* Footer */
    footer{
      background:#0f172a;
      color:#fff;
      padding:70px 8% 30px;
    }

    .footer-grid{
      display:grid;
      grid-template-columns:repeat(4,1fr);
      gap:30px;
    }

    .footer-bottom{
      text-align:center;
      margin-top:40px;
      opacity:.7;
      border-top:1px solid rgba(255,255,255,.1);
      padding-top:20px;
    }

    /* Countdown */
    .countdown{
      display:flex;
      gap:15px;
      margin-top:30px;
      flex-wrap:wrap;
    }

    .count-box{
      background:var(--card);
      border:1px solid var(--border);
      padding:18px;
      border-radius:20px;
      text-align:center;
      min-width:90px;
      backdrop-filter:blur(10px);
    }

    .count-box h3{
      font-size:2rem;
      color:var(--primary);
    }

    /* Floating WA */
    .wa-float{
      position:fixed;
      right:20px;
      bottom:20px;
      width:60px;
      height:60px;
      border-radius:50%;
      background:#25D366;
      display:flex;
      justify-content:center;
      align-items:center;
      color:#fff;
      font-size:28px;
      box-shadow:0 10px 25px rgba(0,0,0,.2);
      z-index:999;
    }

    /* Animation */
    .reveal{
      opacity:0;
      transform:translateY(40px);
      transition:1s;
    }

    .reveal.active{
      opacity:1;
      transform:translateY(0);
    }

    /* Popup */
    .popup{
      position:fixed;
      top:50%;
      left:50%;
      transform:translate(-50%,-50%) scale(.8);
      background:#fff;
      padding:40px;
      border-radius:24px;
      box-shadow:var(--shadow);
      opacity:0;
      pointer-events:none;
      transition:.4s;
      z-index:9999;
      text-align:center;
    }

    .popup.show{
      opacity:1;
      transform:translate(-50%,-50%) scale(1);
      pointer-events:auto;
    }

    /* Responsive */
    @media(max-width:992px){

      .hero-grid,
      .grid-3,
      .stats-grid,
      .footer-grid{
        grid-template-columns:1fr;
      }

      .hero-text h1{
        font-size:2.5rem;
      }

      .nav-links{
        position:absolute;
        top:80px;
        right:-100%;
        width:280px;
        background:var(--card);
        backdrop-filter:blur(20px);
        flex-direction:column;
        padding:30px;
        border-radius:20px;
        transition:.4s;
      }

      .nav-links.active{
        right:20px;
      }

      .hamburger{
        display:flex;
      }
    }
  </style>
</head>

<body>

  <!-- Running Text -->
  <div class="running-text">
    <span>
      PPDB SMP Muhammadiyah Bojong Nangka Tahun Ajaran 2026/2027 TELAH DIBUKA • Sekolah Islam Modern • Unggul Dalam Akhlak, Teknologi, dan Prestasi
    </span>
  </div>

  <!-- Header -->
  <header>
    <nav>
      <div class="logo">
    <img src="{{ asset('images/logo.png') }}"  alt="Logo Sekolah" width="55px">

    <span>SMP Muhammadiyah Bojong Nangka</span>
</div>
      <div class="nav-links" id="navMenu">
        <a href="#about">Tentang</a>
        <a href="#program">Program</a>
        <a href="#prestasi">Prestasi</a>
        <a href="#ppdb">PPDB</a>
        <a href="#contact">Kontak</a>
        <a href="/login" class="btn btn-light"> Login Admin</a>
        <div class="toggle-dark" id="darkToggle">🌙</div>
      </div>

      <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>
  </header>

  <main>

    <!-- Hero -->
    <section class="hero">
      <div class="container hero-grid">

        <div class="hero-text reveal">
          <h1>Generasi Islam Berkarakter dan Berpestasi</h1>

          <p>
            SMP Muhammadiyah Bojong Nangka hadir sebagai sekolah Islam modern yang memadukan pendidikan karakter, teknologi, dan prestasi akademik untuk membentuk generasi unggul dan berakhlakul mulia.
          </p>

          <div class="hero-buttons">
            <a href="#ppdb" class="btn btn-primary">Daftar Sekarang</a>
            <a href="https://wa.me/6289629673784" class="btn btn-outline">Hubungi WhatsApp</a>
          </div>

          <div class="countdown">
            <div class="count-box">
              <h3 id="days">00</h3>
              <span>Hari</span>
            </div>

            <div class="count-box">
              <h3 id="hours">00</h3>
              <span>Jam</span>
            </div>

            <div class="count-box">
              <h3 id="minutes">00</h3>
              <span>Menit</span>
            </div>

            <div class="count-box">
              <h3 id="seconds">00</h3>
              <span>Detik</span>
            </div>
          </div>
        </div>

        <div class="hero-card reveal">
          <img siswa ="lazy" src="{{ asset('images/siswa1.png') }}"  alt="Sekolah Modern" width="100%">
        </div>

      </div>
    </section>

    <!-- Tentang -->
    <section id="about">
      <div class="container">
        <div class="section-title reveal">
          <h2>Tentang Sekolah</h2>
          <p>
            Sekolah Islam modern yang berkomitmen membangun generasi berprestasi, berakhlakul mulia, dan siap menghadapi tantangan global.
          </p>
        </div>

        <div class="grid-3">
          <div class="glass-card reveal">
            <h3>Pendidikan Karakter</h3>
            <p>
              Menanamkan nilai-nilai Islami dan akhlakul karimah dalam kehidupan sehari-hari siswa.
            </p>
          </div>

          <div class="glass-card reveal">
            <h3>Digital Learning</h3>
            <p>
              Pembelajaran modern berbasis teknologi untuk meningkatkan kreativitas dan inovasi siswa.
            </p>
          </div>

          <div class="glass-card reveal">
            <h3>Prestasi Unggul</h3>
            <p>
              Mendorong siswa meraih prestasi akademik dan non-akademik di tingkat regional maupun nasional.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Visi Misi -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>Visi & Misi</h2>
        </div>

        <div class="grid-3">
          <div class="glass-card reveal">
            <h3>Visi</h3>
            <p>
              Menyiapkan generasi masa depan sebagai pemimpin umat yang berakhlakul mulia dan mampu bersaing di era globalisasi.
            </p>
          </div>

          <div class="glass-card reveal">
            <h3>Misi 1</h3>
            <p>
              Meningkatkan keimanan dan akhlak siswa agar memiliki kecerdasan emosional, sosial, dan spiritual.
            </p>
          </div>

          <div class="glass-card reveal">
            <h3>Misi 2</h3>
            <p>
              Mengembangkan siswa kreatif, inovatif, komunikatif, dan percaya diri dalam menghadapi masa depan.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Keunggulan -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>Keunggulan Sekolah</h2>
        </div>

        <div class="grid-3">
          <div class="glass-card reveal">
            <h3>Tahfidz & Karakter</h3>
            <p>Program pembinaan karakter Islami dan tahfidz Al-Qur’an.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Smart Classroom</h3>
            <p>Kelas digital modern dengan teknologi pembelajaran interaktif.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Ekstrakurikuler Lengkap</h3>
            <p>Pencak silat, futsal, robotic, English club, dan multimedia.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Program -->
    <section id="program">
      <div class="container">
        <div class="section-title reveal">
          <h2>Program Unggulan</h2>
        </div>

        <div class="grid-3">
          <div class="glass-card reveal">
            <h3>Tahfidz Qur'an</h3>
            <p>Target hafalan Al-Qur’an dengan pembinaan intensif.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Digital Class</h3>
            <p>Pembelajaran berbasis teknologi dan literasi digital.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Leadership Program</h3>
            <p>Membentuk jiwa kepemimpinan dan komunikasi siswa.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Fasilitas -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>Fasilitas Modern</h2>
        </div>

        <div class="grid-3">
          <div class="glass-card reveal">
            <h3>Laboratorium Komputer</h3>
            <p>Fasilitas digital modern untuk pembelajaran dan ANBK.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Masjid Sekolah</h3>
            <p>Masjid nyaman untuk pembinaan spiritual siswa.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Perpustakaan Digital</h3>
            <p>Akses literasi modern dengan koleksi digital lengkap.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistik -->
    <section>
      <div class="container stats reveal">
        <div class="stats-grid">
          <div>
            <h3 class="counter" data-target="750">0</h3>
            <p>Siswa Aktif</p>
          </div>

          <div>
            <h3 class="counter" data-target="45">0</h3>
            <p>Guru Profesional</p>
          </div>

          <div>
            <h3 class="counter" data-target="120">0</h3>
            <p>Prestasi</p>
          </div>

          <div>
            <h3 class="counter" data-target="15">0</h3>
            <p>Tahun Berdiri</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Prestasi -->
    <section id="prestasi">
      <div class="container">
        <div class="section-title reveal">
          <h2>Prestasi Siswa</h2>
        </div>

        <div class="grid-3">
          <div class="glass-card reveal">
            <h3>Juara Pencak Silat</h3>
            <p>Prestasi tingkat provinsi dalam kompetisi pencak silat.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Olimpiade Sains</h3>
            <p>Siswa berhasil meraih medali dalam lomba sains nasional.</p>
          </div>

          <div class="glass-card reveal">
            <h3>Festival Tahfidz</h3>
            <p>Prestasi tahfidz Qur’an tingkat kabupaten.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Video -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>Video Profil Sekolah</h2>
        </div>

        <div class="glass-card reveal">
          <iframe width="100%" height="500"
            src="https://www.youtube.com/embed/tgbNymZ7vqY"
            title="Video Profil"
            style="border:none;border-radius:20px;"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </section>

    <!-- Gallery -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>Galeri Sekolah</h2>
        </div>

        <div class="gallery-slider reveal">
          <div class="gallery-track" id="galleryTrack">
            <img loading="lazy" src="https://images.unsplash.com/photo-1588072432836-e10032774350?q=80&w=1200&auto=format&fit=crop">
            <img loading="lazy" src="https://images.unsplash.com/photo-1503676382389-4809596d5290?q=80&w=1200&auto=format&fit=crop">
            <img loading="lazy" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop">
          </div>
        </div>
      </div>
    </section>

    <!-- Testimoni -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>Testimoni Orang Tua</h2>
        </div>

        <div class="grid-3">
          <div class="glass-card testimonial reveal">
            <p>
              “Sekolah yang sangat baik dalam membentuk karakter dan akhlak anak.”
            </p>
            <strong>- Wali Murid</strong>
          </div>

          <div class="glass-card testimonial reveal">
            <p>
              “Pembelajaran digitalnya modern dan membuat anak lebih semangat belajar.”
            </p>
            <strong>- Orang Tua Siswa</strong>
          </div>

          <div class="glass-card testimonial reveal">
            <p>
              “Lingkungan islami dan guru-gurunya sangat profesional.”
            </p>
            <strong>- Alumni</strong>
          </div>
        </div>
      </div>
    </section>

    <!-- PPDB -->
    <section id="ppdb">
      <div class="container">
        <div class="section-title reveal">
          <h2>Informasi PPDB</h2>
          <p>
            Penerimaan Peserta Didik Baru Tahun Ajaran 2026/2027 telah dibuka.
          </p>
        </div>

        <div class="timeline reveal">
          <div class="timeline-item">
            <h3>Pendaftaran Dibuka</h3>
            <p>01 Januari 2026</p>
          </div>

          <div class="timeline-item">
            <h3>Seleksi & Wawancara</h3>
            <p>15 Februari 2026</p>
          </div>

          <div class="timeline-item">
            <h3>Pengumuman</h3>
            <p>01 Maret 2026</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Form -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>Formulir Pendaftaran</h2>
        </div>

        <div class="glass-card reveal">
          <form id="ppdbForm">
            <input type="text" placeholder="Nama Lengkap" required>
            <input type="text" placeholder="Asal Sekolah" required>
            <input type="text" placeholder="Nomor WhatsApp" required>

            <select required>
              <option value="">Pilih Program</option>
              <option>Tahfidz</option>
              <option>Regular</option>
              <option>Digital Class</option>
            </select>

            <textarea rows="5" placeholder="Pesan / Pertanyaan"></textarea>

            <button class="btn btn-primary" type="submit">
              Kirim Pendaftaran
            </button>
          </form>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section>
      <div class="container">
        <div class="section-title reveal">
          <h2>FAQ</h2>
        </div>

        <div class="faq-item reveal">
          <div class="faq-question">Apakah tersedia program tahfidz?</div>
          <div class="faq-answer">
            <p>Ya, sekolah memiliki program tahfidz dengan pembinaan intensif.</p>
          </div>
        </div>

        <div class="faq-item reveal">
          <div class="faq-question">Apakah sekolah menggunakan pembelajaran digital?</div>
          <div class="faq-answer">
            <p>Ya, pembelajaran sudah terintegrasi dengan teknologi digital modern.</p>
          </div>
        </div>

        <div class="faq-item reveal">
          <div class="faq-question">Bagaimana cara mendaftar PPDB?</div>
          <div class="faq-answer">
            <p>Pendaftaran dapat dilakukan secara online melalui formulir website.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Kontak -->
    <section id="contact">
      <div class="container">
        <div class="section-title reveal">
          <h2>Kontak & Lokasi</h2>
        </div>

        <div class="grid-3">
          <div class="glass-card reveal">
            <h3>Alamat</h3>
            <p>Jl. Pendidikan Islami No. 10 Tangerang</p>
          </div>

          <div class="glass-card reveal">
            <h3>WhatsApp</h3>
            <p>+62 812 3456 7890</p>
          </div>

          <div class="glass-card reveal">
            <h3>Email</h3>
            <p>info@smpmbojongnangka.sch.id</p>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-grid">
      <div>
        <h3>SMP Muhammadiyah Bojong Nangka</h3>
        <p>
          Islamic Modern Education untuk generasi unggul dan berakhlakul mulia.
        </p>
      </div>

      <div>
        <h3>Menu</h3>
        <p>Tentang</p>
        <p>Program</p>
        <p>PPDB</p>
      </div>

      <div>
        <h3>Program</h3>
        <p>Tahfidz</p>
        <p>Digital Class</p>
        <p>Leadership</p>
      </div>

      <div>
        <h3>Kontak</h3>
        <p>+62 812 3456 7890</p>
        <p>info@smpmbojongnangka.sch.id</p>
      </div>
    </div>

    <div class="footer-bottom">
      © 2026 SMP Muhammadiyah Bojong Nangka. All Rights Reserved.
    </div>
  </footer>

  <!-- Floating WA -->
  <a href="https://wa.me/6281234567890" class="wa-float" aria-label="WhatsApp">
    ☎
  </a>

  <!-- Popup -->
  <div class="popup" id="popup">
    <h2>Pendaftaran Berhasil</h2>
    <p>Terima kasih telah melakukan pendaftaran PPDB.</p>
  </div>

  <script>

    // Dark Mode
    const darkToggle = document.getElementById('darkToggle');

    darkToggle.addEventListener('click', () => {
      document.body.classList.toggle('dark');
    });

    // Mobile Menu
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');

    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('active');
    });

    // Reveal Animation
    function reveal(){
      const reveals = document.querySelectorAll('.reveal');

      reveals.forEach(el => {
        const windowHeight = window.innerHeight;
        const revealTop = el.getBoundingClientRect().top;
        const revealPoint = 100;

        if(revealTop < windowHeight - revealPoint){
          el.classList.add('active');
        }
      });
    }

    window.addEventListener('scroll', reveal);
    reveal();

    // Counter Animation
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
      counter.innerText = '0';

      const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const c = +counter.innerText;

        const increment = target / 100;

        if(c < target){
          counter.innerText = `${Math.ceil(c + increment)}`;
          setTimeout(updateCounter, 20);
        } else {
          counter.innerText = target;
        }
      };

      updateCounter();
    });

    // Gallery Slider
    const track = document.getElementById('galleryTrack');
    let index = 0;

    setInterval(() => {
      index++;
      if(index > 2){
        index = 0;
      }

      track.style.transform = `translateX(-${index * 100}%)`;
    }, 4000);

    // FAQ
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
      item.addEventListener('click', () => {
        item.classList.toggle('active');
      });
    });

    // Countdown
    const targetDate = new Date("2026-12-31T00:00:00").getTime();

    setInterval(() => {
      const now = new Date().getTime();
      const distance = targetDate - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById('days').innerText = days;
      document.getElementById('hours').innerText = hours;
      document.getElementById('minutes').innerText = minutes;
      document.getElementById('seconds').innerText = seconds;

    },1000);

    // Form Popup
    const form = document.getElementById('ppdbForm');
    const popup = document.getElementById('popup');

    form.addEventListener('submit', function(e){
      e.preventDefault();

      popup.classList.add('show');

      setTimeout(() => {
        popup.classList.remove('show');
        form.reset();
      },3000);
    });

  </script>

</body>
</html>