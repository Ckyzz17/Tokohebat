Dampak Jika “Code Yoga” Dibiarkan di Production
1. Authentication Bypass (Login Tanpa Password)
Vulnerability
Pada versi awal, sistem login hanya mengecek email tanpa memverifikasi password.
Contoh vulnerable code:
$user = $this->userRepository->findByEmail(    $request->email);Auth::login($user);
Dampak


Siapa pun dapat login sebagai user lain hanya dengan mengetahui email korban.


Account takeover sangat mudah dilakukan.


Data pribadi pengguna dapat dicuri.


Penyerang bisa mengakses fitur internal tanpa autentikasi valid.


Risiko


Kebocoran data pengguna


Penyalahgunaan akun


Kerugian bisnis


Pelanggaran keamanan sistem


Solusi
Menggunakan:
Auth::attempt($credentials)
agar email dan password diverifikasi dengan benar.

2. Privilege Escalation (Naik Role Jadi Admin)
Vulnerability
Role admin diambil langsung dari request URL.
Contoh vulnerable code:
if ($request->role !== 'admin')
Dampak
User biasa dapat mengubah parameter URL:
/admin/dashboard?role=admin
dan langsung mendapatkan akses admin.
Risiko


Pengambilalihan panel admin


Manipulasi data sistem


Penghapusan data penting


Perubahan hak akses user


Full system compromise


Solusi
Role harus diambil dari user yang sudah terautentikasi:
auth()->user()->role
serta dilindungi middleware authorization.

3. Plaintext Password Storage
Vulnerability
Password disimpan langsung ke database tanpa hashing.
Contoh vulnerable code:
'password' => $request->password
Dampak
Jika database bocor:


seluruh password user langsung terlihat


attacker bisa menggunakan password tersebut di platform lain


Karena banyak user memakai password yang sama di:


Gmail


Facebook


Instagram


Mobile banking


maka dampaknya bisa meluas ke luar aplikasi.
Risiko


Credential stuffing attack


Kebocoran akun massal


Penyalahgunaan identitas user


Kerugian finansial


Pelanggaran compliance/security standard


Solusi
Password wajib di-hash menggunakan:
Hash::make($password)
atau cast Laravel:
'password' => 'hashed'

Kesimpulan
Ketiga vulnerability pada “Code Yoga” termasuk kategori critical vulnerability karena mempengaruhi:


Authentication


Authorization


Credential Security


Jika dibiarkan di production, aplikasi berpotensi mengalami:


account takeover


data breach


privilege escalation


system compromise


Oleh karena itu dilakukan perbaikan menggunakan:


Auth::attempt()


Middleware authorization


Role validation dari database


Password hashing


Laravel Sanctum token authentication


agar aplikasi menjadi lebih aman dan sesuai best practice backend security Laravel.