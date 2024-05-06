@extends('layouts.user')

@section('content')
<div class="content" style="margin: 0; padding: 0;">
<div style="background-color: #026802; padding: 20px; margin-top: 20px; margin-bottom: 50px; display: flex; border: 1px solid #ccc; border-radius: 5px;"> 
    <div class="header-wrapper" style="display: flex; justify-content: space-between; align-items: center; color: white;">
      <div class="header-text" style="margin: 0; padding: 0; text-align: center;">
        <h2 style="font-weight: bold; margin-bottom: 10px; font-size: 30px;">E-JAS</h2>
        <h2 style="font-size: 30px;"><em>(Electronic Judicial Administration System)</em></h2> 
        <h1 class="header-title" style="font-weight: bold; margin-top: 10px; font-size: 35px;">Pengadilan Negeri Balige</h1> 
        <div class="header-navigation" style="text-align: center; margin-top: 10px;">
          <a href="{{ route('login') }}" class="button" style="display: inline-block; padding: 10px 20px; background-color: #089101; color: white; text-decoration: none; border: none; border-radius: 5px;">Masuk</a>
          <a href="{{ route('register') }}" class="button" style="display: inline-block; padding: 10px 20px; background-color: #089101; color: white; text-decoration: none; border: none; border-radius: 5px; margin-left: 10px;">Daftar</a>
        </div>
      </div>
      <div class="logo-container" style="margin-left: 150px;">
        <img src="{{asset('assets/images/logo_pengadilan.png')}}" style="width: 300px; height: 300px;" class="rounded-pill ms-4" alt="">
      </div>
    </div>
  </header>
</div>


<!-- Kotak Putih -->
<div style="background-color: white; padding: 20px; margin-top: 20px; margin-bottom: 50px; display: flex; border: 1px solid #ccc; border-radius: 5px;">
  <div style="flex: 1; text-align: center;">
    <h1 style="margin-bottom: 30px;">Eksekusi Online</h1>
    <p style="text-align: justify;">
    Eksekusi merupakan tindakan paksa yang dilakukan pengadilan dengan bantuan alat negara guna menjalankan putusan pengadilan yang telah memperoleh kekuatan hukum tetap. Selama putusan belum memperoleh kekuatan hukum tetap, upaya dan tindakan eksekusi belum berfungsi. Eksekusi baru berfungsi sebagai tindakan hukum yang sah dan memaksa terhitung sejak tanggal putusan memperoleh kekuatan hukum tetap karena pihak tergugat tidak mau menaati dan memenuhi putusan pengadilan secara sukarela.
    </p>

    <h4 style="padding-left: 0; list-style-position: inside;">Syarat - Syarat Permohonan Eksekusi</h4>
      <ol style="padding-left: 0; list-style-position: inside;">
        <li style="text-align: left;">Surat Permohonan Eksekusi</li>
        <li style="text-align: left;">Fotocopy Putusan Pengadilan Negeri</li>
        <li style="text-align: left;">Fotocopy Putusan Pengadilan Tinggi</li>
        <li style="text-align: left;">Fotocopy Putusan Mahkamah Agung</li>
      </ol>



  </div>
  <div style="flex: 1; text-align: center;">
    <img src="{{asset('assets/images/eksekusi beranda_1.png')}}" style="width: 300px; height: 200px; object-fit: cover; margin-right: 20px; margin-bottom: 50px;" alt="">
    <img src="{{asset('assets/images/eksekusi beranda_2.png')}}" style="width: 300px; height: 200px; object-fit: cover;" alt="">
  </div>
</div>

<!-- Kotak Putih -->
<div style="background-color: white; padding: 20px; margin-top: 20px; margin-bottom: 50px; display: flex; border: 1px solid #ccc; border-radius: 5px;">
  <div style="flex: 1; text-align: center;">
    <h1>Peristiwa Penting</h1>
    <p style="text-align: justify;">
    Eksekusi merupakan tindakan paksa yang dilakukan pengadilan dengan bantuan alat negara guna menjalankan putusan pengadilan yang telah memperoleh kekuatan hukum tetap.
    Selama putusan belum memperoleh kekuatan hukum tetap, upaya dan tindakan eksekusi belum berfungsi.
    </p>
    <p style="text-align: justify;">
    Eksekusi baru berfungsi sebagai tindakan hukum yang sah dan memaksa terhitung sejak tanggal putusan memperoleh kekuatan hukum tetap karena pihak tergugat tidak mau menaati dan memenuhi putusan pengadilan secara sukarela.
    </p>
</div>
  <div style="flex: 1; text-align: center;">
    <img src="{{asset('assets/images/peristiwa penting beranda.png')}}" style="width: 300px; height: 200px; object-fit: cover;" alt="">
  </div>
</div>

<!-- Footer -->
<footer style="background-color: #089101; color: white; padding: 20px;">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; flex-direction: column;"> 
      <!-- Ikon Sosial Media -->
      <a href="https://www.instagram.com/pn_balige?igsh=MTV5YW52aTIweGs1ZA==">
      <img src="{{asset('assets/images/instagram_icon.png')}}" alt="Instagram Icon" style="width: 30px; margin-bottom: 5px;">
      <span style="color: white;">pn_balige</span>
      </a>

      <a href="https://www.facebook.com/pengadilannegeri.balige?mibextid=ZbWKwL">
      <img src="{{asset('assets/images/facebook_icon.png')}}" alt="Instagram Icon" style="width: 30px; margin-bottom: 7px;">
      <span style="color: white;">Pengadilan Negeri Balige</span>
      </a>

      <a href="">
      <img src="{{asset('assets/images/gmail_icon.png')}}" alt="Instagram Icon" style="width: 30px; margin-bottom: 5px;">
      <span style="color: white;">it.pnbalige@gmail.com</span>
      </a>
      
      <a href="">
      <img src="{{asset('assets/images/teleon_icon.png')}}" alt="Instagram Icon" style="width: 30px; margin-bottom: 5px;">
      <span style="color: white;">(0632)21077</span>
      </a>

      <a href="">
      <img src="{{asset('assets/images/alamat_icon.png')}}" alt="Instagram Icon" style="width: 30px; margin-bottom: 5px;">
      <span style="color: white;"> Jl. Patuan Nagari No.6 Balige - Sumatera Utara</span>
      </a>
     
    </div>
    <!-- Peta -->
    <div>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.103715002628!2d99.07235291476863!3d2.350384198008445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30495ed3d4c73fb1%3A0xb9cc2d0b9d389e86!2sBalige%2C%20Habinsaran%2C%20Toba%20Samosir%2C%20Sumatera%20Utara%2C%20Indonesia!5e0!3m2!1sen!2s!4v1648531287262!5m2!1sen!2s" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</footer>


</div>
</div>
</div>
</div>
@endsection
