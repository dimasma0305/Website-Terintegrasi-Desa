CREATE DATABASE IF NOT EXISTS dbdesa;
use dbdesa;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password CHAR(60) NOT NULL
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

CREATE TABLE IF NOT EXISTS surat(
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner INT NOT NULL,
    filename VARCHAR(60) NOT NULL,
    jenisSuratId INT NOT NULL,
    title VARCHAR(60) NOT NULL,
    deskripsi TEXT NOT NULL,
    keperluan TEXT NOT NULL,
    status ENUM("pending","diterima", "ditolak") NOT NULL,
    FOREIGN KEY (owner) REFERENCES users(id),
    FOREIGN KEY (jenisSuratId) REFERENCES jenisSurat(id)
);
