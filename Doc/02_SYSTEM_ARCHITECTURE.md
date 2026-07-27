# System Architecture

Muh-BJN App menggunakan arsitektur modular.

CORE

↓

MASTER

↓

TRANSAKSI

↓

LAPORAN

↓

PORTAL

Semua modul transaksi wajib menggunakan Master Data.

Tidak diperbolehkan menyimpan data yang sama di lebih dari satu tabel.