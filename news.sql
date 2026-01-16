-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2026 pada 01.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Keuangan', '2026-01-15 23:43:21'),
(2, 'Bola', '2026-01-15 23:43:48'),
(3, 'Otomotif', '2026-01-15 23:43:55'),
(4, 'Tekno', '2026-01-15 23:43:59'),
(5, 'Travel', '2026-01-15 23:44:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `title`, `category_id`, `thumbnail`, `content`, `views`, `created_at`) VALUES
(1, 'Prakiraan Cuaca Jepang 15-21 Januari 2026, Capai P', 5, 'pi1_1768521001.jpg', 'Di Tokyo, musim dingin Januari umumnya membawa temperatur harian yang rendah, seringkali berkisar antara sekitar 2°C hingga 13°C. Cuaca cenderung dingin dengan dominasi cerah atau sedikit berawan, terutama pada siang hari, meskipun kemungkinan hujan ringan atau gerimis tetap ada terutama di pertengahan hingga akhir periode. \r\nKondisi ini cocok untuk wisata kota dengan pemandangan musim dingin dan puncak gunung Fuji yang tampak jelas di hari-hari cerah.\r\n\r\nRekomendasi Pakaian \r\n- Jaket atau mantel tebal berlapis sebagai item utama.\r\n- Pakaian dalam hangat seperti sweater, turtleneck, pakaian dalam termal, dan kaos lengan panjang.\r\n- Aksesori hangat: sarung tangan, syal, topi wol/topi hangat karena angin pagi dan malam bisa cukup menusuk.\r\n- Sepatu tertutup tahan air dengan kaos kaki tebal agar tetap nyaman saat jalan-jalan, terutama jika ada gerimis atau lantai basah.\r\n- Rompi atau jaket lipat bisa membantu saat masuk ruangan yang hangat, karena banyak ruang di Tokyo menggunakan pemanas yang kuat.\r\n\r\nRekomendasi Kuliner \r\nMusim dingin menjadikan Tokyo waktu yang tepat untuk menikmati hidangan dan minuman hangat yang nikmat setelah seharian berjalan di udara dingin.\r\nWinter\r\nHome Liburan ke Jepang Tour dan Lainnya\r\nPrakiraan Cuaca Jepang 15-21 Januari 2026, Capai Puncak Musim Dingin\r\nKompas.com - 15/01/2026, 17:25 WIB\r\n \r\n \r\n \r\nKomentar\r\nSumiyoshi Taisha, kuil di Osaka, Jepang.Lihat FotoLihat Foto\r\nSumiyoshi Taisha, kuil di Osaka, Jepang.\r\nSumiyoshi Taisha, kuil di Osaka, Jepang.\r\nPrakiraan cuaca Tokyo 15-21 Januari 2026.\r\nTaiyaki, kue bentuk ikan isi pasta kacang merah khas Jepang.\r\nPrakiraan cuaca Osaka 15-21 Januari 2026.\r\nSaran baju musim dingin di Jepang, pakai jaket tebal dan topi hangat.\r\nPrakiraan cuaca Hokkaido 15-21 Januari 2026.\r\nPakaian musim dingin di Jepang terdiri dari beanie, mantel tebal, syal, dan sarung tangan.\r\nMille-feuille dan caffe latte cocok jadi santapan musim dingin di Jepang.\r\nMulailah dengan oden, semangkuk kaldu yang berisi aneka bahan seperti telur, lobak, tahu, dan konnyaku yang direbus perlahan dan terasa sangat menghangatkan tubuh.\r\nHidangan lain seperti miso ramen juga populer di musim dingin karena kuahnya yang pekat dan panas, cocok untuk mengusir dingin.\r\nSebagai pelengkap, taiyaki (kue ikan berisi pasta kacang merah hangat) dan dorayaki bisa dinikmati sambil berjalan-jalan di sekitar distrik seperti Asakusa atau Ueno.\r\nTeh hijau panas adalah pilihan klasik yang menghangatkan, sering disajikan di izakaya lokal atau kedai teh tradisional.\r\nBeragam kafe di Tokyo juga menyajikan latte atau minuman cokelat panas yang creamy dan pas dinikmati sembari melihat suasana kota.\r\nNikmati juga camilan musim dingin khas Jepang seperti yaki imo (ubi panggang) yang dijual di gerobak pinggir jalan.\r\nRasanya manis, hangat, dan sangat cocok untuk cuaca dingin Tokyo di pertengahan Januari.', 0, '2026-01-15 23:50:01'),
(2, 'Gratis Tiket Wisata Trenggalek bagi Penumpang yang', 5, 'pi2_1768521100.jpg', 'Bupati Trenggalek Mochamad Nur Arifin atau yang akrab disapa Mas Ipin akan memberi tiket gratis ke berbagai destinasi di Kabupaten Trenggalek bagi seluruh penumpang Super Air Jet rute Jakarta – Bandara Dhoho Kediri. \r\nKebijakan ini disampaikan Mas Ipin sesaat setelah dirinya menjajal penerbangan perdana Super Air Jet dari Jakarta menuju Bandara Internasional Dhoho Kediri, Jawa Timur. “Bagi penumpang Super Air Jet dari Jakarta ke Kediri, cukup menunjukkan boarding pass untuk menikmati wisata di Trenggalek secara gratis. Saya sudah meminta Dinas Pariwisata dan pengelola desa wisata untuk menyesuaikan kebijakan ini,” ujar Mas Ipin dilansir dari Antara (11/11/2025).\r\nLangkah ini, menurutnya, merupakan bagian dari strategi promosi destinasi wisata Trenggalek sekaligus bentuk dukungan terhadap konektivitas Bandara Dhoho Kediri sebagai pintu masuk kawasan selatan Jawa Timur.', 0, '2026-01-15 23:51:40'),
(3, 'Betulkah Jalur Kereta Purwokerto - Wonosobo Akan D', 5, 'pi3_1768521307.jpg', 'Beberapa daerah di Jawa Tengah, seperti Purbalingga, Banjarnegara, dan Wonosobo, ternyata dulunya dilalui kereta api. Jalur kereta api ini membentang dari Purwokerto. Namun, jalur ini dinonaktifkan pada tahun 1978. Rencana reaktivasi jalur kereta api (KA) Purwokerto–Wonosobo pun kembali menjadi perbincangan hangat di media sosial. Warganet di platform X ramai menyoroti potensi besar dari jalur sepanjang 92 kilometer itu, terutama untuk mendukung distribusi hasil pertanian, perkebunan, dan peternakan di wilayah Jawa Tengah bagian selatan.\r\nPerbincangan ini mencuat setelah ramai pemberitaan tentang pembangunan jaringan KRL baru di Jawa Tengah yang akan melayani rute Semarang, Demak, hingga Pekalongan.\r\nSalah satu pengguna akun X dengan nama @r*******n menulis, “Reaktivasi rel Purwokerto–Wonosobo penting juga, karena potensi gede untuk kiriman hasil pertanian, perkebunan, peternakan.” Unggahan tersebut pun memicu banyak tanggapan dari pengguna lain yang menilai jalur-jalur lama di Jawa Tengah perlu dihidupkan kembali untuk memperkuat konektivitas dan mendorong pertumbuhan ekonomi daerah.\r\n\r\nMenanggapi isu tersebut, Vice President Public Relations PT Kereta Api Indonesia (KAI) Anne Purba menjelaskan bahwa reaktivasi jalur Purwokerto–Wonosobo memang merupakan bagian dari program pengembangan perkeretaapian nasional yang saat ini tengah dikaji bersama Kementerian Perhubungan (Kemenhub). “Dalam pengembangan perkeretaapian, baik perkotaan maupun antarkota, prosesnya selalu melalui kajian dan koordinasi dengan regulator, yaitu Direktorat Jenderal Perkeretaapian (DJKA) Kemenhub,” ujar Anne saat dikonfirmasi, Jumat (31/10/2025).\r\nIa menambahkan, rencana tersebut sudah tercantum dalam Rencana Induk Perkeretaapian Nasional (RIPNAS) 2030, yang mencakup berbagai kegiatan pengembangan seperti reaktivasi jalur nonaktif dan elektrifikasi jaringan di masa mendatang. “Dalam rencana induk perkeretaapian yang dikeluarkan Kementerian Perhubungan sampai 2030, memang ada kegiatan pengembangan, termasuk reaktivasi dan elektrifikasi. Beberapa jalur bisa dibuka terlebih dahulu dengan kereta nonlistrik, sambil menunggu kesiapan elektrifikasi,” jelas Anne.', 0, '2026-01-15 23:55:07'),
(4, 'Kadin: Dunia Usaha RI Berat Jika Rupiah Tembus Rp ', 1, 'pi4_1768521424.jpg', 'Wakil Ketua Umum Bidang Analisis Kebijakan Makro-Mikro Ekonomi Kamar Dagang dan Industri (Kadin) Indonesia Aviliani menilai, pelemahan nilai tukar rupiah terhadap dollar Amerika Serikat (AS) berpotensi memberikan tekanan luas terhadap kondisi makroekonomi nasional, terutama bagi dunia usaha dan inflasi. \r\nMenurut Aviliani, nilai tukar rupiah idealnya tidak melemah hingga menembus level Rp 17.000 per dollar AS. Jika hal itu terjadi, dampaknya dinilai akan cukup berat bagi pelaku usaha. “Kita berharap jangan sampai itu sampai Rp 17.000 atau lebih ya. Karena memang itu akan berdampak pada dunia usaha,” ujar Lili dalam acara \"Kadin: Global & Domestic Economic Outlook 2026\" di Jakarta, Kamis (15/1/2026). Ia menjelaskan, pelemahan rupiah akan langsung meningkatkan beban utang luar negeri perusahaan sekaligus biaya impor. Pasalnya, sekitar 70 persen industri di Indonesia masih bergantung pada bahan baku impor.\r\nAviliani menilai Bank Indonesia (BI) akan berupaya menjaga stabilitas nilai tukar agar rupiah tidak melemah terlalu dalam.\r\nNamun, tekanan terhadap rupiah saat ini dinilai cukup kuat, terutama akibat keluarnya dana investor asing dari pasar keuangan domestik. “Yang terjadi memang kalau kita lihat dari data, investor asing itu dari SRBI keluar cukup banyak, hampir Rp 100 triliun. Kemudian dari SBN totalnya hampir Rp 122 triliun,” tuturnya. \r\nDalam kondisi tersebut, Aviliani berharap kebijakan Devisa Hasil Ekspor (DHE) yang akan diterapkan pemerintah dapat membantu menjaga cadangan devisa sekaligus menopang nilai tukar rupiah. Meski demikian, ia mengingatkan pentingnya menjaga keseimbangan dengan ketersediaan likuiditas dollar di pasar. “Sehingga kalau dollar mahal itu juga akan berdampak pada kredit dalam USD. Jadi ini harus dijaga keseimbangan antara peraturan DHE dengan likuiditas dolar di pasar, itu yang harus dijaga,” ujar Aviliani.', 0, '2026-01-15 23:57:04'),
(5, 'Rupiah Hari Ini Ditutup Turun 31 Poin ke Level Rp ', 1, 'pi5_1768521588.jpg', 'Nilai tukar rupiah terhadap dollar Amerika Serikat (AS) ditutup melemah pada akhir perdagangan Kamis (15/1/2026). Mata uang garuda turun 31 poin atau 0,18 persen ke level Rp 16.896 per dollar AS. Pelemahan mata uang Garuda juga tercermin pada Jakarta Interbank Spot Dollar Rate (Jisdor) Bank Indonesia. Kurs referensi tersebut tercatat melemah ke posisi Rp 16.880 per dollar AS. Analis mata uang Doo Financial Futures, Lukman Leong, mengatakan tekanan terhadap nilai tukar rupiah masih datang dari kombinasi faktor eksternal dan domestik. Dari sisi global, dollar AS tetap berada dalam tren kuat seiring rilis data ekonomi AS yang lebih baik dari perkiraan pasar, serta pernyataan bernada hawkish dari sejumlah pejabat The Federal Reserve (The Fed) yang memperkuat ekspektasi suku bunga tinggi bertahan lebih lama.\r\n\r\nKondisi tersebut membuat aliran modal global cenderung kembali ke aset berdenominasi dollar AS dan menekan mata uang negara berkembang, termasuk rupiah.\r\n\r\n“Rupiah masih dalam tekanan baik internal maupun eksternal. Dollar AS sendiri masih cukup kuat didukung oleh data-data ekonomi yang lebih baik dari perkiraan dan pernyataan hawkish dari pejabat The Fed,” ujar Lukman kepada Kompas.com. Dari dalam negeri, sentimen negatif masih dipicu oleh kekhawatiran pasar terhadap potensi defisit fiskal yang dapat menembus ambang 3 persen, serta prospek pemangkasan suku bunga acuan Bank Indonesia (BI) yang dinilai dapat menambah tekanan terhadap stabilitas nilai tukar.', 0, '2026-01-15 23:59:48'),
(6, 'Kepemilikan Asing di SBN Susut, Mantan Gubernur BI', 1, 'pi6_1768521705.jpg', 'Gubernur Bank Indonesia (BI) periode 2013-2018 Agus Martowardojo menyoroti penyusutan porsi kepemilikan Surat Berharga Negara (SBN) oleh investor asing dalam beberpa tahun terakhir. Agus mengungkapkan, pada 2018 atau di akhir masa jabatannya sebagai Gubernur BI, kepemilikan asing atas SBN masih mencapai sekitar 41 persen dari total SBN yang diterbitkan pemerintah. \r\n\r\nNamun, dalam perkembangan terkini, porsi kepemilikan asing atas SBN tercatat merosot tajam menjadi sekitar 13 persen dari total SBN. Dia menilai penyusutan ini bukan sebagai hal positif seperti Indonesia semakin independen karena dominasi asing atas kepemilikan SBN berkurang. \"Jadi kalau 41 persen turun menjadi 13 persen itu adalah suatu isu yang harus diaddress. Enggak bisa kita kemudian hanya mengatakan bahwa \"oh kita sudah punya kekuatan sehingga surat berharga negara ini sekarang dimiliki oleh domestik\', enggak bisa,\" ujarnya saat acara \"Business Outlook Indonesia Business Council (IBC)\" di Jakarta, Rabu (14/1/2026).\r\n\r\nSebaliknya, hal ini justru menjadi alarm bagi independensi BI sebagai bank sentral. Sebab, BI kini menjadi pemilik terbesar SBN, sedangkan SBN diterbitkan pemerintah untuk membiayai fiskal negara. Mengutip data Kontan, pada 14 Mei 2025, porsi kepemilikan asing terhadap total SBN yang dapat ditransaksikan hanya 14,38 persen. Merosot dari posisi akhir 2020 yang mencapai 25,16 persen. Sementara porsi kepemilikan SBN oleh BI pada periode yang sama mencapai 27,28 persen dari total SBN yang dapat ditransaksikan atau sebesar Rp 1.720,6 triliun.\r\n\r\nPadahal pada akhir 2020, porsi kepemilikan BI hanya 11,74 persen. \"Independen itu dia (BI) juga tidak boleh membiayai fiskal. Jadi otoritas fiskal dan otoritas moneter harus berkoordinasi dengan baik, bekerja sama dengan baik, tetapi tidak boleh ada fiscal dominance,\" ucap Agus. \"Fiscal dominance itu adalah fiskal terlalu berperan. Dan untuk membiayai APBN atau fiskal, (pemerintah) menggantungkan diri kepada bank sentral atau otoritas moneter,\" sambungnya.', 0, '2026-01-16 00:01:45'),
(7, 'Pelatih Kamboja Akui Kekuatan Timnas Indonesia, In', 2, 'pi7_1768521952.jpeg', 'Drawing ASEAN Championship 2026 menempatkan Kamboja dan Indonesia dalam satu grup. Kekuatan Timnas Indonesia di bawah John Herdman diwaspadai Kamboja. \r\n\r\nKamboja dan Timnas Indonesia akan bersaing di Grup A ASEAN Championship 2026, turnamen bergengsi Asia Tenggara yang dijadwalkan bergulir pada 24 Juli-26 Agustus 2026. Grup A berisikan juara bertahan Vietnam, Singapura, Timnas Indonesia, Kamboja, dan pemenang playoff (Brunei Darussalam vs Timor Leste). \r\n\r\nKomposisi grup tersebut diketahui setelah drawing ASEAN Championship 2026 dilangsungkan di Jakarta, Kamis (15/1/2026). \"Grup A Vietnam sangat kuat. Indonesia juga. Dua negara kuat,\" ujar pelatih Kamboja, Koji Gyotoku usai drawing ASEAN Championship 2026 yang turut dihadiri KOMPAS.com.\r\n\r\nKamboja sadar tentang tantangan sulit di Grup A ASEAN Championship, ajang yang dulu bernama Piala AFF ini.\r\n\r\nKendati demikian, bukan berarti Kamboja tak berani bermimpi. Mereka ingin menembus fase gugur untuk kali pertama di sepanjang sejarah partisipasi.  \"Target kami adalah melaju ke semifinal,\" tutur Koji Gyotoku menjelaskan misi tim asuhannya. \"Tidak mudah, tapi kami akan berusaha sebaik mungkin dan tentu kami harus mendapatkan hasil bagus melawan Indonesia dan Vietnam, serta tim lain yang juga tangguh,\" tuturnya menambahkan. \"Target kami adalah melaju ke fase gugur. Kamboja tak pernah lolos ke semifinal,\" ucapnya menegaskan.', 0, '2026-01-16 00:05:52'),
(8, 'Saya Coba Oppo Reno 15 Series sebelum Rilis, Pro M', 4, 'pi8_1768522042.jpeg', 'Saya berkesempatan melihat langsung ponsel terbaru Oppo dari keluarga Reno series yang dipamerkan secara eksklusif kepada sejumlah media di Indonesia. Tiga model yang diperkenalkan sebagai penerus Reno 14 series adalah Reno 15F, Reno 15 5G, dan Reno 15 Pro Max. \r\nSaya, Caroline Saskia Tanoto, jurnalis teknologi Kompas.com, bisa langsung memegang ketiga unit tersebut dan menjajal beberapa fitur unggulannya, sebelum ponsel tersebut dirilis di Indonesia. Dari ketiganya, saya melihat Reno 15 Pro Max diposisikan sebagai model tertinggi, karena membawa spesifikasi paling mumpuni. Sementara itu, Reno 15F menjadi varian paling dasar karena beberapa spesifikasinya dipangkas dibanding dua model lainnya.\r\n\r\nMeski begitu, pengalaman awal saat memegang ketiga ponsel ini tidak terasa jauh berbeda. Secara visual, saya juga melihat desain ketiganya sangat mirip. Oppo menghadirkan penyegaran lewat pilihan warna dengan aksen aurora bernuansa futuristik, serta bingkai layar yang tampak lebih tipis. Sekilas, ketiganya terlihat seperti satu keluarga dengan identitas desain yang konsisten.Hanya saja, ada beberapa perbedaan di model Reno 15 Pro Max dan Reno 15 5G.', 0, '2026-01-16 00:07:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, '2026-01-16 00:13:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
