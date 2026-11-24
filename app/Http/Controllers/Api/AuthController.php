<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataAlamatCustomer;
use App\Models\DataUser;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register Akun User / Customer menggunakan JWT
     * Tabel: users (akun user/customer) & data_users (data user)
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:30',
            'password' => 'required|string|min:6',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'no_telpon' => $validated['phone'],
            'role' => 'customer',
            'password' => Hash::make($validated['password']),
        ]);

        // Simpan ke tabel data_users
        $dataUser = DataUser::create([
            'id_customer' => $user->id,
            'nama_lengkap' => $user->name,
            'email_akun' => $user->email,
            'no_telpon' => $user->no_telpon,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? '1998-05-14',
            'gender' => 'Wanita',
            'tier' => 'GOLD MEMBER',
            'avatar' => '/images/siti-rahma-avatar.jpg',
        ]);

        $token = JwtService::generateToken($user);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi akun customer berhasil! Token JWT telah diterbitkan.',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $this->formatUserPayload($user->fresh(['dataUser', 'alamatCustomers'])),
        ], 201);
    }

    /**
     * Login Akun User / Customer menggunakan Email & Password (JWT)
     */
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = strtolower(trim($validated['email']));
        $user = User::with(['dataUser', 'alamatCustomers'])->where('email', $email)->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password tidak sesuai. Silakan periksa kembali atau daftar akun baru.',
            ], 401);
        }

        // Pastikan record data_users tersedia
        if (!$user->dataUser) {
            DataUser::create([
                'id_customer' => $user->id,
                'nama_lengkap' => $user->name,
                'email_akun' => $user->email,
                'no_telpon' => $user->no_telpon ?? '081234567890',
                'tanggal_lahir' => '1998-05-14',
                'gender' => 'Wanita',
                'tier' => 'GOLD MEMBER',
                'avatar' => '/images/siti-rahma-avatar.jpg',
            ]);
            $user->load('dataUser');
        }

        $token = JwtService::generateToken($user);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil! Selamat datang di Koafy by HSK Secret.',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $this->formatUserPayload($user),
        ]);
    }

    /**
     * Login Admin dengan Gmail & Password menggunakan JWT (http://127.0.0.1:8000/login/admin)
     */
    public function adminLogin(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $email = strtolower(trim($validated['email']));

        $user = User::where('email', $email)->first();

        if ($user) {
            if (!Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password Admin tidak sesuai untuk akun ' . $email,
                ], 401);
            }
            if ($user->role !== 'admin') {
                $user->update(['role' => 'admin']);
            }
        } else {
            // Validasi email gmail atau admin
            if (!str_ends_with($email, '@gmail.com') && !str_contains($email, 'admin')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gunakan akun Gmail resmi Admin (@gmail.com) untuk masuk ke Dashboard Admin.',
                ], 422);
            }

            // Buat akun admin baru di database jika login pertama kali dengan Gmail
            $namePart = ucfirst( explode('@', $email)[0] );
            $user = User::create([
                'name' => 'Admin ' . $namePart,
                'email' => $email,
                'no_telpon' => '081809607187',
                'role' => 'admin',
                'password' => Hash::make($validated['password']),
            ]);
        }

        $token = JwtService::generateToken($user);

        return response()->json([
            'success' => true,
            'message' => 'Autentikasi JWT Admin berhasil! Selamat datang, ' . $user->name,
            'token' => $token,
            'token_type' => 'Bearer',
            'admin' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => 'admin',
            ],
        ]);
    }

    /**
     * Cek profil & sesi JWT aktif
     */
    public function me(Request $request): JsonResponse
    {
        $user = JwtService::userFromRequest($request);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Token JWT tidak valid atau telah kedaluwarsa.',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => $this->formatUserPayload($user),
        ]);
    }

    /**
     * Update Data User (Profil Lengkap Customer: nama_lengkap, email_akun, no_telpon, tanggal_lahir)
     */
    public function updateProfile(Request $request): JsonResponse
    {
        $user = JwtService::userFromRequest($request);
        if (!$user) {
            $userId = $request->input('id_customer');
            $user = $userId ? User::find($userId) : User::where('role', 'customer')->first();
        }

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Customer tidak ditemukan'], 404);
        }

        $user->update([
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
            'no_telpon' => $request->input('phone', $user->no_telpon),
        ]);

        DataUser::updateOrCreate(
            ['id_customer' => $user->id],
            [
                'nama_lengkap' => $request->input('name', $user->name),
                'email_akun' => $request->input('email', $user->email),
                'no_telpon' => $request->input('phone', $user->no_telpon),
                'tanggal_lahir' => $request->input('birthDate') ?: $request->input('tanggal_lahir', '1998-05-14'),
                'gender' => $request->input('gender', 'Wanita'),
                'tier' => $request->input('tier', 'GOLD MEMBER'),
                'avatar' => $request->input('avatar', '/images/siti-rahma-avatar.jpg'),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Data profil customer berhasil diperbarui di database.',
            'user' => $this->formatUserPayload($user->fresh(['dataUser', 'alamatCustomers'])),
        ]);
    }

    /**
     * Ambil daftar alamat customer dari tabel data_alamat_customers
     */
    public function getAddresses(Request $request): JsonResponse
    {
        $user = JwtService::userFromRequest($request);
        $query = DataAlamatCustomer::query()->orderByDesc('is_primary')->orderByDesc('id');
        if ($user) {
            $query->where('id_customer', $user->id);
        } elseif ($request->filled('id_customer')) {
            $query->where('id_customer', $request->input('id_customer'));
        }

        $addresses = $query->get()->map(fn (DataAlamatCustomer $a) => $this->formatAddress($a));

        return response()->json([
            'success' => true,
            'addresses' => $addresses,
        ]);
    }

    /**
     * Tambah alamat baru ke tabel data_alamat_customers
     */
    public function storeAddress(Request $request): JsonResponse
    {
        $user = JwtService::userFromRequest($request);
        $customerId = $user?->id ?? $request->input('id_customer') ?? User::where('role', 'customer')->value('id');

        if (!$customerId) {
            $defaultCustomer = User::firstOrCreate(
                ['email' => 'siti.rahma@example.com'],
                [
                    'name' => 'Siti Rahma',
                    'no_telpon' => '081234567890',
                    'role' => 'customer',
                    'password' => Hash::make('password123'),
                ]
            );
            $customerId = $defaultCustomer->id;
        }

        $isPrimary = (bool) $request->input('isPrimary', false);
        if ($isPrimary) {
            DataAlamatCustomer::where('id_customer', $customerId)->update(['is_primary' => false]);
        }

        $addr = DataAlamatCustomer::create([
            'id_customer' => $customerId,
            'label_alamat' => $request->input('label_alamat') ?? $request->input('label', 'Rumah Utama'),
            'no_telpon' => $request->input('no_telpon') ?? $request->input('phone', '081234567890'),
            'nama_penerima' => $request->input('nama_penerima') ?? $request->input('recipientName', 'Siti Rahma'),
            'alamat_penerima' => $request->input('alamat_penerima') ?? $request->input('fullAddress', ''),
            'kecamatan' => $request->input('kecamatan') ?? $request->input('area', 'Kebayoran Baru, Jakarta Selatan'),
            'kode_pos' => $request->input('kode_pos') ?? $request->input('postalCode', '12110'),
            'catatan' => $request->input('catatan') ?? $request->input('notes', ''),
            'is_primary' => $isPrimary,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Alamat pengiriman berhasil disimpan ke database.',
            'address' => $this->formatAddress($addr),
        ], 201);
    }

    /**
     * Update alamat customer di tabel data_alamat_customers
     */
    public function updateAddress(Request $request, int $id): JsonResponse
    {
        $addr = DataAlamatCustomer::findOrFail($id);

        if ($request->boolean('isPrimary')) {
            DataAlamatCustomer::where('id_customer', $addr->id_customer)->update(['is_primary' => false]);
        }

        $addr->update([
            'label_alamat' => $request->input('label_alamat') ?? $request->input('label', $addr->label_alamat),
            'no_telpon' => $request->input('no_telpon') ?? $request->input('phone', $addr->no_telpon),
            'nama_penerima' => $request->input('nama_penerima') ?? $request->input('recipientName', $addr->nama_penerima),
            'alamat_penerima' => $request->input('alamat_penerima') ?? $request->input('fullAddress', $addr->alamat_penerima),
            'kecamatan' => $request->input('kecamatan') ?? $request->input('area', $addr->kecamatan),
            'kode_pos' => $request->input('kode_pos') ?? $request->input('postalCode', $addr->kode_pos),
            'catatan' => $request->input('catatan') ?? $request->input('notes', $addr->catatan),
            'is_primary' => $request->has('isPrimary') ? $request->boolean('isPrimary') : $addr->is_primary,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Alamat berhasil diperbarui.',
            'address' => $this->formatAddress($addr),
        ]);
    }

    /**
     * Hapus alamat customer
     */
    public function deleteAddress(int $id): JsonResponse
    {
        $addr = DataAlamatCustomer::findOrFail($id);
        $addr->delete();

        return response()->json([
            'success' => true,
            'message' => 'Alamat berhasil dihapus.',
        ]);
    }

    private function formatUserPayload(User $user): array
    {
        $profile = $user->dataUser;
        return [
            'id' => $user->id,
            'id_customer' => $user->id,
            'name' => $profile?->nama_lengkap ?? $user->name,
            'nama_customer' => $user->name,
            'nama_lengkap' => $profile?->nama_lengkap ?? $user->name,
            'email' => $user->email,
            'email_akun' => $profile?->email_akun ?? $user->email,
            'phone' => $profile?->no_telpon ?? $user->no_telpon ?? '081234567890',
            'no_telpon' => $profile?->no_telpon ?? $user->no_telpon ?? '081234567890',
            'birthDate' => $profile?->tanggal_lahir ?? '1998-05-14',
            'tanggal_lahir' => $profile?->tanggal_lahir ?? '1998-05-14',
            'gender' => $profile?->gender ?? 'Wanita',
            'tier' => $profile?->tier ?? 'GOLD MEMBER',
            'avatar' => $profile?->avatar ?? '/images/siti-rahma-avatar.jpg',
            'role' => $user->role ?? 'customer',
            'addresses' => $user->alamatCustomers
                ? $user->alamatCustomers->map(fn (DataAlamatCustomer $a) => $this->formatAddress($a))->values()
                : [],
        ];
    }

    private function formatAddress(DataAlamatCustomer $a): array
    {
        return [
            'id' => $a->id,
            'id_customer' => $a->id_customer,
            'label' => $a->label_alamat,
            'label_alamat' => $a->label_alamat,
            'recipientName' => $a->nama_penerima,
            'nama_penerima' => $a->nama_penerima,
            'phone' => $a->no_telpon,
            'no_telpon' => $a->no_telpon,
            'fullAddress' => $a->alamat_penerima,
            'alamat_penerima' => $a->alamat_penerima,
            'area' => $a->kecamatan,
            'kecamatan' => $a->kecamatan,
            'postalCode' => $a->kode_pos,
            'kode_pos' => $a->kode_pos,
            'notes' => $a->catatan ?? '',
            'catatan' => $a->catatan ?? '',
            'isPrimary' => (bool) $a->is_primary,
        ];
    }
}
