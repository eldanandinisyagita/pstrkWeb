-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Des 2024 pada 18.50
-- Versi server: 10.5.26-MariaDB-0+deb11u2
-- Versi PHP: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elda20si_`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tags` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `agendas`
--

INSERT INTO `agendas` (`id`, `judul`, `deskripsi`, `tgl_mulai`, `tgl_selesai`, `tags`, `lokasi`, `penyelenggara`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'HIMAKOM Berbagi', 'kegiatan berbagi bersama anak yatim', '2024-09-20', '2024-09-21', 'Mahasiswa', 'Panti Asuhan Aisyah', 'HIMAKOM', 1, '2024-08-17 10:04:48', '2024-12-11 23:22:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumnis`
--

CREATE TABLE `alumnis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `generasi` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `kompetensi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alumnis`
--

INSERT INTO `alumnis` (`id`, `nama`, `generasi`, `pekerjaan`, `deskripsi`, `kompetensi`, `foto`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'Fahreza Miranda', 'G14', 'Kepolisian RI Daerah Riau', '\"Saya senang bisa belajar selama 4 tahun di PCR, bisa mengenal banyak orang sebagai teman , orang tua, dna keluarga. Pelajaran yang saya dapatkan juga sangat bermanfaat dan membantu saya saat saya mulai bekerja. Lingkungan belajar yang mendukung membuat saya berkembang pesat.\"', 'Cyber Security', 'wJko6m1I8jUuN0q05nwCavComlkW3NrUVVQK5hfW.png', '2024-08-17 21:20:08', '2024-08-17 21:36:56', 1),
(2, 'Gohar Tamba', 'G17', 'Programmer, PT. Mitra Integrasi Informatika', '\"Selama belajar di PCR, saya merasa sangat didukung untuk berkembang, baik dari segi akademik maupun soft skill. Lingkungan belajarnya kondusif dan dosen-dosennya selalu siap membantu, bahkan di luar jam kuliah. Bekal ilmu yang saya dapatkan di PCR sangat membantu saya dalam memasuki dunia kerja, terutama di bidang teknologi yang selalu berkembang.\"', 'Backend Developer, Cyber Security', 'I7xdzbskn3JycJ82rCYrhgHjrXrs6hzaZhN7A6uC.png', '2024-08-17 21:25:55', '2024-08-17 21:31:47', 1),
(3, 'Lila Handayani', 'G14', 'IT Administrator, PT. Whello Indonesia Prima', '\"PCR tidak hanya mengajarkan ilmu di dalam kelas, tapi juga memberikan banyak pengalaman praktis yang sangat berharga. Saya merasa siap terjun ke industri dengan pengetahuan dan keterampilan yang saya peroleh. Selain itu, kegiatan organisasi dan komunitas di PCR membuat saya belajar banyak tentang kerja tim dan kepemimpinan.\"', 'Computer Network, IoT', 'KYWEZgDLdDhnoRXao9lu2H2JRi9ia2u0cY5jPTB1.png', '2024-08-17 21:28:22', '2024-08-17 21:31:14', 1),
(4, 'Irmarahmita Sari', 'G10', 'System Administrator, BPJS DIY', '\"Saya merasa beruntung bisa kuliah di PCR. Atmosfer kampus yang ramah dan suportif membuat saya nyaman dan termotivasi untuk belajar. Dengan dukungan dosen yang profesional dan fasilitas yang lengkap, saya bisa memahami materi dengan lebih baik dan siap bersaing di dunia kerja. PCR telah membekali saya dengan keahlian yang sangat berguna di pekerjaan saya sekarang.\"', 'Frontend development, Computer Network', 'PIbaLIZXpwPJyXcolVmcHZkTpjA8wndGLczXN47V.png', '2024-08-17 21:30:32', '2024-08-17 21:30:32', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `kompetensi` varchar(255) NOT NULL,
  `matkul` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `pddikti` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dosens`
--

INSERT INTO `dosens` (`id`, `nip`, `nama`, `email`, `foto`, `kompetensi`, `matkul`, `status`, `lampiran`, `pddikti`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, '148809', 'Dr. Eng. Yoanda Alim Syahbana, S.T., M.Sc.', 'Yoanda@pcr.ac.id', 'p85mePJKCypo6csdlPEnTW74wlJydnqPH97o0lFx.jpg', 'Embedded Computer Vision', 'Mikroprosesor dalam Sistem Embedded, Desain Protokol dan Troubleshoot, Intelligent Application Development', 'Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=YAS', 'https://pddikti.kemdikbud.go.id/detail-dosen/puY76MuNeQvxQRJNDd-EGYW8mbmCaujrPpu9EQjfofxcLt0X1q66oZUqe_ZlC1wpxey32w==', NULL, '2024-08-17 10:13:45', 1),
(2, '078504', 'Wenda Novayani, S.S.T., M.Eng', 'wenda@pcr.ac.id', 'KoB3lII1KEaFND0zWWAltKA0WLT0L19PXxGUmzeH.jpg', 'Multimedia (Animation and Game), Mobile Application, GIS', 'Game Dev, Computer Animation, Video Editing, Algorithm and Programming', 'Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=WNY', 'https://pddikti.kemdikbud.go.id/detail-dosen/LvbfJPD94ICrw_FrcJPc5Lbo0xxG1hW1ja65z3GWSmnKbwirnXZYH6Zd0TB57JlbIS365A==', '2024-08-17 19:30:42', '2024-08-17 19:30:42', 1),
(3, '088503', 'Yuli Fitrisia, S.T., M.T.', 'uli@pcr.ac.id', 'CtrDdnApKzAKuGiI8JdYuTkkOeDQRszcj4WZqPl5.jpg', 'Networking, software engineering', 'Jaringan Komputer, Rekayasa Perangkat Lunak', 'Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=ULI', 'https://pddikti.kemdikbud.go.id/detail-dosen/bkaYdpAcEE5MT61ELY-7zd9rarmJqPvUajMG9I57UpPppsiNMpUrKJFrFcfsmYq2cutixA==', '2024-08-17 19:33:29', '2024-08-17 19:33:29', 1),
(4, '078306', 'Mardhiah Fadli, S.T., M.T.', 'mardhiah@pcr.ac.id', 'EnospkLsXu68obCRsZRplxMrUwlraQitIM3sT1uA.jpg', 'Visual Programming, Project Management', 'Sistem Informasi Geografis', 'Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=MDF', 'https://pddikti.kemdikbud.go.id/detail-dosen/adrGwV3b4o0BE5epooa2bTm69cMFnZWqdxok0SlqrZGpb8GQd1fKzLWI7DKMh6SaZehUTg==', '2024-08-17 19:42:22', '2024-08-17 19:42:22', 1),
(5, '078313', 'Memen Akbar, S.Si, M.T', 'memen@pcr.ac.id', '66rBhtCz2yD21P6o0zI9jrMysJervKj7uEhptIiu.jpg', 'Soft Computing, Artificial Intelligence, Machine Learning, Software Engineering', 'Matematika Diskrit, Kecerdasan Buatan, Machine Learning for IoT, Software Testing', 'Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=MMN', 'https://pddikti.kemdikbud.go.id/detail-dosen/y1Rwy2ettYUGHYEQ-mKFCIi7JrMgzB-vLGw5ZckmSc0yjT7bLvpjetBvi5b8G9W3PhsRPw==', '2024-08-17 19:44:01', '2024-08-17 19:44:01', 1),
(6, '048108', 'Dini Nurmalasari, S.T.,M.T.', 'dini@pcr.ac.id', 'zXnW2x9WaxrqO2JKisqoExzsUSEReRiSWycrUxo6.jpg', 'Developer and Administration Database Oracle, Develop Mobile Application (J2ME and Android)', 'Sistem Basis Data, Data Warehouse & OLAP', 'Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=DNS', 'https://pddikti.kemdikbud.go.id/detail-dosen/yjxyaB_2oH1LqM0fqsip2EfUTMo4uwgTvs9gVhOnV24xpaGPg278J_pjnjapNFu9-NT1eQ==', '2024-08-17 19:45:34', '2024-08-17 19:45:34', 1),
(7, '027710', 'Sugeng Purwantoro Edy Suranta G.S, S.T.,M.T.', 'sugeng@pcr.ac.id', 'si073gyq9moY5NLpF5KEmz22EB85Br2h3Ptg5dzr.jpg', 'Computer Networking & Administration, Cisco Network  Certified (CCNA, CCAI), Mobile Application Developement -  Android', 'Jaringan Komputer Dasar, Teknologi Perutean Jaringan,  Teknologi Switching, Teknologi WAN, Rangkaian Digital', 'Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=SGP', 'https://pddikti.kemdikbud.go.id/detail-dosen/347kv7aVXcv_-zJ2mMQQKiVj89UnfKRGGhUO0XwIzeV-zAH1FUBkV-gzdwoa6qxamplKsw==', '2024-08-17 19:47:10', '2024-08-17 19:47:10', 1),
(8, '2057302046', 'ELDA NANDINI SYAGITA', 'pstrk@pcr.ac.id', 'TmD4cBlqMXuvtom594LhEEwqdg5oqf7wRte6bbRZ.jpg', 'Banyak', 'MTK', 'Tidak Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=WNY', 'https://pddikti.kemdikbud.go.id/detail-dosen/LvbfJPD94ICrw_FrcJPc5Lbo0xxG1hW1ja65z3GWSmnKbwirnXZYH6Zd0TB57JlbIS365A==', '2024-08-20 20:57:50', '2024-10-03 19:53:55', 1),
(9, '2057302032', 'Fahreza Miranda', 'agit@gmail.com', 'sZfoju9USpXQkQUK3GCQsapUQi7FG6IOoMrQacY0.jpg', 'dikit', 'Game Dev, Computer Animation, Video Editing, Algorithm and Programming', 'Tidak Aktif', 'https://bp2m.pcr.ac.id/main/searchResult/?inisial=ULI', 'https://pddikti.kemdikbud.go.id/detail-dosen/adrGwV3b4o0BE5epooa2bTm69cMFnZWqdxok0SlqrZGpb8GQd1fKzLWI7DKMh6SaZehUTg==', '2024-10-18 05:51:15', '2024-10-18 05:51:15', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'Bagaimana cara nya mendaftar ke PSTRK?', 'bisa akses link berikut : https://pmb.pcr.ac.id/formulir', '2024-08-17 19:48:46', '2024-08-17 19:48:46', 1),
(2, 'Berapa biaya UKT di PCR?', 'silahkan akses link berikut: https://pmb.pcr.ac.id/panduan/biaya', '2024-08-17 19:49:52', '2024-08-17 19:49:52', 1),
(3, 'PSTRK akreditasinya apa sih?', 'Hallo, kita sudah terakreditasi A, yaa!!', '2024-08-17 19:50:45', '2024-08-17 19:50:45', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `himas`
--

CREATE TABLE `himas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `sejarah` longtext NOT NULL,
  `visi` varchar(255) NOT NULL,
  `misi` longtext NOT NULL,
  `deskripsi` longtext NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `himas`
--

INSERT INTO `himas` (`id`, `nama`, `sejarah`, `visi`, `misi`, `deskripsi`, `foto`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'HIMAKOM', 'Himpunan mahasiswa Program Studi Teknik Komputer ini berdiri Pada Tahun 2001 yang dibentuk oleh mahasiswa Teknik Komputer.', 'Diakui sebagai program studi unggulan di bidang Teknik Komputer dan Teknologi Informasi yang dapat bersaing secara global.', 'Menyelenggarakan Sistem Pendidikan Profesional di bidang Teknik Komputer dan Teknologi Informasi yang Menghasilkan Sumber Daya Manusia, Barang (software dan hardware) dan Jasa (konsultasi ) yang berkualitas. Menghasilkan lulusan yang profesional/terampil dan ahli di bidang Teknik Komputer dan Teknologi Informasi, berpikir terbuka (open minded) serta siap bersaing di pasar global berdasarkan kompetensi dunia Industri pada tingkat Nasional maupun Internasional dengan menyediakan sebuah lingkungan belajar yang baik bagi mahasiswa. Ikut berperan aktif dalam pengembangan asosiasi profesi di bidang komputer dan teknologi informasi yang menunjang kelancaran hubungan institusional dengan masyarakat industri. Mengembangkan dan menerapkan nilai-nilai etika, moral agama dan moral akademis. Mengembangkan Riset terapan yang terkait dengan bidang komputer dan Teknologi Informasi untuk melayani kebutuhan industri yang meliputi kebutuhan sumber daya manusia, konsultasi teknis dan penelitian.', 'Himpunan Mahasiswa Komputer (HIMAKOM) merupakan himpunan mahasiswa yang beranggotakan mahasiswa aktif dan alumni yang berasal dari Program Studi Teknik Komputer. HIMAKOM dibentuk untuk membantu setiap anggotanya dalam mengatasi persoalan edukasi dan sosial diluar maupun di dalam kampus.', 'VpujprW4dtffKD6JM2zcTeCp6NVB3Xd0KcxXHkux.jpg', '2024-08-17 19:57:05', '2024-08-17 19:57:05', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kontens`
--

CREATE TABLE `jenis_kontens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_kontens`
--

INSERT INTO `jenis_kontens` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'Prestasi', '2024-08-17 08:19:27', '2024-08-17 08:19:27'),
(2, 'Kegiatan', '2024-08-17 08:19:49', '2024-08-17 09:35:21'),
(3, 'Berita', '2024-08-17 08:19:57', '2024-08-17 08:19:57'),
(4, 'Fasilitas', '2024-08-17 09:35:29', '2024-08-17 09:35:29'),
(5, 'Akreditasi', '2024-08-17 09:35:35', '2024-08-17 09:35:35'),
(6, 'Profil', '2024-08-17 09:35:41', '2024-08-17 09:35:41'),
(7, 'Foto', '2024-08-17 09:35:51', '2024-08-17 09:35:51'),
(8, 'Video', '2024-08-17 09:35:56', '2024-08-17 09:35:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabinets`
--

CREATE TABLE `kabinets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hima_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kabinets`
--

INSERT INTO `kabinets` (`id`, `nama`, `jabatan`, `departemen`, `tahun`, `foto`, `created_at`, `updated_at`, `hima_id`) VALUES
(1, 'Rayhan Afrinanda', 'Dewan 1', 'Inti', '2021', '7pnoOaxVnPSB6cbbceog8fbgukfo6s8HF2WbVl5Z.png', '2024-08-18 22:04:11', '2024-08-18 22:11:39', 1),
(2, 'Rifqi Rizqullah Syawali', 'Dewan 2', 'Inti', '2021', 'JoHz3z31GsrvkqFm6jlAa07aKL0CTW9J9SgdjsB7.png', '2024-08-18 22:06:21', '2024-08-18 22:10:02', 1),
(3, 'Aldila Putri Hartati', 'Bendahara', 'Inti', '2021', '0qQILKE5NNCbmI1Y5cNcZ8pUOZFdPSjtXruffrIG.png', '2024-08-18 22:08:35', '2024-08-18 22:15:23', 1),
(4, 'Deffa Nurman Hidayat', 'Gubernur', 'Inti', '2021', 'Dqz5pCnuftBNUBcGjTeK59rNrwZ7KAYQcPnfegGP.png', '2024-08-18 22:14:27', '2024-08-18 22:34:42', 1),
(5, 'Ayung Alqadri', 'Wakil Gubernur', 'Inti', '2021', 'k807ZR78eraV4ohKR1oCRU94fyRJ8Qbu2G9VznzA.png', '2024-08-18 22:14:56', '2024-08-18 22:35:24', 1),
(6, 'Widya Sukma Wardani', 'Sekretaris', 'Inti', '2021', 'cnzHnH1Td5EbjkcKN533pQhGZmUrGPwj04Fxohq8.png', '2024-08-18 22:16:19', '2024-08-18 22:16:19', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontaks`
--

CREATE TABLE `kontaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `jenis_kontak` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kontaks`
--

INSERT INTO `kontaks` (`id`, `kontak`, `jenis_kontak`, `created_at`, `updated_at`) VALUES
(1, 'Jl. Umbansari No.1 Rumbai Pekanbaru-Riau 28265', 'Alamat', '2024-08-17 21:42:08', '2024-08-17 21:42:08'),
(3, 'pstrk@pcr.ac.id', 'Email', '2024-08-17 21:43:13', '2024-08-17 21:43:13'),
(4, 'himakom@bem.pcr.ac.id', 'Email', '2024-08-17 21:44:19', '2024-08-17 21:44:19'),
(5, 'https://www.instagram.com/himakom_pcr/', 'Instagram', '2024-08-17 21:46:56', '2024-08-17 21:46:56'),
(6, 'https://www.instagram.com/pstrk_hebat/', 'Instagram', '2024-08-17 21:47:14', '2024-08-17 21:47:14'),
(7, 'https://wa.me/085271273706', 'whatsapp', '2024-08-17 21:47:44', '2024-08-18 21:34:17'),
(8, '085271273701', 'Telepon', '2024-08-17 21:47:53', '2024-08-17 21:47:53'),
(9, 'https://www.youtube.com/@pstrkhebat2036', 'Youtube', '2024-08-17 21:49:01', '2024-08-17 21:49:01'),
(10, 'Ruang PSTRK: Ruang 318, Lantai 3 Politeknik Caltex Riau', 'Alamat', '2024-08-17 21:50:38', '2024-08-17 23:01:25'),
(11, 'https://www.facebook.com/PSTK.PCR?mibextid=ZbWKwL', 'Facebook', '2024-08-18 00:10:40', '2024-08-18 00:10:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontens`
--

CREATE TABLE `kontens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `tags` varchar(255) NOT NULL,
  `tgl_publish` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kontens`
--

INSERT INTO `kontens` (`id`, `judul`, `deskripsi`, `tags`, `tgl_publish`, `status`, `lampiran`, `created_at`, `updated_at`, `admin_id`, `jenis_id`) VALUES
(1, 'Laboratorium Jaringan Komputer', NULL, 'Majalah', '2024-08-18', 'Aktif', 'et3DVX2338rswvCJ7lWdvuFtQyDfaQlbUg84VRBT.png', '2024-08-18 07:06:10', '2024-08-18 07:08:52', 1, 7),
(2, 'Laboratorium Jaringan Komputer', NULL, 'Majalah', '2024-08-18', 'Aktif', 'BGKq1m5wm8oHUYrdOzTWY90ijeLdAN1Hpdz6BfdK.jpg', '2024-08-18 07:14:54', '2024-08-18 07:14:54', 1, 7),
(3, 'Selamat Hari Raya Idul Fitri 1444 H', NULL, 'PSTRK', '2024-08-18', 'Aktif', 'eoQBOTbLSu8EVhNgiuB8vcDZkEP2cwTJdotJXd8i.mp4', '2024-08-18 07:40:20', '2024-08-18 17:44:31', 1, 8),
(5, 'Yayasan PCR Resmi Perpanjang Masa Tugas Dr. Dadang Syarif Sihabudin Sahid sebagai Direktur Hingga 2026', 'Yayasan Politeknik Caltex Riau (YPCR) resmi mengumumkan perpanjangan masa tugas Dr. Dadang Syarif Sihabudin Sahid, S.Si., M.Sc. sebagai Direktur Politeknik Caltex Riau (PCR) hingga periode 2024-2026. Keputusan ini dituangkan dalam SK Yayasan PCR pada hari Rabu, 31 Juli 2024.   Dr. Dadang Syarif Sihabudin Sahid, yang telah memimpin PCR dikenal sebagai sosok bertangan dingin. Di bawah kepemimpinannya, PCR telah berhasil mencapai berbagai kemajuan, termasuk peningkatan kualitas pendidikan, mendapat banyak rekognisi, jejaring yang kuat, peningkatan jumlah mahasiswa, serta berbagai prestasi di tingkat nasional dan internasional.  Ketua Umum YPCR Ir. Akson Brahmantyo mengatakan Keputusan perpanjangan masa tugas Direktur PCR ini diambil berdasarkan hasil rapat YPCR dan Dewan Senat PCR serta sudah sesuai dengan statuta baru.  “Kami mengucapkan terimakasih atas kesediaan menerima amanah dan selamat atas perpanjangan masa tugas Dr. Dadang sebagai Direktur PCR untuk periode 2024 – 2026. Perpanjangan masa tugas Direktur PCR ini sesuai dengan statuta yang baru, dan kami  berharap dengan perpanjangan masa tugas ini, program program strategis PCR bisa dijaga kesinambungannya. Pada kesempatan ini kami juga menyampaikan terima kasih kepada Dewan Senat PCR atas partisipasi aktif dalam proses pemilihan Direktur PCR,” ungkapnya.  Sementara itu, Dr. Dadang menyampaikan rasa terima kasih atas kepercayaan yang diberikan oleh Yayasan dan Senat PCR. Ini adalah amanah yang tidak mudah. Tetapi atas dukungan dan kontribusi penuh dari seluruh civitas, yayasan, tenaga kependidikan, dan alumni, secara bersama-sama berkomitmen bekerja keras untuk membawa PCR ke level yang lebih tinggi.   \"Perpanjangan masa tugas ini merupakan amanah yang harus dipertanggungjawabkan dunia akhirat. Saya akan terus berikhtiar, menjalin sinergi, doa dan dukungan dari semua pihak untuk memberikan yang terbaik bagi PCR, bangsa dan negara,\" pungkasnya', 'Dosen', '2024-08-02', 'Aktif', 'ds5Q9AQ8kbhtBJx3OkIdoTJjFH6Xbd27IShzitif.jpg', '2024-08-18 17:46:39', '2024-08-18 17:55:58', 1, 3),
(6, '854 Mahasiswa Baru Ikuti Informative Study and Orientation (ISO) 2024', 'Sebanyak 854 mahasiswa baru regular program sarjana terapan (D4) Politeknik Caltex Riau (PCR) mengikuti kegiatan Informative Study and Orientation (ISO). Kegiatan ini berlangsung selama empat hari mulai tanggal 12-16 Agustus 2024.Kegiatan ini diresmikan langsung oleh Direktur PCR Dr. Dadang Syarif Sihabudin Sahid, S.Si., M.Sc ditandai dengan pemasangan atribut ISO yaitu name tag kepada para peserta.  Pada sambutannya, Dadang mengatakan ISO merupakan kegiatan penting yang wajib diikuti oleh seluruh mahasiswa baru. Karena ini menjadi bagian dari proses rangkaian pembelajaran di PCR.  “Kegiatan ini merupakan program resmi dari kampus Politeknik Caltex Riau yang bertujuan untuk memberikan pemahaman, informasi dan orientasi kepada anda agar tidak salah arah dalam menjalani empat tahun belajar di PCR,” katanya. Dadang juga berharap kegiatan ini dapat berjalan dengan baik, aman dan selamat.   “Semua informasi orientasi yang diberikan sudah disusun baik oleh tim dosen dan mahasiswa. Sehingga harapannya Anda setidaknya mempunyai muatan awal yang cukup untuk menjalani proses pembelajaran di Politeknik Caltex Riau,\" tambah Dadang.  Orientasi dan informasi ini menjadi penting supaya mahasiswa baru paham dan sudah mempunyai kepedulian. Hal ini  mengandung poin-poin paling penting. Bahwa apapun yang akan mahasiswa baru hadapi sebetulnya bisa dilakukan dengan baik.  ISO merupakan kegiatan pengenalan kehidupan kampus bagi mahasiswa baru di PCR. Kegiatan ini wajib diikuti  setiap mahasiswa baru. Kelulusan ISO menjadi syarat kelulusan yudisium bagi setiap mahasiswa PCR. Pada tahun ini, pelaksanaan ISO dilakukan secara luring yang dipusatkan di Gedung Serba Guna PCR.   Ketua ISO 2024, Chintya Kharisma Putri, S.Tr.T mengatakan, tema ISO tahun ini adalah one campus, one vison.  ” Tema kali ini hal ini dimaksudkan untuk lebih menguatkan nilai-nilai yang ada di dalam Kampus Politeknik Caltex Riau kepada mahasiswa baru. Nilai-Nilai tersebut seperti Disiplin, Kebersamaan dan Cinta lingkungan. Tema tersebut melengkapi slogan PCR: Empowers You to Global Competition,” katanya  Ia menambahkan, dari rangkaian acara, pada ISO 2023 ini pihaknya mengadakan kegiatan Pendidikan Dasar Militer atau Diksarmil serta wawasan kebangsaan selama dua hari. Kegiatan Diksarmil telah dilakukan pada hari pertama ISO.  “Kegiatan Diksarmil ini akan dibantu oleh TNI AD dari Kodim 0313/KPR Kita berharap dengan adanya kegiatan ini para mahasiswa baru memiliki sikap disiplin yang kuat, tangguh secara fisik dan mental serta lebih mencintai NKRI,” tambahnya. Selain itu, pada tahun ini panitia ISO juga mengundang beberapa pemateri diantaranya dari Gojek Pekanbaru, Psikolog, Otoritas Jasa Keuangan Riau, dan Relawan TIK.  ”Kita tidak hanya memberikan penjelasan seputar Politeknik Caltex Riau. Tapi kita juga menggandeng beberapa narasumber untuk memberikan materi kepada mahasiswa baru mulai dari keamanan berkendara, kesehatan mental, bahaya narkoba, pinjaman online, judi online hingga literasi digital,” pungkasnya.', 'Mahasiswa', '2024-08-13', 'Aktif', 'EHRt0vvowtO30u0M2P4XmO7T6VhYnWGLQ724eu9q.jpg', '2024-08-18 17:50:26', '2024-08-18 18:04:48', 1, 3),
(7, '2 Dosen PCR Raih 3 Penghargaan Pada Program VALERIA', 'Dua dosen Politeknik Caltex Riau berhasil meraih tiga penghargaan pada program Transformasi Pendidikan Tinggi Vokasi di Indonesia (VALERIA). Kedua dosen tersebut adalah Dr. Eng. Yoanda Alim Syahbana, S.T., M.Sc. dan Sugeng Purwantoro ESGS, S.T., M.T.  Dr. Eng. Yoanda berhasil meraih penghargaan sebagai Best Presenter untuk Project Action Plan berjudul Establishment of a Teaching Factory in the Information Technology Department. Sedangkan Sugeng berhasil meraih penghargaan sebagai Best Costume dan Best Poster untuk Project Action Plan berjudul Reinforcement of SI-EMAK Implementation in The Workload Assignment Process and Performance Monitoring of PCR Staff to Achieve Better Work Quality. Mereka merupakan dosen dari Jurusan Teknologi Informasi, Program Studi Sarjana Terapan Teknologi Rekayasa Komputer.  ”Alhamdullillah, sebenarnya gak nyangka mendapatkan predikat the best Poster karena semua Poster dan Programnya bagus-bagus. Penyusunan Poster dilakukan berdasarkan tujuan, Output dan Outcome yang ingin dicapai dari PAP yang dibuat sehingga menggambarkan alur Proses yang jelas, terus Capaian dan Simpulan menggambarkan hasil akhir dari PAP yang dibuat walau PAP ini merupakan 1/3 pekerjaan yang harus dilakukan selama tahun 2024 ini. Semoga bisa menginspirasi Desain dan Model Poster yang dibuat agar terlihat ada komunikasi antara poster dan pembaca,” Ungkap Sugeng kepada Tim Humas PCR.  VALERIA merupakan bagian dari hibah internasional yang diperoleh atas kerjasama Politeknik Caltex Riau dan Universitas Ciputra, yang diberikan oleh DAAD melalui DIES NMT yang dikelola Potsdam University, Jerman. VALERIA merupakan implementasi dari DIES National Multiplication Training (NMT) 2023-2024. Program ini menjadi wadah bagi 24 pimpinan Perguruan Tinggi Vokasi (PTV) terpilih dari 23 perguruan tinggi vokasi di Indonesia. Para peserta mendapatkan kesempatan untuk menerapkan praktik kepemimpinan terbaik, berbagi pengalaman, dan mencari solusi terhadap berbagai tantangan pengelolaan perguruan tinggi vokasi.  VALERIA dilaksanakan dalam dua fase kegiatan. Fase I telah dilaksanakan di BSD City pada tanggal 3-7 Desember 2023 sedangkan Fase II berlangsung pada tanggal 26-30 Mei 2024 di Grand Jatra Hotel', 'Dosen', '2024-06-03', 'Aktif', 'oqITLBIbEAsSgt64BH68JmvVgamnp6lkJ7V8FMDb.png', '2024-08-18 18:06:44', '2024-08-18 18:06:44', 1, 1),
(8, 'Dosen PSTRK PCR Berikan Workshop Pemahaman Hardware Cisco kepada Siswa SMK Taruna Persada Dumai', 'Dalam rangka meningkatkan kemampuan dan kompetensi SIswa-siswi Sekolah Menengah Vokasi Daerah di Provinsi Riau, Dosen dan mahasiswa dari Program Studi Teknologi Rekayasa Komputer (PSTRK) Politeknik Caltex Riau memberikan workshop Penguatan Kompetensi Jaringan Komputer Berbasis Hardware Cisco Bagi Siswa Jurusan Teknik Komputer Jaringan SMK Taruna Persada Dumai.  Pelaksanaan PKM ini berkerja sama dengan Sekolah Menengah Vokasi yang ada di Kota Dumai, SMK Taruna Persada Dumai. Kerjasama ini sudah memasuki tahun ke 3 kegiatan kerjasama dibawah paying MoU antara Politeknik Caltex Riau dan SMK Taruna Persada Dumai, artinya setiap tahun mulai dari tahun 2020 sudah terlaksana kegiatan-kegiatan dalam rangka peningkatan kualitas Guru dan Siswa di SMK Taruna Persada Dumai.  Pada kegiatan ini, pihak SMK membantu dalam penyediaan peserta workshop yang terdiri dari SIswa dan beberapa orang Guru pendamping yang akan diberikan pelatihan sementara dari Perguruan Tinggi mempersiapkan dari Kegiatan, Ruangan Laboratorium lengkap dengan alat yang menjadi target kompetensi dari workshop ini, Konsumsi dan juga Narasumber.  Kegiatan pelatihan ini merupakan salah satu kegiatan Pengabdian kepada Masyarakat (PkM) yang wajib dilakukan sebagai bentuk pemenuhan Tri Dharma Perguruan Tinggi. Dosen yang terlibat dalam program pelatihan ini adalah Sugeng Purwantoro E.S.G.S, S.T., M.T., Yuli Fitrisia, S.T., M.T., Wenda Novayani, S.S.T., M.Eng, Dini Nurmalasari, S.T., M.T., Mardhiah Fadly, S.T., M.T., Memen Akbar, S.Si, M.T. dan Dr. Eng. Yoanda Alim Syahbana S.T., M.Sc.    Program PkM ini juga dibantu oleh sejumlah mahasiswa diantaranya Dean Melani Tarihoran, Dandy Hari Praditya, Diva Kurniawan Syahputra, Aulia Rahman A, dan Rima amalia rahmawati, yang kesemuanya berasal dari Program Studi Teknologi Rekayasa Komputer. Bahkan ada 1 orang mahasiswa yang merupakan Alumni dari SMK Taruna Persada Dumai yang menjadi Mitra PkM saat ini.  Sugeng mengungkapkan bahwa tujuan dilakukan program PkM dengan bentuk workshop ini sebagai upaya untuk memberikan pengetahuan, keterampilan dan peningkatan kompetensi bagi para siswa-siswi tentang penggunaan dan pemanfaatan perangkat jaringan seperti Router dan Switch secara Hardware (Hand on Lab) di Laboratorium Jaringan PCR. Agar pada siswa dapat punya pengalaman bagaimana mengelola Jaringan dengan langsung menggunakan perangkat yang mungkin selama ini mereka hanya mendapatkan secara simulasi dengen menggunakan Simulator saja.  “Hal ini juga sebagai bentuk perhatian kami pada sekolah dengan tantangan yang lebih kompleks kedepannya sehingga dapat mempersiapkan peserta didik yang siap menerima tantangan dunia kerja dalam bidang Jaringan dan IT kedepannya,” ungkapnya.  Sementara itu, Eko Saputra, A.Md, selaku Ketua Jurusan Teknik Informatika SMK Taruna persada mengatakan bahwa kegiatan ini merupakan kerjasama kemitraan di bidang Pendidikan yang selama 3 tahun ini sudah dilaksanakan dengan baik, penerima manfaat bukan hanya bagi Siswa-siswi saja tapi guru-guru juga mendapatkan manfaat dari kerjasama ini dengan program-program penguatan kepada Guru-guru.  “Kegiatan ini sangat memberikan kesan yang baik dan manfaat yang besar bagi siswa-siswi SMK kami bahkan kami guru-gurupun mendapatkan keilmuan dan pengetahuan baru terkait penggunaan perangkat Cisco ini secara Hardware yang selama ini kami hanya menggunakan dan memanfaatkan simulator saja untuk pembelajaran di sekolah, sehingga siswa mendapatkan pengalaman baru dalam kegiatan ini,” ungkap Eko.  Dari hasil evaluasi kepuasan kegiatan, para peserta memberikan feedback yang baik  bahwasanya kegiatan ini memberi wawasan baru bagi mereka terkait penggunaan perangkat Jaringan berbasis Hardware Cisco. Pada kegiatan ini juga dilaksanakan Pretest dan Post Test yang hasilnya menunjukan peningkatan yang luar biasa dari awal mereka banyak tidak tahu dan paham dengan hardware dan perangkat cisco (Router dan Switch) setelah workshop terlihat ada peningkatan pemahaman mereka terkait hal ini. Mudah-mudahan kegiatan kemitraan ini tetap terus berjalan bukan hanya dengan SMK Vokasi di Kota Dumai saja tapi seluruh SMK Vokasi bahkan SMA yang ingin mendapatkan Pengalaman dan kompetensi keilmuan yang lebih baik.', 'Dosen', '2023-12-13', 'Aktif', 'QX765dMQekyBdvE75T7DrbuQ1tNoas0MoMlLuAvD.jpg', '2024-08-18 18:09:15', '2024-08-18 18:09:15', 1, 2),
(9, 'Dosen TRK PCR Berikan Aplikasi PPDB dan Pelatihan Penggunaan Aplikasi PPDB untuk MIM 01 Pekanbaru', 'Program Studi Teknologi Rekayasa Komputer (TRK) memberikan aplikasi PPDB (Penerimaan Peserta Didik Baru) beserta pelatihan cara penggunaan aplikasi untuk Madrasah Ibtidaiyah Muhammadiyah (MIM) 01 Pekanbaru. Aplikasi tersebut dibangun oleh mahasiswa PCR untuk membantu pihak sekolah mengelola data pendaftaran peserta didik baru secara online. Aplikasi dirancang dan dibangun sesuai dengan proses bisnis yang ada di MIM 01 Pekanbaru, dengan harapan aplikasi ini nantinya dapat membantu pihak sekolah untuk mengelola data pendaftaran peserta didik baru secara lebih transparan, akuntabel dan akomodatif.  Kegiatan pelatihan ini merupakan salah satu kegiatan Pengabdian kepada Masyarakat (PkM) yang wajib dilakukan sebagai bentuk pemenuhan Tri Dharma Perguruan Tinggi. Dosen yang terlibat dalam program pelatihan ini adalah  Mardhiah Fadhli, S.T, M.T, Dini Nurmalasari, S.T., M.T. , Dr. Eng. Yoanda Alim Syahbana, S.T, M.Sc, Yuli Fitrisia, S.T, M.T, Memen Akbar, S.T, M.T , Sugeng Purwantoro, ESGS, S.T, M.T dan Wenda Novayani, S.T.,M.T.  Program PkM ini juga dibantu oleh sejumlah mahasiswa Program Studi Teknologi Rekayasa Komputer yaitu Syaira Aulia Putri, Maria, Sabam, dan Simon.  Pelaksanaan kegiatan PkM ini dihadiri oleh Kepala Madrasah MIM 01 Pekanbaru Ibu Hasmiati, S.Ag, dan diikuti oleh guru-guru selaku panitia PPDB, Bendahara sekolah dan Bagian tata usaha sekolah. Kegiatan ini dilaksanakan pada tanggal 7 september 2023, dari jam 7.30 sampai jam 12:00 yang dilaksanakan di Laboratorium Komputer Politeknik Caltex Riau. Dalam kegiatan ini juga dihasilkan Perjanjian Kerja Sama (PKS) antara Program Studi Teknologi Rekayasa Komputer dengan Madrasah Ibtidaiyah Muhammadiyah 01 Pekanbaru. Dimana salah satu harapan dari Kepala Madrasah adalah adanya keberlanjutan program dari PSTRK kepada MIM 01 Pekanbaru dalam bentuk apapun kegiatan yang nantinya dapat mensupport sekolah menjadi lebih baik.  Adapun hasil evaluasi dari kegiatan ini, para peserta merasakan sangat puas dengan adanya pemberian aplikasi PPDB dan pelatihan cara penggunaan aplikasi untuk sekolah dan mengucapkan terimakasih kepada PSTRK yang sudah mau peduli terhadap kemajuan sekolah.  Mereka berharap kedepan nya PSTRK akan terus memberikan kontribusi dalam bentuk pemberian pelatihan -pelatihan serupa untuk meningkatkan kompetensi guru dan peserta didik di MIM 01 Pekanbaru.', 'Dosen', '2023-09-07', 'Aktif', 'ygwp1TEeka2DNabKmcRPg4Jx1IQ8PeFlI4X66W8B.jpg', '2024-08-18 18:19:41', '2024-08-18 18:19:41', 1, 2),
(10, '11 Mahasiswa PCR Lolos IISMA 2023 di 6 Negara', 'Prestasi gemilang kembali dicatat oleh Mahasiswa Politeknik Caltex Riau (PCR). Sebanyak 11 (sebelas) mahasiswa PCR berhasil lolos seleksi Indonesian International Student Mobility Awards (IISMA) 2023. Mahasiswa tersebut akan mengikuti perkuliahan selama satu semster di Jerman, Australia, Prancis, Taiwan, UK dan Malaysia.  IISMA adalah adalah skema beasiswa dari Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia untuk membiayai pelajar Indonesia dalam program mobilitas satu semester di universitas terkemuka di luar negeri. Beasiswa ini menawarkan dua skema untuk mahasiswa sarjana dan vokasi.  Direktur PCR, Dr. Dadang Syarif Sihabudin Sahid, S.Si., M.Sc. mengatakan bahwa jumlah mahasiswa yang berhasil lolos IISMA pada tahun ini mengalami peningkatan dari tahun sebelumnya.  “Setelah melalui serangkaian proses mulai dari persiapan, bootcamp, dan beberapa tahap seleksi, akhirnya ke-11 mahasiswa ini dinyatakan lolos. Alhamdulillah, jumlah mahasiswa tahun ini meningkat dari tahun sebelumnya,” ucap Dadang, Senin (17/4/2023).  Dadang juga mengucapkan apresiasi atas capaian mahasiswa PCR yang berhasil lolos dalam program IISMA tahun ini.  “Mewakili sivitas akademika PCR mengucapkan selamat atas capaian yang diraih oleh 11 mahasiswa yang berhasil lolos pada program IISMA tahun 2023. Manfaatkan waktu selama satu semester di luar negeri untuk bisa menambah pengetahuan dan wawasan. Saya berharap nantinya kalian dapat membagikan ilmu-ilmu yang didapat selama kegiatan kepada para teman-teman di kampus, sehingga dapat menumbuhkan minat untuk mengikuti program ini pada tahun depan,” ujarnya  Dadang juga mengatakan, bagi mahasiswa di daerah, dapat mengenyam pendidikan satu semester di belahan dunia lain tentu akan menjadi milestone yang berarti. Tidak hanya sekedar menjalani, tapi ada misi dan mimpi yang menjadi destinasi. Maka dari itu, saya berpesan kepada para mahasiswa yang lolos pada program IISMA tahun 2023 ini agar senantiasa menjaga nama baik almamater.  “Kalian adalah duta PCR di negara asing, senantiasa belajar dan bekerja keras agar dapat mengikuti program tersebut berjalan dengan baik. Selain belajar ilmu pengetahuan, kalian juga bisa belajar bagaimana kebudayaan di sana. Kalian juga bisa melihat dan mempelajari bagaimana budaya kerja di negara-negara maju sehingga hal-hal yang baik bisa dibawa pulang untuk meningkatkan kinerja institusi dan individu,” harapnya.  Sementara itu, Wakil Direktur Bidang Pemasaran, Kerja Sama dan Alumni Zainal Arifin Renaldo, S.S., M. Hum. mengatakan bahwa IISMA tahun ini merupakan kali kedua mengirimkan perwakilan untuk mengikuti seleksi.  “Pada tahun ini kita mengirimkan 17 perwakilan dari PCR untuk mengikuti proses seleksi dan pendaftar program ini juga sangat banyak hingga 1.452 pendatfar yang tersebar dari beberapa perguruan tinggi vokasi yang ada di Indonesia. Alhamdulillah dari 17 orang yang kita kirimkan, 11 orang mahasiswa dinyatakan lolos. Capaian ini merupakan hasil yang sangat baik. Sebaran universitas juga beragam. Selamat juga saya sampaikan kepada para mahasiswa yang lolos,” ungkapnya  Zainal juga menambahkan bahwa untuk mendukung kegiatan ini, PCR memberikan program latihan rutin kepada para mahasiswa yang akan mengikuti seleksi.  “Saya dibantu beberpa pihak dosen dan awardee IISMA PCR tahun 2022 memberikan program latihan kepada para peserta. Mulai dari pembuatan essay dan Teknik wawancara. Selain itu, PCR juga memberikan mereka program uji kompetensi Bahasa Inggris Duolingo yang menjadi syarat utama mereka untuk mendaftar pada program ini yang pembiayaannya ditanggung oleh PCR,” tambahnya  Ia berharap agar 11 mahasiswa PCR tersebut dapat belajar dengan baik selama satu semester di universitas pilihan. Selain itu, Ia juga berpesan agar mereka dapat menjalin relasi dengan warga lokal, mahasiswa internasional, dan juga membuka jejaring kerja sama.  Berikut merupakan sebelas mahasiswa Politeknik Caltex Riau yang lolos untuk mengikuti IISMA 2023 diantaranya adalah Ivonne Vanessa Suwito (Sistem Informasi) diterima di Deggendorf Institute of Technology Jerman. Feren Fasella (Sistem Informasi), Sarah Celia Jely (Teknologi Rekayasa Komputer), Rizqal Ahmad Riansyah (Teknik Informatika) diterima di IU International University of Applied Sciences Jerman.  Nicholas Giustino (Teknik Mesin) diterima di University of Portsmouth, UK. Farah Meutia Zahra dan Livanni Wijaya (Teknik Informatika) diterima di RUBIKA Prancis. Devina Faustine Gazali (Sistem Informasi) diterima di La Trobe University Australia.  Kemudian Irfan (Sistem Informasi) diterima di Asia University, Taiwan. Favian Hugo Dimitri (Teknik Elektronika Telekomunikasi) diterima di Universiti Teknologi Malaysia serta Rizky Saputra Tarigan (Teknologi Rekayasa Mekatronika) diterima di Universiti Malaysia Pahang.', 'Mahasiswa', '2023-04-17', 'Aktif', 'rW0PhUyaQ8Ets7UVNFLuzaKA7znfr4zx6sJwkRAD.jpg', '2024-08-18 18:23:02', '2024-08-18 18:23:02', 1, 1),
(11, 'Pertemuan Jurusan Teknologi Informasi', 'Jurusan Teknologi Informasi (JTI) kembali melakukan pertemuan rutin. Kegiatan ini diikuti oleh seluruh dosen dan instruktur laboratorium dibawah jurusan. Kegiatan ini berlangsung pada hari Senin, 26 Februari 2024 di Auditorium PCR.  Ketua Jurusan Teknologi Informasi Dr. Eng. Yoanda Alim Syahbana, S.T., M.Sc. mengatakan bahwa kegiatan ini merupakan ajang sosisalisasi dan koordinasi program kerja PCR yang akan diimplementasikan menjadi program kerja JTI dan rencana kegiatan pada tahun 2024. Selain itu, Pada pertemuan ini juga didiskusikan perkembangan Teaching Factory di JTI, strategi peningkatan prestasi mahasiswa, strategi untuk lulusan 2024, dan refleksi JTI atas capaian tahun 2023.  Yoanda juga mengungkapkan bahwa fokus kerja yang bersinggungan langsung dengan sivitas akademika JTI diharapkan dapat dipahami dan dilaksanakan untuk mencapai target-target PCR.', 'Dosen', '2024-02-26', 'Aktif', 'vunv2dKxDgC8DuN8eZpU8OTQ0Ra6SD2NjMCNsPav.jpg', '2024-08-18 18:31:12', '2024-08-18 18:31:12', 1, 2),
(12, 'Bronze Medal !! Bidang keamanan jaringan (Cyber Security)', 'Politeknik Caltex Riau kembali meraih prestasi tingkat nasional. Prestasi kali ini pada bidang keamanan jaringan (Cyber Security). Tim Pocari berhasil mendapatkan Bronze Medal pada ajang Cisco NetAcad Indonesia Capture The Flag 2023.  Prestasi ini diraih oleh Andre Prisya Lubis dan Rizki Fajri dengan instruktur Sugeng Purwantoro ESGS, S.T., M.T.. Mereka berdua merupakan mahasiswa dari Program Studi Sarjana Terapan Teknik Informatika dan Teknologi Rekayasa Komputer.  Kompetisi ini diselenggarakan oleh Cisco Networking Academy Indonesia.  Selamat atas prestasi yang diraih.', 'Mahasiswa', '2023-11-02', 'Aktif', 'NWQUnyyYrhsLx9D7rcazxORPu8lmoBrZ49cQH6tV.png', '2024-08-18 18:38:04', '2024-08-18 18:38:04', 1, 1),
(13, 'PSTRK Hebat !! Juara 1 & 3 pada Techwave 2023', 'Selamat atas prestasinya di acara Techwave 2023 untuk tim @simonsbr10 dan tim @doctokill_net Dan rekan tim lainnya  Karena telah meraih Juara 1 pada cabang Karya Tulis Ilmiah dan Juara 3 pada cabang IoT  Congrats teman teman 🥳🔥', 'Mahasiswa', '2023-05-29', 'Aktif', '9kW4k9LWspH1o5Fo58OJ4aAh8GT1jqp5ONvktXR3.png', '2024-08-18 18:59:43', '2024-10-03 19:56:47', 1, 1),
(14, 'Kegiatan Capstone Project Prodi Teknologi Rekayasa Komputer', 'Pada tanggal 12 Juli 2023, Program Studi Teknologi Rekayasa Komputer (PSTRK) mengadakan kegiatan Capstone Project yang diikuti oleh seluruh kelas di PSTRK. Acara ini menjadi ajang bagi mahasiswa untuk mempresentasikan hasil kerja keras mereka dalam proyek akhir yang mengintegrasikan berbagai disiplin ilmu yang telah dipelajari selama masa perkuliahan.  Kegiatan ini berlangsung dengan penuh semangat, di mana para mahasiswa memaparkan ide-ide inovatif dan solusi kreatif melalui presentasi yang ditampilkan di depan dosen-dosen penguji. Setiap tim dengan percaya diri menjelaskan rancangan sistem mereka, termasuk pembuatan Entity-Relationship Diagram (ERD) seperti yang terlihat pada gambar, yang menjadi salah satu aspek penting dalam perancangan data.  Para dosen penguji dengan serius mendengarkan setiap presentasi, memberikan masukan yang berharga, dan mengevaluasi proyek-proyek yang dipresentasikan. Kegiatan ini tidak hanya menjadi sarana untuk mengukur kemampuan teknis para mahasiswa, tetapi juga menjadi wadah untuk mengembangkan kemampuan komunikasi, kerja tim, dan pemecahan masalah.  Dengan semangat yang tinggi, acara ini diharapkan dapat memotivasi para mahasiswa untuk terus berinovasi dan mengembangkan pengetahuan mereka, serta siap menghadapi tantangan di dunia kerja setelah menyelesaikan pendidikan di PSTRK.', 'Mahasiswa', '2023-07-12', 'Aktif', 'Q2XlnHHBreuhKFHrIAxrnshVSLpyq15lnCKK1BpH.jpg', '2024-08-18 19:21:04', '2024-08-18 19:21:04', 1, 2),
(15, '3 Minutes Project Competitions', 'Pada hari Rabu, tanggal 2 Agustus 2023, Prodi Teknologi Rekayasa Komputer (PSTRK) Politeknik Caltex Riau telah sukses menyelenggarakan kegiatan tahunan yang sangat dinanti, yaitu 3 Minutes Project Competitions. Kegiatan ini berlangsung dengan penuh antusiasme di Aula Utama Kampus, diikuti oleh seluruh mahasiswa PSTRK dari berbagai tingkat angkatan.  Acara ini dimulai pada pukul 08.00 WIB dengan sambutan dari Ketua Program Studi Teknologi Rekayasa Komputer, yang menyampaikan pentingnya kompetisi ini dalam mengasah kemampuan mahasiswa dalam menyampaikan ide dan hasil proyek mereka secara efektif dalam waktu yang sangat terbatas. Setiap peserta diberikan waktu tepat 3 menit untuk mempresentasikan proyek mereka di hadapan para juri yang terdiri dari dosen-dosen berpengalaman serta praktisi industri.  Peserta menunjukkan berbagai inovasi dan hasil karya mereka yang mencakup beragam aspek teknologi, mulai dari pengembangan perangkat lunak, rekayasa sistem, hingga implementasi teknologi terbaru dalam solusi praktis. Setiap presentasi dinilai berdasarkan kriteria yang mencakup orisinalitas ide, kejelasan penyampaian, relevansi proyek, dan kematangan teknis.  Kompetisi ini bertujuan tidak hanya untuk menilai kemampuan teknis mahasiswa, tetapi juga untuk mendorong mereka agar dapat berpikir kritis dan kreatif, serta mampu mengkomunikasikan ide-ide mereka dengan efektif dalam situasi yang menuntut kecepatan dan ketepatan. Kehadiran para juri memberikan penilaian yang objektif dan konstruktif, membantu mahasiswa dalam memahami kekuatan dan area yang perlu mereka tingkatkan dalam proyek mereka.  Acara ini diakhiri dengan pengumuman para pemenang yang berhasil menunjukkan performa terbaik dalam waktu yang sangat terbatas tersebut. Kegiatan 3 Minutes Project Competitions ini diharapkan dapat terus menjadi wadah bagi mahasiswa PSTRK untuk menampilkan bakat dan kemampuan mereka, serta menjadi langkah awal menuju keberhasilan di dunia profesional.', 'Mahasiswa', '2023-08-02', 'Aktif', 'M9i45nbIhCfllPmlNpGuJ3BTmi1XnegzguXRconl.jpg', '2024-08-18 19:30:07', '2024-08-18 19:36:07', 1, 2),
(16, 'Himakom Sport Day 1', NULL, 'Mahasiswa', '2024-08-19', 'Aktif', 'uwpFBTbWg0ahq5xMvQ5zrYQjzOhYPRqvqaeS8uwq.jpg', '2024-08-18 20:06:47', '2024-08-18 20:06:47', 1, 7),
(17, 'Himakom Sport Day 1', NULL, 'Mahasiswa', '2024-08-19', 'Aktif', 'Ov1aDgReftiazt0ZNbxLvYa1P5AGJMAsOVhgSkDo.jpg', '2024-08-18 20:07:34', '2024-08-18 20:07:34', 1, 7),
(18, 'Himakom Sport Day 2', NULL, 'Mahasiswa', '2024-08-19', 'Aktif', 'CqjNYNSfiPIVHuIXBPavTf0vlhRLR4XYmFbc3XEl.jpg', '2024-08-18 20:08:24', '2024-08-18 20:08:24', 1, 7),
(19, 'HIMAKOM Berbagi', NULL, 'Mahasiswa', '2024-08-19', 'Aktif', 'vwg81QhoY8YzB9dTJSpEfqrP1763M9lAokrJu2SL.jpg', '2024-08-18 20:09:11', '2024-08-18 20:11:26', 1, 7),
(20, '3 Minutes Project Competitions', NULL, 'Mahasiswa', '2023-08-02', 'Aktif', 'hIibnOIBcUm67GyQVaUg4U2VUY4MPNN8D9yJYxHw.jpg', '2024-08-18 20:17:06', '2024-08-18 20:17:06', 1, 7),
(21, 'Pertemuan Jurusan Teknologi Informasi', NULL, 'Dosen', '2024-08-19', 'Aktif', 'tsExSQqTVvxkpOY1QklziTVLmXf6qEpLSGeJcQgZ.jpg', '2024-08-18 20:17:40', '2024-08-18 20:17:40', 1, 7),
(22, 'Kegiatan Capstone Project Prodi Teknologi Rekayasa Komputer', NULL, 'Mahasiswa', '2024-08-19', 'Aktif', 'A0CFnXshOhdxADcSaCYsabjhHpeWUX4koqXxUZtH.jpg', '2024-08-18 20:18:20', '2024-08-18 20:18:20', 1, 7),
(23, 'Kegiatan Capstone Project Prodi Teknologi Rekayasa Komputer', NULL, 'Dosen', '2024-08-19', 'Aktif', 'NvxRKX1cxT9UuyPzmJBJASmTzc2THFjBTEG3tpHF.jpg', '2024-08-18 20:18:45', '2024-08-18 20:18:45', 1, 7),
(24, 'Akreditasi tahun 2022 - 2024', 'Akreditasi Teknologi Rekayasa Komputer, Berlaku hingga 31 Agustus 2024', 'PSTRK', '2024-08-19', 'Aktif', '4PYz9IT02vsTY6UagapZLr6S5BZ7pJtWWo75z3MQ.png', '2024-08-18 20:21:03', '2024-08-18 20:21:28', 1, 5),
(25, 'Ruang Kelas Teori', 'Dilengkapi dengan meja dan kursi untuk setiap mahasiswa dan juga dosen. Setiap kelas memiliki 2 AC dan 2 kipas angin. Ruang kelas juga dilengkapi TV dan proyektor serta papan tulis untuk menunjang proses belajar mengajar.', 'Ruang Kelas', '2024-08-19', 'Aktif', 'HVq7TfqodbEfXO0PBQHj8FtIZI0OyWmEsHosNXDw.jpg', '2024-08-18 20:22:32', '2024-08-18 20:24:11', 1, 4),
(26, 'Laboratorium Jaringan Komputer', 'Untuk mendukung pemahaman mahasiswa seputar jaringan, laboratorium ini menyediakan alat ajar pendukung yang sesuai dengan penggunaan di dunia kerja seperti Router, switch, komputer, CPU, dan juga berbagai macam kabel. Selain itu agar proses pembelajaran tetap nyaman, PCR menyediakan 2 AC dan menjaga Lab tetap bersih', 'Ruang Lab', '2024-08-19', 'Aktif', 'YmAcCpBiNvUZKPYyen9gNLGHJRQS2SdDnAOSes87.jpg', '2024-08-18 20:28:06', '2024-08-18 20:28:06', 1, 4),
(27, 'Visi', '\"Diakui Sebagai Program Studi Unggul Yang Mampu Bersaing dalam Bidang Teknologi Komputer Pada Tingkat Nasional maupun ASEAN pada Tahun 2031\"', 'Visi', '2024-08-19', 'Aktif', 'iEsKn60in6T8Ul6x6cmzH859WTjepd4fHGu6lDJt.png', '2024-08-18 20:35:51', '2024-08-18 20:35:51', 1, 6),
(28, 'Misi', 'Menyelenggarakan sistem pendidikan vokasi di bidang Teknologi Komputer yang profesional, berkualitas, serta relevan dengan tantangan nasional ataupun ASEAN. Menciptakan budaya akademik dan budaya organisasi yang nyaman, berkarakter dan bermartabat kepada mahasiswa. Menghasilkan lulusan sarjana terapan yang memiliki keunggulan profesional dan terampil di bidang Teknologi Rekayasa Komputer, memiliki softskill yang baik, berpikiran terbuka, serta mampu bersaing dalam pasar nasional maupun ASEAN. Menyelenggarakan dan mengembangkan penelitian terapan serta menyebarluaskan hasilnya untuk pengembangan inovasi ataupun menyelesaikan masalah-masalah di bidang Komputer sesuai dengan kebutuhan industri serta permasalahan nasional dan global. Menyelenggarakan program pengabdian kepada masyarakat untuk menggali dan membantu pertumbuhan potensi masyarakat yang meliputi kebutuhan Sumber Daya Manusia, barang, ataupun jasa. Ikut berperan aktif dalam asosiasi profesi yang menunjang pengembangan kegiatan akademik dan kelancaran hubungan dengan industri dan pemerintah', 'Misi', '2024-08-19', 'Aktif', 'oLasvg3eWxLfgDBssSoVJa3Y1y2U6L1hfJ1QwUXP.png', '2024-08-18 20:36:28', '2024-08-18 20:36:46', 1, 6),
(29, 'Sejarah PSTRK', 'Program Studi Teknologi Rekayasa Komputer (PSTRK) merupakan transformasi dari Program Studi D3 Teknik Komputer yang didirikan tahun 2001, Program Studi D4 Teknologi Rekayasa Komputer (PSTRK) mengambil tempat dalam arus perkembangan Industri 4.0 menjadi Society 5.0 di bidang kecerdasan buatan, big data, dan cyber security. PSTRK membekali mahasiswanya dengan kemampuan di bidang Embedded System yang cerdas dan adaptif serta kemampuan Jaringan Komputer dan Cyber Security yang mendukung penerapan Big Data dan Internet of Things (IoT). Kurikulum yang disusun dengan melibatkan perwakilan IDUKA, alumni dan pakar kurikulum memastikan relevansi materi perkuliahan untuk mendukung mahasiswa menjadi dua profil lulusan: Engineer of Embedded System (ES), dan Engineer of Computer Network and Security System (CNSS).Mahasiswa juga diberi kesempatan untuk mengikuti berbagai program Merdeka Belajar Kampus Merdeka untuk mendapatkan kompetensi tambahan melalui kegiatan dan pengalaman belajar di program studi lain, institusi lain, dan IDUKA.  Sivitas PSTRK menetapkan H.E.B.A.T sebagai core value yang merupakan akronim dari Handal.Energik.Berkualitas.Adaptif.Totalitas yang diharapkan menjadi panduan dalam menjalankan tri dharma perguruan tinggi di program studi.', 'Sejarah', '2024-08-19', 'Aktif', 'iJApsBgOXewwcaYRvE7vVZewvHsxgtTGeeAgmA4y.png', '2024-08-18 20:40:27', '2024-08-18 20:40:27', 1, 6),
(30, 'Dr. Eng. Yoanda Alim Syahbana, S.T., M.Sc.', 'Selamat datang di website Program Studi Teknologi Rekayasa Komputer yang saya tujukan untuk seluruh unsur pimpinan, guru, karyawan dan siswa serta khalayak umum guna dapat mengakses seluruh informasi tentang sekolah kami. Tentunya dalam penyajian informasi masih banyak kekurangan, oleh karena itu kepada seluruh civitas akademika dan masyarakat umum dapat memberikan saran dan kritik demi kemajuan lebih lanjut.  Saya berharap Website ini dapat dijadikan wahana interaksi yang positif baik antar civitas akademika maupun masyarakat pada umumnya, sehingga dapat menjalin silaturahmi yang erat disegala unsur. Mari kita bekerja dan berkarya dengan mengharap ridho sang Kuasa dan keikhlasan yang tulus demi anak bangsa.', 'Sambutan Kaprodi', '2024-08-19', 'Aktif', 'T4gdMWDEKEuCbhW3V1n8Jhz5rWLLcatYJjd31PzH.png', '2024-08-18 20:42:38', '2024-08-18 20:43:08', 1, 6),
(31, 'Karir Lulusan', 'IT Administrator, Devnet Engineer, Cyber Security Engineer, Cloud Engineer, Computer Network Engineer, System Administrator Programmer, Embedded System Engineer, Internet of Thing Developer, Project Engineer, Chief Technology Officer', 'Prospek Kerja', '2024-08-19', 'Aktif', 'YI59R4J9828NtiHwrdb2cWRQtpEveJUQbsz6SmfM.png', '2024-08-18 20:48:07', '2024-08-18 20:48:54', 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurikulums`
--

CREATE TABLE `kurikulums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `smstr` int(11) NOT NULL,
  `sks_teori` int(11) NOT NULL,
  `jam_teori` int(11) NOT NULL,
  `sks_prak` int(11) NOT NULL,
  `jam_prak` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kurikulums`
--

INSERT INTO `kurikulums` (`id`, `kode_mk`, `nama_mk`, `smstr`, `sks_teori`, `jam_teori`, `sks_prak`, `jam_prak`, `created_at`, `updated_at`) VALUES
(1, 'MK000001', 'Organisasi & Infrastruktur Komputer', 1, 2, 4, 2, 2, '2024-08-17 05:21:18', '2024-08-17 09:16:17'),
(2, 'MK000002', 'Sistem Operasi dasar', 2, 2, 4, 4, 8, '2024-08-17 06:16:59', '2024-08-17 09:16:37'),
(3, 'MK000003', 'Sistem Operasi Lanjutan', 3, 2, 4, 4, 8, '2024-08-17 06:18:16', '2024-08-17 09:16:54'),
(4, 'MK000004', 'Workshop Komputasi Awan', 4, 2, 4, 4, 8, '2024-08-17 06:18:52', '2024-08-17 09:32:15'),
(5, 'MK000005', 'Workshop Keamanan Jaringan & IOT', 5, 2, 4, 4, 8, '2024-08-17 06:19:18', '2024-08-17 09:33:10'),
(6, 'MK000006', 'Workshop Forensik Digital', 6, 2, 2, 3, 6, '2024-08-17 06:20:02', '2024-08-17 09:33:51'),
(7, 'Magang', 'Pancasila', 7, 0, 0, 20, 80, '2024-08-17 06:20:46', '2024-08-17 06:20:46'),
(8, 'MK000008', 'Proyek Akhir', 8, 0, 0, 6, 12, '2024-08-17 06:21:18', '2024-08-17 06:21:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_23_130604_create_agendas_table', 1),
(6, '2024_06_23_130703_create_pesans_table', 1),
(7, '2024_06_23_130723_create_dosens_table', 1),
(8, '2024_06_23_130731_create_alumnis_table', 1),
(9, '2024_06_23_130743_create_jenis_kontens_table', 1),
(10, '2024_06_23_130752_create_kontens_table', 1),
(11, '2024_06_23_130805_create_himas_table', 1),
(12, '2024_06_23_130824_create_kabinets_table', 1),
(13, '2024_06_23_130835_create_kontaks_table', 1),
(14, '2024_06_23_130844_create_kurikulums_table', 1),
(15, '2024_07_19_192834_create_faqs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(30, 'App\\Models\\User', 2, 'auth_token', 'f2cc5a18bd645fa573d68879507c81d1956c238fec4ce386830e6c60e748aaf9', '[\"*\"]', NULL, NULL, '2024-10-02 10:05:38', '2024-10-02 10:05:38'),
(31, 'App\\Models\\User', 2, 'auth_token', 'd963b10c09b9268f056228402981b72dfbe8327e082ace5c962cbf04635c931d', '[\"*\"]', NULL, NULL, '2024-10-02 10:05:43', '2024-10-02 10:05:43'),
(40, 'App\\Models\\User', 1, 'auth_token', '5a3c617abbd1790d200463702cd42f269a4c1df412dd902686a377aaf2d786e5', '[\"*\"]', NULL, NULL, '2024-12-11 23:23:47', '2024-12-11 23:23:47'),
(41, 'App\\Models\\User', 1, 'auth_token', 'af243f9c415bd463edb68ee7a379bbbef8c9a57d52ac36518313aef7b12d939d', '[\"*\"]', NULL, NULL, '2024-12-14 00:17:52', '2024-12-14 00:17:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesans`
--

CREATE TABLE `pesans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `isi_pesan` varchar(255) NOT NULL,
  `balasan` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesans`
--

INSERT INTO `pesans` (`id`, `email`, `isi_pesan`, `balasan`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'elda@gmail.com', 'Bagaimana caranya agar saya bisa mrndaftar ke prodi ini?', 'silahkan ke link PMB untuk mendaftar', NULL, '2024-08-18 21:41:48', 1),
(5, 'khairi@gmail.com', 'hihiihi', NULL, '2024-08-20 20:58:26', '2024-08-20 20:58:26', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rules` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rules`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'pstrk', 'pstrk@pcr.ac.id', NULL, '$2y$12$8e5eju6rdlOtJ4I.45hpOeonsj2J77YXQJ5phctt5UZSoLYxOUvC2', NULL, NULL, '2024-08-17 05:20:10', '2024-08-17 05:20:10'),
(2, '323432432', '323432432@gmail.com', NULL, '$2y$12$QKDldQmiOUolgPvUmKcT6OC47nOG4rmvoQvdkGkdZdZGUQW7x.X7K', NULL, NULL, '2024-10-02 10:05:38', '2024-10-02 10:05:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agendas_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumnis_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosens_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `himas`
--
ALTER TABLE `himas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `himas_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `jenis_kontens`
--
ALTER TABLE `jenis_kontens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kabinets`
--
ALTER TABLE `kabinets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kabinets_hima_id_foreign` (`hima_id`);

--
-- Indeks untuk tabel `kontaks`
--
ALTER TABLE `kontaks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontens`
--
ALTER TABLE `kontens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kontens_admin_id_foreign` (`admin_id`),
  ADD KEY `kontens_jenis_id_foreign` (`jenis_id`);

--
-- Indeks untuk tabel `kurikulums`
--
ALTER TABLE `kurikulums`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pesans`
--
ALTER TABLE `pesans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesans_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `himas`
--
ALTER TABLE `himas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jenis_kontens`
--
ALTER TABLE `jenis_kontens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kabinets`
--
ALTER TABLE `kabinets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kontaks`
--
ALTER TABLE `kontaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kontens`
--
ALTER TABLE `kontens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `kurikulums`
--
ALTER TABLE `kurikulums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `pesans`
--
ALTER TABLE `pesans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  ADD CONSTRAINT `alumnis_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `himas`
--
ALTER TABLE `himas`
  ADD CONSTRAINT `himas_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `kabinets`
--
ALTER TABLE `kabinets`
  ADD CONSTRAINT `kabinets_hima_id_foreign` FOREIGN KEY (`hima_id`) REFERENCES `himas` (`id`);

--
-- Ketidakleluasaan untuk tabel `kontens`
--
ALTER TABLE `kontens`
  ADD CONSTRAINT `kontens_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kontens_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_kontens` (`id`);

--
-- Ketidakleluasaan untuk tabel `pesans`
--
ALTER TABLE `pesans`
  ADD CONSTRAINT `pesans_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
