<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\PpdbSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class PpdbSettingController extends Controller
{
    /**
     * Display the PPDB settings form.
     * @return Renderable
     */
    public function index()
    {
        $setting = PpdbSetting::first();
        if (!$setting) {
            $setting = new PpdbSetting();
            $setting->is_active = true;
            $setting->save();
        }
        
        return view('ppdb::backend.settings.index', compact('setting'));
    }

    /**
     * Update the PPDB settings.
     * @param Request $request
     * @return Redirect
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $setting = PpdbSetting::first();
            if (!$setting) {
                $setting = new PpdbSetting();
            }
            
            $setting->tanggal_buka = $request->tanggal_buka;
            $setting->tanggal_tutup = $request->tanggal_tutup;
            $setting->is_active = $request->has('is_active');
            $setting->pesan_nonaktif = $request->pesan_nonaktif;
            $setting->save();
            
            DB::commit();
            FacadesSession::flash('success', 'Pengaturan PPDB berhasil disimpan!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            FacadesSession::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
