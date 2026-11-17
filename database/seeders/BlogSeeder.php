<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::updateOrCreate(
            ['slug' => '5-media-cetak-untuk-mendukung-kegiatan-hari-sumpah-pemuda-2026'],
            [
                'title' => '5 Media Cetak untuk Mendukung Kegiatan Hari Sumpah Pemuda 2026',
                'category' => 'Product',
                'excerpt' => 'Kenali 5 media cetak untuk kegiatan Hari Sumpah Pemuda 2026, mulai dari spanduk, backdrop, banner, sertifikat, hingga ID card.',
                'author_name' => 'Tim PrimaGraphia',
                'author_image_url' => 'https://api-minio.primagraphia.co.id/web-asset/images/assets/logo-pg-persona.jpg',
                'featured_image_url' => 'https://api-minio.primagraphia.co.id/web-asset/images/blog/03%20%283%29_20261028102425_128.png',
                'content' => <<<'MARKDOWN'
Menjelang peringatan **Hari Sumpah Pemuda pada 28 Oktober 2026**, berbagai instansi, sekolah, kampus, hingga organisasi kepemudaan dapat mempersiapkan kegiatan untuk memperingati semangat persatuan generasi muda Indonesia.

Selain upacara bendera, peringatan Sumpah Pemuda juga dapat diisi dengan seminar, perlombaan, diskusi, maupun kegiatan kreatif. Dalam penyelenggaraannya, media cetak memiliki peran penting untuk menyampaikan informasi, memperkuat identitas acara, serta mendukung kelancaran kegiatan.

Mulai dari spanduk hingga sertifikat, setiap media cetak memiliki fungsi yang dapat disesuaikan dengan kebutuhan penyelenggara.

## Apa Saja Media Cetak yang Dibutuhkan untuk Hari Sumpah Pemuda?

Pemilihan perlengkapan cetak bergantung pada jenis kegiatan, lokasi, serta jumlah peserta. Berikut lima media cetak yang dapat dipersiapkan untuk mendukung berbagai acara peringatan Hari Sumpah Pemuda.

### 1. Spanduk untuk Identitas Kegiatan

Spanduk menjadi salah satu media yang umum digunakan dalam kegiatan sekolah, instansi, maupun organisasi. Spanduk dapat menampilkan nama acara, tanggal pelaksanaan, serta identitas penyelenggara. Penempatannya bisa disesuaikan dengan area kegiatan, seperti halaman sekolah, gerbang masuk, atau lokasi upacara.

Ukuran dan bahan spanduk juga perlu diperhatikan agar informasi tetap terbaca dengan jelas dari jarak yang sesuai.

### 2. Backdrop untuk Panggung dan Dokumentasi

Kegiatan seperti seminar kepemudaan, diskusi publik, atau pentas seni biasanya membutuhkan tampilan panggung yang sesuai dengan konsep acara. **Backdrop custom** dapat digunakan sebagai latar kegiatan dengan menampilkan judul acara, logo penyelenggara, maupun elemen visual bertema Sumpah Pemuda.

Selain mendukung tampilan panggung, backdrop juga membuat dokumentasi foto dan video memiliki identitas acara yang jelas.

### 3. X Banner dan Roll Up Banner untuk Informasi Acara

Berbeda dengan spanduk berukuran besar, X Banner dan Roll Up Banner lebih praktis ditempatkan pada area tertentu. Media display ini cocok digunakan untuk menyampaikan susunan acara, informasi registrasi, petunjuk lokasi, atau agenda kegiatan.

Bentuknya yang mudah dipindahkan memungkinkan penyelenggara menyesuaikan penempatan banner dengan kebutuhan ruang, baik untuk kegiatan indoor maupun area penerimaan peserta.

### 4. Sertifikat untuk Peserta dan Pemenang Lomba

Perlombaan menjadi salah satu bentuk kegiatan yang dapat diselenggarakan untuk memperingati Hari Sumpah Pemuda, seperti lomba pidato, desain poster, atau kompetisi kreativitas. **Sertifikat custom** dapat diberikan sebagai bentuk apresiasi kepada pemenang, peserta, maupun pihak yang berkontribusi dalam kegiatan.

Desain sertifikat sebaiknya memuat nama penerima, kategori penghargaan, identitas penyelenggara, serta informasi acara secara jelas.

### 5. ID Card untuk Identitas Panitia dan Peserta

Pada kegiatan yang melibatkan banyak orang, penggunaan ID card membantu membedakan panitia, peserta, dan pihak penyelenggara. ID card juga memudahkan proses registrasi serta koordinasi selama acara berlangsung, terutama pada seminar, kompetisi, atau kegiatan organisasi.

Informasi seperti nama, jabatan, dan logo penyelenggara dapat disesuaikan dengan kebutuhan masing-masing kegiatan.

## Bagaimana Mempersiapkan Media Cetak agar Siap Digunakan?

Sebelum melakukan pemesanan, pastikan seluruh kebutuhan cetak telah disesuaikan dengan konsep dan lokasi acara. Periksa kembali ukuran, desain, informasi yang dicantumkan, serta jumlah cetakan. Untuk media berukuran besar, pertimbangkan pula posisi pemasangan dan jarak pandang agar hasilnya sesuai dengan kebutuhan.

Persiapan sejak awal membantu penyelenggara memiliki waktu yang cukup untuk proses produksi hingga pemasangan.

## Cetak Kebutuhan Acara di PrimaGraphia

Peringatan Hari Sumpah Pemuda dapat menjadi kesempatan untuk menghadirkan kegiatan yang informatif, kreatif, dan mempererat kebersamaan. Dukungan media cetak yang tepat membantu setiap rangkaian acara tampil lebih terarah dan profesional.

Mulai dari kebutuhan branding event, media promosi, merchandise, hingga berbagai kebutuhan cetak untuk bisnis dan UMKM, semuanya dapat diproduksi dengan kualitas terbaik di PrimaGraphia.

Konsultasikan kebutuhan cetak Anda melalui [WhatsApp toko](https://linktr.ee/primagraphiaofficial?utm_source=ig&utm_medium=social&utm_content=link_in_bio), cabang PrimaGraphia, marketplace resmi di [Shopee @primagraphiaprint](https://shopee.co.id/primagraphiaprint), maupun website resmi [www.primagraphia.co.id](https://primagraphia.co.id).
MARKDOWN,
                'read_time' => 3,
                'published_at' => '2026-10-28 09:00:00',
                'is_published' => true,
            ],
        );
    }
}
