@extends('layouts.user')

@section('content')
<div>
  <div class="container2">
    <div class="header-text">
      <h1 class="header-ejas"><em>E-JAS</em></h1>
      <h2 class="header-panjang"><em>(Electronic Judicial Administration System)</em></h2>
      <h1 class="header-title"><em>Pengadilan Negeri Balige</em></h1>
    </div>
    <div class="logo-container">
      <img src="{{asset('assets/images/logo_pengadilan.png')}}" class="rounded-pill" alt="">
    </div>
  </div>
</div>

<div class="row userCard mt-4">
  <div class="col-lg-12">

    <!-- Blog layout #1 with image -->
    <div class="card blog-horizontal">
      <div class="card-header border-bottom-0 pb-0">
        <h3 class="my-1">
          <strong><center><p class="text-body"><em>Eksekusi Online</em></p></center></strong>
        </h3>
      </div>

      <div class="card-body">
        <div class="card-img-actions me-5 ">
          <img class="card-img img-fluid" src="{{asset('assets/images/eksekusi_beranda_1.png')}}" alt="">
          <img class="card-img img-fluid mt-4" src="{{asset('assets/images/eksekusi_beranda_2.png')}}" alt="">
        </div>

        <p>Eksekusi merupakan tindakan paksa yang dilakukan pengadilan dengan bantuan alat negara guna menjalankan putusan 
          pengadilan yang telah memperoleh kekuatan hukum tetap. Selama putusan belum memperoleh kekuatan hukum tetap, 
          upaya dan tindakan eksekusi belum berfungsi.
        </p>
        
        <p>Eksekusi baru berfungsi sebagai tindakan hukum yang sah dan memaksa terhitung sejak tanggal putusan memperoleh 
          kekuatan hukum tetap karena pihak tergugat tidak mau menaati dan memenuhi putusan pengadilan secara sukarela.
        </p>

        <h5 class="mt-4">Syarat - Syarat Permohonan Eksekusi</h5>

        <ol>
          <li class="text-list" onclick="toggleList('list1')">Permohonan Eksekusi Putusan <span id="arrow1">></span></li>
          <div class="anak-list" id="list1" style="display: none;">
              <ol type="1">
                  <li>Surat Permohonan Eksekusi.</li>
                  <li>Surat Kuasa Bermeterai.</li>
                  <li>Fotocopy Putusan Pengadilan Negeri.</li>
                  <li>Fotocopy Putusan Pengadilan Tinggi.</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (Kasasi).</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (PK).</li>
              </ol>
          </div>
          <li class="text-list" onclick="toggleList('list2')">Permohonan Eksekusi Hak Tanggungan <span id="arrow2">></span></li>
          <div class="anak-list" id="list2" style="display: none;">
              <ol type="1">
                  <li>Surat Permohonan Eksekusi.</li>
                  <li>Surat Kuasa Bermeterai.</li>
                  <li>Fotocopy Putusan Pengadilan Negeri.</li>
                  <li>Fotocopy Putusan Pengadilan Tinggi.</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (Kasasi).</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (PK).</li>
              </ol>
          </div>
          <li class="text-list" onclick="toggleList('list3')">Permohonan Eksekusi Hak Tanggungan <span id="arrow3">></span></li>
          <div class="anak-list" id="list3" style="display: none;">
              <ol type="1">
                  <li>Surat Permohonan Eksekusi.</li>
                  <li>Surat Kuasa Bermeterai.</li>
                  <li>Fotocopy Putusan Pengadilan Negeri.</li>
                  <li>Fotocopy Putusan Pengadilan Tinggi.</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (Kasasi).</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (PK).</li>
              </ol>
          </div>
          <li class="text-list" onclick="toggleList('list4')">Permohonan Eksekusi Hak Tanggungan <span id="arrow4">></span></li>
          <div class="anak-list" id="list4" style="display: none;">
              <ol type="1">
                  <li>Surat Permohonan Eksekusi.</li>
                  <li>Surat Kuasa Bermeterai.</li>
                  <li>Fotocopy Putusan Pengadilan Negeri.</li>
                  <li>Fotocopy Putusan Pengadilan Tinggi.</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (Kasasi).</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (PK).</li>
              </ol>
          </div>
          <li class="text-list" onclick="toggleList('list5')">Permohonan Eksekusi Hak Tanggungan <span id="arrow5">></span></li>
          <div class="anak-list" id="list5" style="display: none;">
              <ol type="1">
                  <li>Surat Permohonan Eksekusi.</li>
                  <li>Surat Kuasa Bermeterai.</li>
                  <li>Fotocopy Putusan Pengadilan Negeri.</li>
                  <li>Fotocopy Putusan Pengadilan Tinggi.</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (Kasasi).</li>
                  <li>Fotocopy Putusan Mahkamah Agung RI (PK).</li>
              </ol>
          </div>
      </ol>
      

      </div>
    </div>
    <!-- /blog layout #1 with image -->

  </div>
