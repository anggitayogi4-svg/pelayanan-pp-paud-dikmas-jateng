<?php

// ================================================================
// Elemen 4.4 — Paket/Namespace: mengelompokkan seluruh kode
// yang berhubungan dengan pengaduan dalam satu ruang nama
// ================================================================
namespace App\Pengaduan;

// ================================================================
// Elemen 4.4 — Interface: kontrak method yang wajib ada
// di setiap class yang memakainya
// ================================================================
interface Notifikasi
{
    public function kirimNotifikasi(string $pesan): string;
}

// ================================================================
// Elemen 4.1 — Class dengan properti yang direalisasikan lewat
// method (constructor & getter), serta hak akses private/protected/public
// ================================================================
class Pengaduan implements Notifikasi
{
    // Data mandiri di dalam class + hak akses diatur
    private int $id = 0;
    private string $nama;
    protected string $kategori;
    public string $status;

    public function __construct(string $nama, string $kategori, string $status = "Belum Diproses")
    {
        $this->nama = $nama;
        $this->kategori = $kategori;
        $this->status = $status;
    }
    // Method tambahan: update status yang sudah ada di database
    public function updateStatusDatabase($koneksi, int $id): bool
    {
        $status = mysqli_real_escape_string($koneksi, $this->status);
        $id = (int) $id;

        $query = "UPDATE tbl_pengaduan SET status = '$status' WHERE id = $id";
        return mysqli_query($koneksi, $query) ? true : false;
    }
    // Properti direalisasikan dalam bentuk method (getter)
    public function getNama(): string
    {
        return $this->nama;
    }

    // ============================================================
    // Elemen 4.2 — Tipe data jelas (string, void) + struktur
    // kontrol percabangan (if/else) untuk validasi nilai status
    // ============================================================
    public function ubahStatus(string $statusBaru): void
    {
        if ($statusBaru === "Selesai" || $statusBaru === "Belum Diproses") {
            $this->status = $statusBaru;
        } else {
            $this->status = "Belum Diproses";
        }
    }

    // Implementasi wajib dari interface Notifikasi
    public function kirimNotifikasi(string $pesan): string
    {
        return "Notifikasi ke {$this->nama}: {$pesan}";
    }

    // ============================================================
    // Elemen 4.3 — Overloading ala PHP: parameter opsional,
    // method bisa dipanggil dengan/tanpa argumen lampiran
    // ============================================================
    public function simpanKeDatabase($koneksi, ?string $lampiran = null): bool
    {
        $nama = mysqli_real_escape_string($koneksi, $this->nama);
        $kategori = mysqli_real_escape_string($koneksi, $this->kategori);
        $status = mysqli_real_escape_string($koneksi, $this->status);
        $lampiranSql = $lampiran !== null
            ? "'" . mysqli_real_escape_string($koneksi, $lampiran) . "'"
            : "NULL";

        $query = "INSERT INTO tbl_pengaduan (nama, kategori, status, lampiran)
                   VALUES ('$nama', '$kategori', '$status', $lampiranSql)";

        return mysqli_query($koneksi, $query) ? true : false;
    }
}

// ================================================================
// Elemen 4.3 — Inheritance: mewarisi semua properti & method
// dari Pengaduan. Polymorphism: method yang sama di-override
// dengan perilaku berbeda
// ================================================================
class PengaduanUrgent extends Pengaduan
{
    public function kirimNotifikasi(string $pesan): string
    {
        $pesanAsli = parent::kirimNotifikasi($pesan);
        return "[URGENT] " . $pesanAsli . " - Mohon segera ditindaklanjuti!";
    }
}