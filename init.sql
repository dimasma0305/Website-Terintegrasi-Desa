CREATE DATABASE IF NOT EXISTS dbdesa;
use dbdesa;

CREATE TABLE IF NOT EXISTS pendidikan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pendidikan VARCHAR(100) UNIQUE
);

CREATE TABLE IF NOT EXISTS pekerjaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pekerjaan VARCHAR(100) UNIQUE
);

-- Tambah kolom pendidikan/pekerjaan/agama/tanggal lahir/jenis kelamin  
CREATE TABLE IF NOT EXISTS penduduk (
    nik CHAR(16) PRIMARY KEY,
    nama VARCHAR(255),
    pendidikan_id INT,
    pekerjaan_id INT,
    tanggal_lahir DATE,
    jenis_kelamin ENUM("Laki-laki", "Perempuan"),
    alamat VARCHAR(255),
    FOREIGN KEY (pendidikan_id) REFERENCES pendidikan(id),
    FOREIGN KEY (pekerjaan_id) REFERENCES pekerjaan(id)
);

INSERT INTO penduduk (nik, nama)
VALUES ("1111111111111111", "Dimas Maulana"),
    ("2222222222222222", "Patrick"),
    ("3333333333333333", "Spongebob"),
    ("4444444444444444", "Yujin");
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    password CHAR(60) NOT NULL,
    role ENUM("user", "admin") DEFAULT "user",
    nik CHAR(16) DEFAULT NULL,
    FOREIGN KEY (nik) REFERENCES penduduk(nik)
);
INSERT INTO users (username, email, password, role)
VALUES (
        "admin",
        "admin@admin.com",
        "$2y$10$W2Nk5p1hL1jraYSPkESaN.01Rai//bWmgoQRluWRrys4DsoOD0JDC",
        "admin"
    );
CREATE TABLE IF NOT EXISTS jenisSurat(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60)
);
INSERT INTO jenisSurat (name)
VALUES ('Surat Keterangan Domisili'),
    ('Surat Keterangan Usaha'),
    ('Surat Keterangan Kelahiran'),
    ('Surat Keterangan Kematian');
CREATE TABLE IF NOT EXISTS surat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner INT NOT NULL,
    filename VARCHAR(60) NOT NULL,
    jenisSuratId INT NOT NULL,
    title VARCHAR(60) NOT NULL,
    deskripsi TEXT NOT NULL,
    keperluan TEXT NOT NULL,
    status ENUM("pending", "diterima", "ditolak") NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (owner) REFERENCES users(id),
    FOREIGN KEY (jenisSuratId) REFERENCES jenisSurat(id)
);

CREATE TABLE IF NOT EXISTS artikel (
    id CHAR(24) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE, -- Adding the slug column
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    image_url VARCHAR(255), -- Adding the image_url column
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);
