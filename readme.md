## About SILISA

SILISA atau Sistem Masuk Desa adalah sistem monitoring kelistrikan di desa-desa di Indonesia. Ini adalah project tim magang. Aplikasi ini diperuntukkan untuk uploader data dari excel ke database, lalu data tersebut akan dimunculkan di aplikasi ini dan akan dimunculkan di aplikasi lainnya seperti Tableau. Data yang di upload dari excel cukup besar. Mencakup tiga sheet yang masing-masing terdiri dari 20.000 baris. Aplikasi ini dapat menghandle data excel sebesar 13MB. Dan diperlukan beberapa configurasi di php PC, antara lain :

- memory_limit = -1
- upload_max_filesize = 1048M
- post_max_size = 2048M
- max_execution_time = 3600

Untuk teknologi yang digunakan antara lain : 

- [Laravel](https://laravel.com).
- [Laravel Excel](https://laravel-excel.com/).
- [Toastr](https://github.com/CodeSeven/toastr).
- [SweetAlert](https://sweetalert.js.org/guides/).

Untuk pengembangannya akan dilakukan agar dapat mengupload data excel dengan ukuran lebih besar.
