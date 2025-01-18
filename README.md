# Indonesia

---

## Aplikasi Notulensi Rapat

Aplikasi Notulensi Rapat adalah aplikasi berbasis web yang dikembangkan menggunakan Laravel. Aplikasi ini bertujuan untuk membantu organisasi atau tim dalam mencatat, menyimpan, dan mengelola notulensi rapat secara efisien.

---

## Fitur Utama

-   **Manajemen Rapat:** Buat, perbarui, dan hapus data rapat.
-   **Notulensi:** Tambahkan catatan notulensi untuk setiap rapat.
-   **Peserta Rapat:** Kelola daftar peserta rapat.
-   **Lampiran:** Unggah dokumen atau file yang relevan dengan rapat.
-   **Pencarian dan Filter:** Cari dan filter rapat berdasarkan tanggal, topik, atau peserta.
-   **Hak Akses:** Sistem autentikasi dan otorisasi untuk admin dan pengguna biasa.

---

## Prasyarat

Pastikan sistem Anda memiliki:

1. **PHP** >= 8.1
2. **Composer** >= 2.x
3. **Laravel** >= 10.x
4. **Database** (MySQL, PostgreSQL, dll.)
5. **Node.js** >= 16.x dan **npm/yarn**
6. Server lokal seperti **XAMPP** atau **Laravel Sail**

---

## Instalasi

1. **Clone Repository**

    ```bash
    git clone git@github.com:ramdacodes/Aplikasi-Notulensi-Rapat.git
    cd Aplikasi-Notulensi-Rapat
    ```

2. **Install Dependensi**

    ```bash
    composer install
    ```

3. **Konfigurasi File `.env`**
   Salin file `.env.example` menjadi `.env` dan atur konfigurasi database:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=nama_user
    DB_PASSWORD=password
    ```

4. **Generate Key Aplikasi**

    ```bash
    php artisan key:generate
    ```

5. **Migrasi Database**
   Jalankan perintah berikut untuk membuat tabel di database:

    ```bash
    php artisan migrate
    ```

6. **Menjalankan Server Lokal**
   Jalankan perintah berikut untuk menjalankan aplikasi:
    ```bash
    php artisan serve
    ```
    Akses aplikasi melalui browser di `http://localhost:8000`

---

## Penggunaan

1. **Login/Registrasi**: Buat akun baru atau login dengan akun yang ada.
2. **Tambah Rapat**: Masukkan detail rapat, seperti nama rapat, tanggal, dan waktu.
3. **Catat Notulensi**: Tambahkan poin-poin penting dalam rapat.
4. **Unggah Lampiran**: Sertakan file tambahan jika diperlukan.
5. **Kelola Peserta**: Tambahkan atau hapus peserta rapat sesuai kebutuhan.

---

## Teknologi yang Digunakan

-   **Laravel**: Framework PHP untuk backend.
-   **Filament**: Untuk admin panel dan manajemen CRUD.
-   **TailwindCSS**: Untuk antarmuka pengguna.
-   **MySQL**: Database utama.
-   **JavaScript/Alpine.js**: Untuk komponen interaktif.

---

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini:

1. Fork repository ini.
2. Buat branch fitur baru:
    ```bash
    git checkout -b fitur-baru
    ```
3. Lakukan commit perubahan:
    ```bash
    git commit -m "Menambahkan fitur baru"
    ```
4. Push ke branch Anda:
    ```bash
    git push origin fitur-baru
    ```
5. Buat pull request ke repository utama.

---

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## Kontak

<!-- Jika ada pertanyaan atau saran, silakan hubungi:

-   Email: email@domain.com
-   Telegram: @username -->

# English

---

## Meeting Minutes Application

The Meeting Minutes Application is a web-based application developed using Laravel. This application aims to assist organizations or teams in recording, storing, and managing meeting minutes efficiently.

---

## Key Features

-   **Meeting Management:** Create, update, and delete meeting records.
-   **Minutes:** Add meeting minutes for each meeting.
-   **Participants:** Manage the list of meeting participants.
-   **Attachments:** Upload documents or files relevant to the meeting.
-   **Search and Filter:** Search and filter meetings by date, topic, or participants.
-   **Access Control:** Authentication and authorization system for admins and regular users.

---

## Prerequisites

Ensure your system has:

1. **PHP** >= 8.1
2. **Composer** >= 2.x
3. **Laravel** >= 10.x
4. **Database** (MySQL, PostgreSQL, etc.)
5. **Node.js** >= 16.x and **npm/yarn**
6. A local server such as **XAMPP** or **Laravel Sail**

---

## Installation

1. **Clone the Repository**

    ```bash
    git clone git@github.com:ramdacodes/Aplikasi-Notulensi-Rapat.git
    cd Aplikasi-Notulensi-Rapat
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Configure `.env` File**
   Copy the `.env.example` file to `.env` and set up the database configuration:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=user_name
    DB_PASSWORD=password
    ```

4. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Run Database Migrations**
   Execute the following command to create tables in the database:

    ```bash
    php artisan migrate
    ```

6. **Run Local Server**
   Start the application by running:
    ```bash
    php artisan serve
    ```
    Access the application via your browser at `http://localhost:8000`

---

## Usage

1. **Login/Register:** Create a new account or log in with an existing one.
2. **Add Meetings:** Enter meeting details such as name, date, and time.
3. **Record Minutes:** Add key points discussed in the meeting.
4. **Upload Attachments:** Include additional files if needed.
5. **Manage Participants:** Add or remove participants as required.

---

## Technologies Used

-   **Laravel:** PHP framework for the backend.
-   **Filament:** For admin panel and CRUD management.
-   **TailwindCSS:** For the user interface.
-   **MySQL:** Primary database.
-   **JavaScript/Alpine.js:** For interactive components.

---

## Contribution

If you would like to contribute to this project:

1. Fork this repository.
2. Create a new feature branch:
    ```bash
    git checkout -b new-feature
    ```
3. Commit your changes:
    ```bash
    git commit -m "Add new feature"
    ```
4. Push to your branch:
    ```bash
    git push origin new-feature
    ```
5. Create a pull request to the main repository.

---

## License

This project is licensed under the [MIT License](LICENSE).

---

<!-- ## Contact

If you have any questions or suggestions, feel free to contact:

-   Email: email@domain.com
-   Telegram: @username -->
