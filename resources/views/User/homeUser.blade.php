@extends('layouts.user')

@section('content')
<style>
        .social-link {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .social-link img {
            width: 50px; /* Sesuaikan ukuran logo */
            height: auto;
            margin-right: 10px; /* Ruang antara logo dan teks */
        }

        .social-link i {
            font-size: 30px; /* Sesuaikan ukuran ikon font */
            margin-right: 10px; /* Ruang antara ikon dan teks */
        }
    </style>
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
        <div class="row">
          <div class="col-4">
             <img class="card-img img-fluid" src="{{asset('assets/images/eksekusi_beranda_1.png')}}" alt="">
          </div>
          <div class="col-8">
            <p style="font-size: 17px">Eksekusi merupakan tindakan paksa yang dilakukan pengadilan dengan bantuan alat negara guna menjalankan putusan 
            pengadilan yang telah memperoleh kekuatan hukum tetap. Selama putusan belum memperoleh kekuatan hukum tetap, 
            upaya dan tindakan eksekusi belum berfungsi.
            </p>
            
            <p style="font-size: 17px">Eksekusi baru berfungsi sebagai tindakan hukum yang sah dan memaksa terhitung sejak tanggal putusan memperoleh 
              kekuatan hukum tetap karena pihak tergugat tidak mau menaati dan memenuhi putusan pengadilan secara sukarela.
            </p>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-4">
             <img class="card-img img-fluid mt-4" src="{{asset('assets/images/eksekusi_beranda_2.png')}}" alt="">
          </div>
          <div class="col-8">
            <div class="mt-5">
              <h5>Syarat - Syarat Permohonan Eksekusi</h5>
            </div>
            <div class="">
              <ol type="1">
                  <li class="mb-2" style="font-size: 17px">Surat Permohonan Eksekusi.</li>
                  <li class="mb-2" style="font-size: 17px">Fotocopy Putusan Pengadilan Negeri.</li>
                  <li class="mb-2" style="font-size: 17px">Fotocopy Putusan Pengadilan Tinggi.</li>
                  <li class="mb-2" style="font-size: 17px">Fotocopy Putusan Mahkamah Agung.</li>
              </ol>
            </div>
          </div>
        </div>
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
          <strong><center><p class="text-body"><em>Tahap Pelaksanaan Eksekusi Perkara</em></p></center></strong>
        </h3>
      </div>

      <div class="card-body">
        <div class="">
              <ol type="1">
                  <li class="mb-2" style="font-size: 15px">
                    Telaah terhadap permohonan eksekusi dilaksanakan oleh Panitera Muda atau Tim yang ditugaskan oleh Ketua Pengadilan Negeri dan dituangkan dalam resume telaah eksekusi;
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Telaah terhadap permohonan eksekusi dilaksanakan oleh Panitera Muda atau Tim yang ditugaskan oleh Ketua Pengadilan Negeri dan dituangkan dalam resume telaah eksekusi;
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Apabila hasil resume telaah eksekusi permohonan tersebut dapat dilaksanakan, maka dilakukan penghitungan panjar biaya eksekusi dan pemohon eksekusi dipersilahkan untuk melakukan pembayaran;
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Ketua Pengadilan Negeri mengeluarkan penetapan peringatan eksekusi/Aanmaning setelah lebih dahulu ada permintaan eksekusi dari Pemohon Eksekusi (Penggugat/Pihak yang menang perkara), dengan mendasarkan pada Pasal 196 HIR atau Pasal 207 RBg. Penetapan peringatan eksekusi berisi perintah kepada Panitera/Juru sita/Juru sita Pengganti untuk memanggil pihak termohon eksekusi (Tergugat/Pihak yang kalah) untuk diperingatkan agar supaya memenuhi atau menjalankan putusan.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Apabila termohon eksekusi (Tergugat/Pihak yang kalah) tidak hadir tanpa alasan setelah dipanggil secara sah dan patut, maka proses eksekusi dapat langsung diperintahkan oleh Ketua Pengadilan Negeri tanpa sidang insidentil untuk memberi peringatan, kecuali Ketua Pengadilan menganggap perlu untuk dipanggil sekali lagi.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Peringatan eksekusi dipimpin oleh Ketua Pengadilan Negeri harus dilakukan dalam pemeriksaan sidang insidentil, dibantu oleh Panitera, dengan dihadiri pihak termohon eksekusi (Tergugat/pihak yang kalah), serta apabila dipandang perlu dapat menghadirkan pemohon eksekusi (penggugat/pihak yang menang perkara).
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Peringatan eksekusi dalam sidang insidentil tersebut dicatat dalam Berita Acara yang ditandatangani oleh Ketua Pengadilan Negeri dan Panitera.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Dalam peringatan eksekusi tersebut Ketua Pengadilan Negeri memperingatkan termohon eksekusi (tergugat/pihak yang kalah) agar memenuhi atau melaksanakan isi putusan paling lama 8 (delapan) hari terhitung sejak diberikan peringatan.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Apabila tenggang waktu terlampaui, dan tidak ada keterangan atau pernyataan dari pihak yang kalah tentang pemenuhan putusan, maka sejak saat itu pemohon dapat memohon kepada Ketua Pengadilan Negeri untukmenindak lanjuti permohonan eksekusi tanpa harus mengajukan permohonan ulang dari pihak yang menang (Pasal 197 ayat 1 HIR/Pasal 208 ayat 1 RBg).
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Apabila perkara sudah dilakukan sita jaminan (conservatoir beslaag), maka tidak perlu diperintahkan lagi sita eksekusi (executorial beslaag). Dan apabila dalam perkara tersebut tidak dilakukan sita jaminan sebelumnya, maka Ketua Pengadilan Negeri dapat mengeluarkan penetapan sita eksekusi. Dalam hal eksekusi pengosongan tidak selalu diletakkan sita eksekusi, dapat langsung dilaksanakan pengosongan tanpa penyitaan.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Dalam hal melaksanakan putusan yang memerintahkan untuk melakukan pengosongan (eksekusi riil), maka hari dan tanggal pelaksanaan pengosongan ditetapkan oleh Ketua Pengadilan Negeri, setelah dilakukan rapat koordinasi dengan aparat keamanan.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Apabila termohon eksekusi merupakan unsur TNI (yang masih aktif atau yang telah purnawirawan), maka harus melibatkan pengamanan Polisi Militer (PM).
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Sebelum melakukan eksekusi pengosongan, terlebih dahulu dilakukan peninjauan lokasi tanah atau bangunan yang akan dikosongkan dengan melakukan pencocokan (konstatering) guna memastikan batas-batas danluas tanah yang bersangkutan sesuai dengan penetapan sita atau yang tertuang dalam amar putusan dengan dihadiri oleh panitera, jurusita/jurusita pengganti, pihak berkepentingan, aparat setempat dan jika diperlukanmenghadirkan petugas Badan Pertanahan Nasional, serta dituangkan dalam Berita Acara.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Dalam hal melakukan pemberitahuan eksekusi pengosongan dilakukan melalui surat (Surat Pemberitahuan) kepada pihak termohon eksekusi, harus dengan memperhatikan jangka waktu yang memadai dari tanggal pemberitahuan sampai pelaksanaan pengosongan.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Pengosongan dilaksanakan dan dilakukan dengan memperhatikan nilai kemanusiaan dan keadilan, dengan cara yang persuasif dan tidak arogan. Misalnya dengan memerintahkan pemohon eksekusi menyiapkan gudang penampungan guna menyimpan barang milik termohon eksekusi dalam waktu yang ditentukan, atas biaya pemohon.
                  </li>
                  <li class="mb-2" style="font-size: 15px">
                    Setelah pengosongan selesai dilaksanakan, tanah atau bangunan yang dikosongkan, maka pada hari itu juga segera diserahkan kepada pemohon eksekusi atau kuasanya yang dituangkan berita acara penyerahan, dengan dihadiri oleh aparat.
                  </li>
              </ol>
            </div>
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
          <a href="https://www.instagram.com/pn_balige?igsh=MTV5YW52aTIweGs1ZA==" target="_blank" class="social-link">
            <i class="ph-instagram-logo"></i>
            <span>pn_balige</span>
          </a>

          <a href="https://www.facebook.com/pengadilannegeri.balige?mibextid=ZbWKwL" target="_blank" class="social-link">
              <i class="ph-facebook-logo"></i>
              <span>Pengadilan Negeri Balige</span>
          </a>

          <a href="mailto:it.pnbalige@gmail.com" target="_blank" class="social-link">
              <i class="ph-envelope"></i>
              <span>it.pnbalige@gmail.com</span>
          </a>

          <a href="tel:+6263221077" target="_blank" class="social-link">
              <i class="ph-phone"></i>
              <span>(0632)21077</span>
          </a>

          <a href="https://maps.app.goo.gl/QvNptDJ3dPnx4iNK6" target="_blank" class="social-link">
              <i class="ph-map-pin"></i>
              <span>Jl. Patuan Nagari No.6 Balige - Sumatera Utara</span>
          </a>
      </div>
      <!-- Peta -->
      <div class="map">
          {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.103715002628!2d99.07235291476863!3d2.350384198008445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30495ed3d4c73fb1%3A0xb9cc2d0b9d389e86!2sBalige%2C%20Habinsaran%2C%20Toba%20Samosir%2C%20Sumatera%20Utara%2C%20Indonesia!5e0!3m2!1sen!2s!4v1648531287262!5m2!1sen!2s" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe> --}}
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.507080802018!2d99.06109377458652!3d2.334459857621063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e046726dc72a9%3A0xc3d9720ebc8b478!2sPengadilan%20Negeri%20Balige!5e0!3m2!1sid!2sid!4v1716223821022!5m2!1sid!2sid" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
