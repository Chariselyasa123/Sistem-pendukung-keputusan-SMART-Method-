# Implementasi Metode SMART (*Simple Multi Attribute Rating Technique*) Ke Dalam Sistem Penunjang Keputusan

- [Implementasi Metode SMART (*Simple Multi Attribute Rating Technique*) Ke Dalam Sistem Penunjang Keputusan](#implementasi-metode-smart-simple-multi-attribute-rating-technique-ke-dalam-sistem-penunjang-keputusan)
  - [Tentang Metode SMART](#tentang-metode-smart)
  - [Implementasi Metode SMART Ke Dalam Sistem](#implementasi-metode-smart-ke-dalam-sistem)
    - [Alternatif dan Kriteria](#alternatif-dan-kriteria)
    - [Menentukan Nilai Kriteria](#menentukan-nilai-kriteria)
    - [Penentuan Bobot Dari **Kriteria**](#penentuan-bobot-dari-kriteria)

## Tentang Metode SMART
SMART (*Simple Multi – Attribute Rating Technique*) adalah metode pengambilan keputusan multi kriteria yang dikembangkan oleh Edward pada tahun 1977.

Sebuah aplikasi berupa Sistem Pendukung Keputusan (*Decision Support System*) mulai dikembangkan pada tahun 1970. *Decision Support Sistem* (DSS) dengan didukung oleh sebuah sistem informasi berbasis komputer dapat membantu seseorang dalam meningkatkan kinerjanya dalam pengambilan keputusan. 

## Implementasi Metode SMART Ke Dalam Sistem
### Alternatif dan Kriteria
Dalam proses pembuatan Sistem Pendukung Keputusan, maka ada beberapa data yang dijadikan pertimbangan dalam proses perancangan sistem tersebut. Data tersebut akan dijadikan **kriteria** dalam penilaian untuk memilih karyawan mana saja yang akan diperpanjang kontrak kerjanya.
Berikut tabel **contoh**  data karyawan yang akan habis kontrak bulan Januari 2021 dengan penilaian dari masing-masing kriteria :

| No | Nama                   | C1  | C2  | C3  | C4  | C5  | C6  |
|----|------------------------|-----|-----|-----|-----|-----|-----|
| 1  | Andri Maulana Jaya     | 75  | 75  | 75  | 75  | 75  | 100 |
| 2  | Enung Suherman         | 100 | 100 | 100 | 100 | 100 | 25  |
| 3  | Saepudin Kardiana      | 75  | 75  | 75  | 75  | 75  | 25  |
| 4  | Mahmud                 | 75  | 75  | 75  | 100 | 75  | 25  |
| 5  | Rudi                   | 50  | 50  | 75  | 50  | 50  | 100 |
| 6  | Fauzi salim            | 100 | 100 | 75  | 75  | 75  | 25  |
| 7  | Marhasan               | 100 | 100 | 100 | 100 | 100 | 25  |
| 8  | May Sumarna            | 100 | 100 | 75  | 100 | 75  | 75  |
| 9  | Dedi Irawan            | 75  | 75  | 100 | 75  | 75  | 75  |
| 10 | Edi Junaedi            | 25  | 25  | 50  | 50  | 50  | 25  |
| 11 | Dail                   | 75  | 75  | 75  | 25  | 75  | 25  |
| 12 | Dayat                  | 50  | 50  | 50  | 75  | 50  | 100 |
| 13 | Hamdani                | 75  | 75  | 75  | 75  | 75  | 50  |
| 14 | Herman                 | 75  | 75  | 75  | 75  | 75  | 50  |
| 15 | Sukamad                | 50  | 50  | 50  | 75  | 75  | 25  |
| 16 | Yudi Yuliastiana       | 100 | 100 | 100 | 100 | 100 | 75  |
| 17 | Heru Pranoto           | 75  | 75  | 75  | 75  | 75  | 100 |
| 18 | Yayan Suryana          | 75  | 75  | 75  | 100 | 75  | 100 |
| 19 | Daman                  | 75  | 75  | 75  | 75  | 100 | 75  |
| 20 | Ade Sanudin Bin Pulung | 50  | 25  | 50  | 50  | 75  | 0   |
| 21 | Surya Purnama          | 75  | 75  | 75  | 100 | 75  | 75  |
| 22 | Mochamad Rivky Maulana | 25  | 0   | 25  | 25  | 50  | 100 |
| 23 | Alif Rizki seful Iman  | 100 | 100 | 100 | 75  | 75  | 75  |
| 24 | Reza Muhamad Fadilah   | 100 | 100 | 100 | 75  | 75  | 100 |
| 25 | Abdul Halim            | 75  | 75  | 75  | 50  | 75  | 100 |
| 26 | Kurtubi                | 75  | 50  | 50  | 75  | 75  | 75  |
| 27 | Supriyadi              | 50  | 50  | 50  | 75  | 75  | 100 |
| 28 | Rudini                 | 100 | 100 | 100 | 100 | 75  | 100 |
| 29 | Nuryadi                | 75  | 75  | 75  | 75  | 75  | 25  |
| 30 | Heru                   | 75  | 75  | 75  | 75  | 75  | 100 |
| 31 | Marhadi                | 75  | 75  | 75  | 25  | 75  | 100 |
| 32 | Zulkarnain             | 75  | 75  | 75  | 50  | 75  | 25  |
| 33 | Humaedi                | 50  | 0   | 25  | 50  | 50  | 75  |
| 34 | Ari Wiguna             | 75  | 75  | 75  | 100 | 75  | 25  |
| 35 | Sajiman                | 50  | 50  | 50  | 100 | 75  | 25  |
| 36 | Abdul Muhi             | 25  | 25  | 25  | 50  | 75  | 100 |
| 37 | Oji. H                 | 75  | 75  | 75  | 75  | 75  | 50  |
| 38 | Suandi                 | 100 | 100 | 100 | 100 | 100 | 75  |
| 39 | Iyan Ja'rian           | 50  | 50  | 50  | 75  | 75  | 25  |
| 40 | Tri Sumarjono          | 75  | 75  | 75  | 50  | 75  | 0   |
| 41 | Iwan Bin Nursamid      | 75  | 75  | 75  | 75  | 75  | 25  |
| 42 | Asan                   | 100 | 100 | 75  | 75  | 75  | 75  |
| 43 | Raju Sudrajat          | 100 | 100 | 75  | 75  | 75  | 100 |
| 44 | Tata Suparta           | 75  | 75  | 75  | 75  | 75  | 100 |
| 45 | Abdul rojak            | 75  | 75  | 75  | 100 | 75  | 75  |
| 46 | Anton Wijaya           | 75  | 75  | 75  | 100 | 75  | 75  |
| 47 | Humaedi                | 75  | 75  | 75  | 75  | 75  | 100 |
| 48 | Nahrowi                | 75  | 75  | 75  | 75  | 75  | 25  |
| 49 | Subadri Bin Jasian     | 75  | 75  | 75  | 100 | 75  | 75  |
| 50 | Asngari                | 50  | 50  | 50  | 50  | 75  | 25  |
| 51 | Suparto                | 75  | 75  | 75  | 75  | 75  | 0   |
| 52 | Maman Sudarman         | 75  | 75  | 75  | 75  | 75  | 100 |
| 53 | Sukali                 | 75  | 75  | 75  | 75  | 75  | 0   |
| 54 | Nurdin                 | 0   | 0   | 0   | 25  | 25  | 25  |
| 55 | Muhyadi B.Sahenden     | 100 | 100 | 100 | 75  | 75  | 50  |
| 56 | Amir                   | 75  | 75  | 75  | 75  | 75  | 25  |
| 57 | Maman suryana          | 50  | 50  | 50  | 75  | 75  | 25  |

Pengambilan alternatif Dari database

```php
// Memanggil alternatif (Karyawan Habis Kontrak)
$dataKaryawan = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->get();

// Pengambilan Nilai Alternatif
$alternatif = array();
foreach($dataKaryawan as $d){
    $alternatif[$d->id]=$d->nama;
}

```

Data array yang ada pada variabel ```$dataKaryawan``` ditata ulang di variabel ```$alternatif``` dan seperti yang terlihat pada Gambar **Dibawah** menyisakan hanya index yang berupa id dari table karyawans, yang memiliki item nama karyawan.

![alternatif](https://lh3.googleusercontent.com/--xM7xqb14Mo/YAgcgtEh_QI/AAAAAAAAA9s/xI22tlROEQkP4hX5MDPIMfGBDjUdS1GzQCK8BGAsYHg/s0/2021-01-20.png)

### Menentukan Nilai Kriteria
|     No    |     Kriteria                     |
|-----------|----------------------------------|
| C1        | Kehadiran                        |
| C2        | Motivasi Kerja                   |
| C3        | Komunikasi dan Tanggung jawab    |
| C4        | Penguasaan pekerjaan             |
| C5        | Penghargaan dan Sanksi           |
| C6        | Usia                             |

Penentuan **kriteria** ini menjadi hal terpenting yang harus dilakukan dalam perancangan menggunakan metode SMART.
### Penentuan Bobot Dari **Kriteria**
| No    | Kriteria                      | Bobot |
|-------|-------------------------------|-------|
| C1    | Kehadiran                     | 20    |
| C2    | Motivasi kerja                | 15    |
| C3    | Komunikasi dan Tanggung jawab | 15    |
| C4    | Penguasaan pekerjaan          | 30    |
| C5    | Penghargaan dan sanksi        | 10    |
| C6    | Usia                          | 10    |
| Total |                               | 100   |

Dari tabel diatas setelah dilakukan penginputan ke dalam data base. dapat diambil datanya dengan menggunakan kode berikut:

```php
// Memanggil semua data yang ada pada tabel kriteria
$kriteria = Kriteria::get();

// Pengambilan Nilai Kriteria
$kriterias = array();
foreach ($kriteria as $k){
    $kriterias[$k->id]=array(
        $k->kriteria,
        $k->bobot,
        $k->tipe
    );
}
```

setelah dilakukan **dumping** data untuk pengecekan variabel data ```$kriterias```. Dan nantinya akan lebih mudah untuk dilakukan manipulasi pada array.

![kriteria](https://lh3.googleusercontent.com/-RuiTf_Jxlcc/YAga8TapFVI/AAAAAAAAA9g/CPreVOSS0BIlqHFstu_yRa1e1exb2h5AACK8BGAsYHg/s0/2021-01-20.png)

