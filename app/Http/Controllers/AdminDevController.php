<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminDevController extends Controller
{

    public function tambahAdminKlien (int $id_sekolah)
    {
        // dd($id_sekolah);

        $info_sekolah = Clien::where('id_sekolah', $id_sekolah)->first();
    
        return view('adminDev.tambah_admin_klien', ['info_sekolah' => $info_sekolah]);
    }

    public function daftarKlien ()
    {
        // This method is for the list page, which seems to be part of the dashboard now.
        // If you have a separate client list page, you can implement it here.
        return redirect()->route('dashboard');
    }

    public function infoKlien (Request $request, int $id_sekolah) {
        $admin_sekolah = User::where('id_sekolah', $id_sekolah)->where('role', 'admin')->get();
        $info_sekolah = Clien::where('id_sekolah', $id_sekolah)->first();

        return view('adminDev.info_klien', ['info_sekolah' => $info_sekolah, 'admin_sekolah' => $admin_sekolah, 'id_sekolah' => $id_sekolah]);

    }

     public function storeAdmin(Request $request, int $id_sekolah)
    {
        $validator = Validator::make($request->all(), [
            'admin' => 'required|array|min:1',
            'admin.*.username' => 'required|string|distinct|unique:users',
            'admin.*.nama' => 'required|string|max:255',
            'admin.*.password' => 'required|string|min:6',
            'admin.*.nip' => 'nullable|string|max:20',
            'admin.*.email' => 'nullable|email|max:255',
            'admin.*.alamat' => 'nullable|string|max:255',
            'admin.*.no_telp' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        foreach ($request->admin as $adminData) {
            // Pastikan semua data yang diperlukan ada sebelum membuat user
            if (isset($adminData['nama'], $adminData['username'], $adminData['password'])) {
                User::create([
                    'name' => $adminData['nama'],
                    'email' => $adminData['email' ?? ''],
                    'password' => $adminData['password'],
                    'nisn_nik' => $adminData['nip'] ?? '',
                    'username' => $adminData['username'],
                    'alamat' => $adminData['alamat'] ?? '',
                    'no_telp' => $adminData['no_telp' ?? ''],
                    'role' => 'admin', // Otomatis mengatur role sebagai guru
                    'id_sekolah' => $id_sekolah,
                ]);
            }
        }

        return response()->json(['message' => 'Data semua guru berhasil disimpan!'], 200);
    }

    public function tambahKlien()
    {
        return view('adminDev.tambah_klien');
    }

    public function storeKlien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sekolah' => 'required|string|max:255',
            'email' => 'required|email|unique:cliens,email',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Clien::create([
            'nama_sekolah' => $request->input('nama_sekolah'),
            'email' => $request->input('email'),
            'no_telp' => $request->input('no_telp'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Data klien berhasil disimpan!');
    }

    public function updateAdminKlien (Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'password' => 'nullable|string|min:6',
            'admin.*.nik' => 'nullable|string|max:20',
            'admin.*.email' => 'nullable|email|max:255',
            'admin.*.alamat' => 'nullable|string|max:255',
            'admin.*.no_telp' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);

        $updateData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'nisn_nik' => $request->input('nik') ?? '',
            'alamat' => $request->input('alamat') ?? '',
            'no_telp' => $request->input('no_telp') ?? '',

        ];

        if ($request->input('password')){
            $updateData['password'] = $request->input('password');
        }

        $user->update($updateData);

        // Redirect back to the client info page with a success message
        return redirect()->route('infoKlien', ['id_sekolah' => $user->id_sekolah])
                         ->with('success', 'Data admin berhasil diperbarui!');

    }

    public function destroyAdminKlien(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $id_sekolah = $user->id_sekolah;

        $user->delete();

        // Redirect back to the client info page with a success message
        // We need to reconstruct the POST request to infoKlien or change infoKlien to use GET
        // For simplicity, let's assume we can redirect with parameters.
        // With the route fixed to GET, this now works correctly.
        return redirect()->route('infoKlien', ['id_sekolah' => $id_sekolah])->with('success', 'Admin berhasil dihapus.');
    }

    public function updateKlien(Request $request, int $id)
    {
        $Clien = Clien::where('id_sekolah', $id)->first();

        Validator::make($request->all(), [
            'nama_sekolah' =>'required|string|max:255',
            'email' => 'required|email|max:255|unique:cliens,email,'.$id.',id_sekolah',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'status' =>'required|in:Aktif, Pending, Non-Aktif',
        ]);

        $Clien->update([
            'nama_sekolah' => $request->input('nama_sekolah'),
            'email' => $request->input('email'),
            'no_telp' => $request->input('no_telp'),
            'alamat' => $request->input('alamat'),
            'status' => $request->input('status'),
        ]);

        // Redirect back to the client info page with a success message
        return redirect()->route('infoKlien', ['id_sekolah' => $id])
                         ->with('success', 'Data klien berhasil diperbarui!');
    }

}