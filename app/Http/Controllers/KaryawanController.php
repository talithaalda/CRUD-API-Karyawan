<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\KaryawanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class KaryawanController extends BaseController
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return KaryawanResource::collection($karyawans);
    }

    public function show($id)
    {
        $karyawan = Karyawan::find($id);
        if (is_null($karyawan)) {
            return $this->handleError('Karyawan tidak ditemukan!');
        }
        return $this->handleResponse(new KaryawanResource($karyawan), 'Karyawan ditemukan.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nomor_induk' => 'required|unique:karyawans|max:255',
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
        ]);
        if($validator->fails()){
            return $this->handleError($validator->errors());
        }
        $karyawan = Karyawan::create($input);
        return $this->handleResponse(new KaryawanResource($karyawan), 'Karyawan berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nomor_induk' => 'required|max:255',
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
        ]);
        if($validator->fails()){
            return $this->handleError($validator->errors());
        }
        $karyawan = Karyawan::find($id);
        $karyawan->update($input);
        return $this->handleResponse(new KaryawanResource($karyawan), 'Karyawan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        if (is_null($karyawan)) {
            return $this->handleError('ID tidak ada!');
        }
        $karyawan->delete();
        return $this->handleResponse([], 'Karyawan berhasil dihapus!');
    }
    public function tigakaryawanpertama()
    {
        $karyawans = Karyawan::orderBy('tanggal_bergabung')->take(3)->get();
        return response()->json($karyawans);
    }
    public function CutiKaryawan()
    {
        $karyawans = Karyawan::has('Cuti')->get();
        return response()->json($karyawans);
    }
    public function sisaCutiKaryawan()
    {
        $karyawans = Karyawan::with('Cuti')->get();

        $karyawans->map(function ($karyawan) {
            $totalCuti = $karyawan->Cuti ? $karyawan->Cuti->sum('lama_cuti') : 0;
            $sisaCuti = 12 - $totalCuti;
            $karyawan->sisa_cuti = $sisaCuti;
            return $karyawan;
        });

        $data = $karyawans->map(function ($karyawan) {
            return [
                'nomor_induk' => $karyawan->nomor_induk,
                'nama' => $karyawan->nama,
                'sisa_cuti' => $karyawan->sisa_cuti,
            ];
        });

        return response()->json($data);
    }
}
