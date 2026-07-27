# Changelog Perbaikan - SIM SMP Muhammadiyah Bojong Nangka

Dokumen ini mencatat semua perubahan yang dilakukan pada sesi analisa & perbaikan ini.

## ⚠️ WAJIB DILAKUKAN SETELAH MENERIMA FILE INI

Karena seluruh migration ditulis ulang dari nol dan `database.sqlite` dikosongkan,
kamu HARUS menjalankan ulang migrate + seed:

```bash
php artisan migrate:fresh --seed
```

Setelah itu 3 akun default akan tersedia (password sama untuk semua: `password`):
- Admin  : admin@sekolah.com
- Guru   : guru@sekolah.com
- Siswa  : siswa@sekolah.com

Jangan lupa jalankan `composer install` dan `npm install && npm run build` juga
kalau folder `vendor`/`node_modules` belum ada.

---

## 1. Database & Migration (perbaikan paling kritis)

**Masalah:** Riwayat migration di `database.sqlite` yang dikirim membuktikan
migration custom (gurus, siswas, kelas, dst) TIDAK PERNAH berhasil dijalankan.
Setelah ditelusuri, penyebabnya:

- `2026_07_04_023242_update_kelas_table.php` — file **tidak punya tag pembuka `<?php`** sama sekali → fatal error, seluruh proses migrate berhenti begitu sampai file ini.
- `2026_07_02_054058_skip_add_management_fields_to_users_table.php.php` — method `down()` punya **syntax error** (`->nullable()` nyempil di tengah array) → fatal parse error.
- File tersebut juga terduplikat (`...users_table.php` dan `...users_table.php.php` dengan timestamp sama persis).
- Migration `add_role_to_users_table.php` isinya kosong — kolom `role` yang jadi tulang punggung seluruh sistem role-based access **tidak pernah benar-benar dibuat** lewat migration manapun.
- Tabel `tahun_pelajaran` dibuat tanpa akhiran `s`, padahal model Eloquent `TahunPelajaran` (tanpa `$table` custom) otomatis mencari tabel `tahun_pelajarans`. Query `exists:tahun_pelajarans,id` di validasi juga pakai nama dengan `s`.
- Tabel `gurus` di migration awal cuma punya 3 kolom (nama, mapel, umur), padahal model & controller pakai belasan kolom lain (nip, tempat_lahir, agama, dll) yang sepertinya ditambahkan manual ke database, bukan lewat migration.

**Perbaikan:** Seluruh folder `database/migrations` ditulis ulang jadi 8 file yang
bersih, urut, dan konsisten — mencakup SEMUA kolom yang benar-benar dipakai oleh
model & controller yang ada. Tidak ada lagi migration "tambal sulam".
`database.sqlite` dikosongkan supaya siap di-migrate ulang dari nol.

## 2. Seeder

- `DatabaseSeeder.php`: sebelumnya membuat "Test User" tanpa kolom `role`
  (akan gagal karena `role` sekarang wajib diisi). Diganti supaya otomatis
  memanggil `UserRoleSeeder` yang membuat 3 akun (admin/guru/siswa).
- `UserSeeder.php` dihapus karena isinya 100% duplikat dari `UserRoleSeeder.php`.

## 3. Bug di Controller

- **`GuruController::update()`** — kode konversi format tanggal (`tanggal_lahir`)
  dipanggil SEBELUM variabel `$data` didefinisikan, jadi tidak pernah benar-benar
  jalan (dead code). Dipindah ke posisi yang benar.
- **`GuruController::store()`** — variabel `$tanggal_lahir` yang sudah dikonversi
  ke format `Y-m-d` dihitung tapi tidak pernah dipakai; `Guru::create()` malah
  memakai `$request->tanggal_lahir` mentah. Sudah diperbaiki untuk memakai
  variabel yang sudah dikonversi.
- **`MataPelajaranController`** — sebelumnya semua method kosong (stub) padahal
  route resource sudah didaftarkan di `admin.php`. Sekarang sudah lengkap
  (index, create, store, show, edit, update, destroy) beserta 4 view barunya.

## 4. Model

