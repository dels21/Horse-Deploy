INSERT INTO users (name, email, email_verified_at, password, role, remember_token, status, created_at, updated_at) 
VALUES ('John Doe', 'john.doe@example.com', NULL, '123', 'dokter', 'someRandomToken1', 'aktif', NOW(), NOW());

INSERT INTO users (name, email, email_verified_at, password, role, remember_token, status, created_at, updated_at) 
VALUES ('Jane Smith', 'jane.smith@example.com', NULL, '123', 'karyawan', 'someRandomToken2', 'aktif', NOW(), NOW());

INSERT INTO users (name, email, email_verified_at, password, role, remember_token, status, created_at, updated_at) 
VALUES ('Alice Johnson', 'alice.johnson@example.com', NULL, '123', 'pasien', 'someRandomToken3', 'aktif', NOW(), NOW());

INSERT INTO users (name, email, email_verified_at, password, role, remember_token, status, created_at, updated_at) 
VALUES ('Shaquille', 'shaquille@example.com', NULL, '123', 'admin', 'someRandomToken3', 'aktif', NOW(), NOW());

INSERT INTO dokter (idUser, idKtp, jenisKelamin, tanggalLahir, alamat, kota, nomorHp, nomorTelpRumah) 
VALUES (1,5111111111111111, 'laki', '1980-08-15', 'Jalan Mangga no 20', 'Cirebon', '089633019191', '0210034');

INSERT INTO karyawan (idUser, idKtp, jenisKelamin, tanggalLahir, alamat, kota, nomorHp, nomorTelpRumah) 
VALUES (1,5111111111111111, 'laki', '1980-08-15', 'Jalan Mangga no 20', 'Cirebon', '089633019191', '0210034');

INSERT INTO pasien (idUser, tempatLahir, tanggalLahir, noIdentitas, nomorRumah, nomorHp, namaKontakDarurat, nomorDarurat, kewarganegaraan, tanggalDaftar, alergi, golonganDarah, tinggiBadan, beratBadan)
VALUES 
((SELECT id FROM users WHERE email = 'john.doe@example.com'), 'Jakarta', '1985-04-12', 1234567890123456, '123', '081234567890', 'Jane Doe', '081234567891', 'Indonesia', '2023-05-20', 'Peanuts', 'O+', 175, 70);

INSERT INTO pasien (idUser, tempatLahir, tanggalLahir, noIdentitas, nomorRumah, nomorHp, namaKontakDarurat, nomorDarurat, kewarganegaraan, tanggalDaftar, alergi, golonganDarah, tinggiBadan, beratBadan)
VALUES 
((SELECT id FROM users WHERE email = 'jane.smith@example.com'), 'Surabaya', '1990-07-25', 6543210987654321, '456', '082345678901', 'John Smith', '082345678902', 'Indonesia', '2023-05-21', 'Penicillin', 'A+', 165, 60);

INSERT INTO master_dicom (alamatIp, netMask, layananDicom, peran, aet, port,created_at, updated_at)
VALUES 
('192.168.1.1', '255.255.255.0', 'MWL', 'SCU', 'AET123', 104, NOW(), NOW());

INSERT INTO master_dicom (alamatIp, netMask, layananDicom, peran, aet, port,created_at, updated_at)
VALUES 
('192.168.1.2', '255.255.255.0', 'Store', 'SCP', 'AET456', 105, NOW(), NOW());

INSERT INTO master_modalitas (namaModalitas, jenisModalitas, merekModalitas, tipeModalitas, nomorSeriModalitas, alamatIp, kodeRuang, created_at, updated_at)
VALUES 
('Modalitas 1', 'CT Scan', 'Merek A', 'Tipe X', '123456', '192.168.1.1', 'R001', NOW(), NOW());

INSERT INTO master_modalitas (namaModalitas, jenisModalitas, merekModalitas, tipeModalitas, nomorSeriModalitas, alamatIp, kodeRuang, created_at, updated_at)
VALUES 
('Modalitas 2', 'MRI', 'Merek B', 'Tipe Y', '654321', '192.168.1.2', 'R002', NOW(), NOW());

INSERT INTO master_jenis_pemeriksaan (kodeModalitas, namaJenisPemeriksaan, kelompokJenisPemerikaan, pemakaianKontras, lamaPemeriksaan, created_at, updated_at)
VALUES 
(1, 'Pemeriksaan CT 1', 'CT', 'Ya', 30, NOW(), NOW());