</div>

<div class="row userCard mt-4">
  <div class="col-lg-12">

    <!-- Blog layout #1 with image -->
    <div class="card blog-horizontal">
      <div class="card-header border-bottom-0 pb-0">
        <h3 class="my-1">
          <strong><center><p class="text-body"><em>Peristiwa Penting</em></p></center></strong>
        </h3>
      </div>

      <div class="card-body">
        <div class="card-img-actions me-3">
          <img class="card-img img-fluid" src="{{asset('assets/images/peristiwa penting beranda.png')}}" alt="">
        </div>

        <p>Eksekusi merupakan tindakan paksa yang dilakukan pengadilan dengan bantuan alat negara guna menjalankan 
          putusan pengadilan yang telah memperoleh kekuatan hukum tetap.
        </p>
        <p>
          Selama putusan belum memperoleh kekuatan hukum tetap, upaya dan tindakan eksekusi belum berfungsi.
        </p>  
        <p>
          Eksekusi baru berfungsi sebagai tindakan hukum yang sah dan memaksa terhitung sejak tanggal putusan memperoleh 
          kekuatan hukum tetap karena pihak tergugat tidak mau menaati dan memenuhi putusan pengadilan secara sukarela.
        </p>
      </div>
    </div>
    <!-- /blog layout #1 with image -->

  </div>
</div>
 
<!-- Footer -->
<footer class="footer">
  <div class="footer-content">
      <div class="social-media">
          <!-- Ikon Sosial Media -->
          <a href="https://www.instagram.com/pn_balige?igsh=MTV5YW52aTIweGs1ZA==">
              <img src="{{asset('assets/images/instagram_icon.png')}}" alt="Instagram Icon">
              <span>pn_balige</span>
          </a>

          <a href="https://www.facebook.com/pengadilannegeri.balige?mibextid=ZbWKwL">
              <img src="{{asset('assets/images/facebook_icon.png')}}" alt="Facebook Icon">
              <span>Pengadilan Negeri Balige</span>
          </a>

          <a href="">
              <img src="{{asset('assets/images/gmail_icon.png')}}" alt="Gmail Icon">
              <span>it.pnbalige@gmail.com</span>
          </a>

          <a href="">
              <img src="{{asset('assets/images/teleon_icon.png')}}" alt="Teleon Icon">
              <span>(0632)21077</span>
          </a>

          <a href="">
              <img src="{{asset('assets/images/alamat_icon.png')}}" alt="Alamat Icon">
              <span>Jl. Patuan Nagari No.6 Balige - Sumatera Utara</span>
          </a>
      </div>
      <!-- Peta -->
      <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.103715002628!2d99.07235291476863!3d2.350384198008445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30495ed3d4c73fb1%3A0xb9cc2d0b9d389e86!2sBalige%2C%20Habinsaran%2C%20Toba%20Samosir%2C%20Sumatera%20Utara%2C%20Indonesia!5e0!3m2!1sen!2s!4v1648531287262!5m2!1sen!2s" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
  </div>
</footer>

<script>
  function toggleList(id) {
    var list = document.getElementById(id);
    var arrow = document.getElementById("arrow" + id.substr(-1));
    if (list.style.display === "none") {
        list.style.display = "block";
        arrow.innerHTML = "v";
    } else {
        list.style.display = "none";
        arrow.innerHTML = ">";
    }
  }
</script>
@endsection