- **`Guru.php`** — kolom `berkas` ditambahkan ke `$fillable` (dipakai di
  `GuruController::downloadBerkas()` tapi sebelumnya tidak bisa diisi lewat
  mass-assignment).
- **`Kelas.php`** — relasi `siswa()` (`hasMany(Siswa::class, 'kelas_id')`) dihapus
  karena kolom `kelas_id` tidak pernah ada di tabel `siswas` (siswa disimpan
  dengan kolom teks bebas `kelas`, bukan foreign key) — relasi ini pasti selalu
  mengembalikan collection kosong dan tidak dipakai di mana pun dalam kode.
  *(Catatan: kalau ke depannya mau relasi siswa-kelas yang "benar" pakai foreign
  key, itu perubahan struktural yang lebih besar — beri tahu saya kalau mau
  dikerjakan.)*

## 5. View yang Sebelumnya Hilang (menyebabkan error 500)

- `resources/views/kelas/show.blade.php` — dipanggil `KelasController::show()`, tidak pernah dibuat.
- `resources/views/guru/show-siswa.blade.php` — dipanggil `GuruController::show()` untuk role siswa, tidak pernah dibuat. Versinya sengaja dibuat lebih ringkas (tanpa NIP/alamat/no telepon) karena data itu tidak perlu dilihat siswa.
- `resources/views/siswa/cetak-pdf.blade.php` — dipanggil `SiswaController::cetakPDF()` & `cetakProfilePDF()`, tidak pernah dibuat.

## 6. Bug di View

- **`kelas/index.blade.php`** — memanggil `$item->gurus` (relasi yang tidak ada,
  method di model bernama `guru()` bukan `gurus()`), jadi kolom "Wali Kelas"
  selalu tampil `-` walau data guru_id terisi. Diperbaiki jadi `$item->guru`.
- **`kelas/create.blade.php`** — nilai `<option>` untuk field `tingkat` sebelumnya
  `"VII A"`, `"VII B"`, dst, padahal validasi controller cuma menerima
  `in:VII,VIII,IX` persis. Akibatnya form tambah kelas **selalu gagal validasi**.
  Ditulis ulang dengan value yang benar, plus field `keterangan` yang sebelumnya
  tidak ada di form sama sekali.
- **`kelas/edit.blade.php`** — bug yang lebih parah: field `tingkat` pakai value
  angka (`7`/`8`/`9`), dan field **`tahun_pelajaran_id` yang wajib diisi
  (`required`) sama sekali tidak ada di form** — jadi setiap kali admin coba
  update data kelas, validasi PASTI gagal. Ada juga field "Status" (`is_active`)
  yang sebenarnya tidak pernah ada kolomnya di tabel `kelas`. Ditulis ulang total
  supaya cocok dengan validasi & skema tabel yang sebenarnya.
- **`tahun-pelajaran/index.blade.php`** — ada karakter `<` nyasar sebelum tag
  `<td>` (`<<td>`) yang merusak markup HTML tabel. Sudah diperbaiki.

## 7. Fitur Baru: Modul Mata Pelajaran

Karena controller-nya kosong dan tidak ada satupun view, modul ini sekarang
sudah lengkap: CRUD penuh (index dengan search + pagination, create, edit, show,
delete) dan link menu-nya ditambahkan ke sidebar admin.

## 8. Belum Disentuh (butuh keputusan kamu)

- **`resources/views/jadwal/*.blade.php`** — sudah ada 3 file view (index, create,
  edit) tapi TIDAK ADA controller, model, route, atau migration untuk fitur
  Jadwal Pelajaran sama sekali. Ini kemungkinan fitur yang direncanakan tapi
  belum dikerjakan. Beri tahu saya kalau mau saya lanjutkan (perlu bikin model
  `Jadwal`, migration, controller, dan route baru), atau kalau view-nya mau
  dihapus saja dulu supaya tidak membingungkan.
- **Otorisasi manual berulang** — hampir semua method controller punya
  `if (auth()->user()->role != 'admin') abort(403, ...)` yang diketik ulang di
  setiap method. Ini jalan tapi rawan human error kalau ada method baru yang
  lupa dikasih pengecekan. Untuk proyek sekolah skala ini tidak wajib, tapi
  kalau mau lebih rapi bisa dipindah ke Laravel Policy.