INSERT INTO master_jenis_pemeriksaan (kodeModalitas, namaJenisPemeriksaan, kelompokJenisPemerikaan, pemakaianKontras, lamaPemeriksaan, created_at, updated_at)
VALUES 
(2, 'Pemeriksaan MRI 1', 'MR', 'Tidak', 45, NOW(), NOW());

INSERT INTO pendaftaran_pemeriksaan (idPasien, namaDokterPengirim, tanggalDaftar, created_at, updated_at)
VALUES 
(1, 'Dr. John Doe', '2024-05-28', NOW(), NOW());

INSERT INTO pendaftaran_pemeriksaan (idPasien, namaDokterPengirim, tanggalDaftar, created_at, updated_at)
VALUES 
(2, 'Dr. Jane Smith', '2024-05-28', NOW(), NOW());


-- Insert 1
INSERT INTO detail_pendaftaran (noPendaftaran, kodeJenisPemeriksaan, kodeModalitas, tanggalPendaftaranPemeriksaan, jamMulai, jamSelesai, statusKetersediaan, keteranganKetersediaan, created_at, updated_at)
VALUES 
(1, 1, 1, '2024-05-28', '08:00:00', '09:00:00', 'approve', 'Pemeriksaan berhasil dijadwalkan.', NOW(), NOW());

-- Insert 2
INSERT INTO detail_pendaftaran (noPendaftaran, kodeJenisPemeriksaan, kodeModalitas, tanggalPendaftaranPemeriksaan, jamMulai, jamSelesai, statusKetersediaan, keteranganKetersediaan, created_at, updated_at)
VALUES 
(1, 2, 2, '2024-05-29', '10:00:00', '11:00:00', 'approve', 'Pemeriksaan berhasil dijadwalkan.', NOW(), NOW());

-- Insert 3
INSERT INTO detail_pendaftaran (noPendaftaran, kodeJenisPemeriksaan, kodeModalitas, tanggalPendaftaranPemeriksaan, jamMulai, jamSelesai, statusKetersediaan, keteranganKetersediaan, created_at, updated_at)
VALUES 
(2, 1, 1, '2024-05-30', '13:00:00', '14:00:00', 'reject', 'Pemeriksaan ditolak karena ketersediaan terbatas.', NOW(), NOW());

-- Insert 4
INSERT INTO detail_pendaftaran (noPendaftaran, kodeJenisPemeriksaan, kodeModalitas, tanggalPendaftaranPemeriksaan, jamMulai, jamSelesai, statusKetersediaan, keteranganKetersediaan, created_at, updated_at)
VALUES 
(2, 2, 2, '2024-05-31', '15:00:00', '16:00:00', 'approve', 'Pemeriksaan berhasil dijadwalkan.', NOW(), NOW());

-- Insert 1
INSERT INTO transaksi_pemeriksaan (id, nomorPemeriksaan, nomorPendaftaran, idKaryawanRadiografer, idKaryawanDokterRadiologi, namaDokterPengirim, tanggalPemeriksaan, diagnosis, keterangan, created_at, updated_at)
VALUES 
(1, 1, 1, 1, 1, 'Dr. John Doe', '2024-05-28', 'Fracture in the left arm', 'Patient advised to rest and take medication as prescribed.', NOW(), NOW());

-- Insert 2
INSERT INTO transaksi_pemeriksaan (id, nomorPemeriksaan, nomorPendaftaran, idKaryawanRadiografer, idKaryawanDokterRadiologi, namaDokterPengirim, tanggalPemeriksaan, diagnosis, keterangan, created_at, updated_at)
VALUES 
(1, 2, 2, 2, 2, 'Dr. Jane Smith', '2024-05-29', 'Appendicitis', 'Patient scheduled for surgery on 2024-06-05.', NOW(), NOW());
INSERT INTO transaksi_pemeriksaan (id, nomorPemeriksaan, nomorPendaftaran, idKaryawanRadiografer, idKaryawanDokterRadiologi, namaDokterPengirim, tanggalPemeriksaan, diagnosis, keterangan, created_at, updated_at)
VALUES 
(1, 3, 2, 2, 2, 'Dr. Jane Smith', '2024-05-29', 'Appendicitis', 'Patient scheduled for surgery on 2024-06-05.', NOW(), NOW());


-- Insert 1
INSERT INTO detail_pemeriksaan (nomorPendaftaran, idKaryawanRadiografer, idKaryawanDokterRadiologi, namaDokterPengirim, tanggalPemeriksaan, diagnosis, keterangan, created_at, updated_at)
VALUES 
(1, 1, 1, 'Dr. John Doe', '2024-05-28', 'Fracture in the left arm', 'Patient advised to rest and take medication as prescribed.', NOW(), NOW());

