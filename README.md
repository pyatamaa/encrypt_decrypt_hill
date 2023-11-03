# encrypt_decrypt_hill_cipher
Program untuk enkripsi dan dekripsi menggunakan metode hill cipher

# Tampilan untuk Halaman Home

<img width="920" alt="Screenshot 2023-11-02 101703" src="https://github.com/pyatamaa/encrypt_decrypt_hill/assets/92738041/d550ce08-d88a-489e-b2ca-8d93b721e8ff">

# Tampilan untuk menu encrypt/decrypt

<img width="615" alt="Screenshot 2023-11-02 102045" src="https://github.com/pyatamaa/encrypt_decrypt_hill/assets/92738041/75eb9037-986f-4dc4-b21c-b993ab84a1e1">

# Tampilan hasil dari teks yang di encrypt/decrypt

<img width="240" alt="Screenshot 2023-10-31 145047" src="https://github.com/pyatamaa/encrypt_decrypt_hill/assets/92738041/1321205d-0843-4de3-b035-e3def84c00da">

# Penjelasan singkat

## 1. File Function

Fungsi str_replace digunakan untuk menghapus spasi dan mengubah teks menjadi huruf kapital. Jika teks yang dienkripsi memiliki jumlah huruf ganjil maka huruf “X” akan mengisi pada posisi genap. Kemudian, Hasil enkripsi atau dekripsi disimpan dalam variabel $result.

Dalam mode enkripsi, teks dibagi menjadi pasangan huruf, lalu setiap pasangan dienkripsi menggunakan kunci matriks dengan mengalikan matriks karakter dengan matriks kunci, dan hasilnya diambil modulo 26. Hasil enkripsi diubah kembali menjadi karakter huruf kapital. Dalam mode dekripsi, proses yang sama dilakukan, tetapi dengan menggunakan matriks invers dari kunci.
Ada beberapa fungsi bantu, seperti determinant untuk menghitung determinan matriks, matrix_multiply untuk mengalikan matriks dengan skalar, matrix_modulo untuk menghitung modulo matriks, dan matrix_inverse untuk menghitung matriks invers.

## 2. file Hill Cipher 

Variabel $result digunakan untuk menyimpan hasil dari enkripsi atau dekripsi teks.

Kode ini memeriksa apakah permintaan yang diterima adalah metode POST menggunakan $_SERVER['REQUEST_METHOD'] === 'POST'.

Kemudian, kode mengambil data yang dikirim melalui metode POST. Ini termasuk teks yang akan dienkripsi ($text), elemen-elemen kunci matriks ($key00, $key01, $key10, $key11), dan mode operasi (enkripsi atau dekripsi) ($mode).

Jika semua elemen kunci matriks sudah diisi (tidak null), maka kunci matriks dibentuk menjadi matriks 2x2 dan disimpan dalam variabel $key_matrix.

Selanjutnya, kode mencoba menjalankan fungsi hill_cipher untuk mengenkripsi atau mendekripsi teks dengan menggunakan kunci matriks dan mode operasi yang telah ditentukan.

Setelah hasil enkripsi atau dekripsi diperoleh, kode ini mempersiapkan pernyataan SQL untuk menyimpan hasil ke dalam database. Data yang akan disimpan adalah teks masukan, kunci, mode operasi, dan hasil enkripsi/dekripsi.

Kemudian, kode ini menggunakan fungsi mysqli_prepare untuk membuat pernyataan yang aman (prepared statement) yang memungkinkan penggunaan parameter dalam pernyataan SQL, sehingga menghindari serangan SQL Injection.

Nilai-nilai yang akan dimasukkan ke dalam pernyataan SQL disiapkan dan diikat ke pernyataan menggunakan mysqli_stmt_bind_param.

Jika pernyataan SQL berhasil dijalankan dengan mysqli_stmt_execute, maka pesan "Hasil berhasil disimpan ke database" akan ditampilkan. Jika ada kesalahan, pesan kesalahan akan ditampilkan bersama dengan informasi kesalahan yang diberikan oleh mysqli_error.

Jika terjadi kesalahan dalam fungsi hill_cipher, maka pesan kesalahan akan ditampilkan dalam variabel $result.

Jika elemen-elemen kunci matriks belum diisi (bernilai null), maka pesan kesalahan "Error: Key elements are not set." akan ditampilkan dalam variabel $result.