-- Insert 2
INSERT INTO detail_pemeriksaan (nomorPendaftaran, idKaryawanRadiografer, idKaryawanDokterRadiologi, namaDokterPengirim, tanggalPemeriksaan, diagnosis, keterangan, created_at, updated_at)
VALUES 
(2, 2, 2, 'Dr. Jane Smith', '2024-05-29', 'Appendicitis', 'Patient scheduled for surgery on 2024-06-05.', NOW(), NOW());

-- Insert 1
INSERT INTO detail_pemeriksaan (nomorPemeriksaan, jamMulaiPemeriksaanAlat, jamSelesaiPemeriksaanAlat, ruangan, keterangan, diskon, hargaTotal, status, created_at, updated_at)
VALUES 
(1, '08:00:00', '09:00:00', 'Ruangan 1', 'Pemeriksaan rutin', 0, 500000, 'Dalam antrian', NOW(), NOW());

-- Insert 2
INSERT INTO detail_pemeriksaan (nomorPemeriksaan, jamMulaiPemeriksaanAlat, jamSelesaiPemeriksaanAlat, ruangan, keterangan, diskon, hargaTotal, status, created_at, updated_at)
VALUES 
(1, '09:30:00', '10:30:00', 'Ruangan 2', 'Pemeriksaan tambahan', 0, 750000, 'Dalam antrian', NOW(), NOW());

-- Insert 3
INSERT INTO detail_pemeriksaan (nomorPemeriksaan, jamMulaiPemeriksaanAlat, jamSelesaiPemeriksaanAlat, ruangan, keterangan, diskon, hargaTotal, status, created_at, updated_at)
VALUES 
(4, '10:00:00', '11:00:00', 'Ruangan 3', 'Pemeriksaan awal', 0, 600000, 'Dalam antrian', NOW(), NOW());

-- Insert 4
INSERT INTO detail_pemeriksaan (nomorPemeriksaan, jamMulaiPemeriksaanAlat, jamSelesaiPemeriksaanAlat, ruangan, keterangan, diskon, hargaTotal, status, created_at, updated_at)
VALUES 
(4, '11:30:00', '12:30:00', 'Ruangan 4', 'Pemeriksaan follow-up', 0, 700000, 'Dalam antrian', NOW(), NOW());

-- Insert 1
INSERT INTO hasil_pemeriksaan_radiologi (nomorPemeriksaan, idKaryawan, tanggalLaporan, created_at, updated_at)
VALUES 
(1, 1, '2024-05-29', NOW(), NOW());

-- Insert 2
INSERT INTO hasil_pemeriksaan_radiologi (nomorPemeriksaan, idKaryawan, tanggalLaporan, created_at, updated_at)
VALUES 
(4, 1, '2024-05-30', NOW(), NOW());

-- Insert 1
INSERT INTO detail_hasil_pemeriksaan_radiologi (idHasilPemeriksaan, kodeJenisPemeriksaan, laporan, created_at, updated_at)
VALUES 
(1, 1, 'Laporan detail untuk jenis pemeriksaan 1.', NOW(), NOW());

INSERT INTO detail_hasil_pemeriksaan_radiologi (idHasilPemeriksaan, kodeJenisPemeriksaan, laporan, created_at, updated_at)
VALUES 
(1, 2, 'Laporan detail untuk jenis pemeriksaan 2.', NOW(), NOW());

-- Insert 2
INSERT INTO detail_hasil_pemeriksaan_radiologi (idHasilPemeriksaan, kodeJenisPemeriksaan, laporan, created_at, updated_at)
VALUES 
(3, 1, 'Laporan detail untuk jenis pemeriksaan 3.', NOW(), NOW());

INSERT INTO detail_hasil_pemeriksaan_radiologi (idHasilPemeriksaan, kodeJenisPemeriksaan, laporan, created_at, updated_at)
VALUES 
(3, 2, 'Laporan detail untuk jenis pemeriksaan 4.', NOW(), NOW());

-- Insert 1
INSERT INTO draft_laporan_pemeriksaan_radiologi (idKaryawan, kodeJenisPemeriksaan, laporanNormal, created_at, updated_at)
VALUES 
(1, 1, 'Laporan normal untuk jenis pemeriksaan 1.', NOW(), NOW());

-- Insert 2
INSERT INTO draft_laporan_pemeriksaan_radiologi (idKaryawan, kodeJenisPemeriksaan, laporanNormal, created_at, updated_at)
VALUES 
(1, 2, 'Laporan normal untuk jenis pemeriksaan 2.', NOW(), NOW());
