<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{

    public function nilaiRT()
    {
        try {

            $data = DB::select("
                SELECT
                    nisn,
                    nama,

                    SUM(CASE WHEN nama_pelajaran = 'REALISTIC'
                        THEN skor ELSE 0 END) AS realistic,

                    SUM(CASE WHEN nama_pelajaran = 'INVESTIGATIVE'
                        THEN skor ELSE 0 END) AS investigative,

                    SUM(CASE WHEN nama_pelajaran = 'ARTISTIC'
                        THEN skor ELSE 0 END) AS artistic,

                    SUM(CASE WHEN nama_pelajaran = 'SOCIAL'
                        THEN skor ELSE 0 END) AS social,

                    SUM(CASE WHEN nama_pelajaran = 'ENTERPRISING'
                        THEN skor ELSE 0 END) AS enterprising,

                    SUM(CASE WHEN nama_pelajaran = 'CONVENTIONAL'
                        THEN skor ELSE 0 END) AS conventional,

                    SUM(skor) AS total

                FROM nilai

                WHERE materi_uji_id = 7
                AND nama_pelajaran != 'Pelajaran Khusus'

                GROUP BY nisn, nama

                ORDER BY total DESC
            ");

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);

        }
    }


    public function nilaiST()
    {
        try {

            $data = DB::select("
                SELECT
                    nisn,
                    nama,

                    SUM(CASE WHEN pelajaran_id = 44
                        THEN skor * 41.67 ELSE 0 END) AS verbal,

                    SUM(CASE WHEN pelajaran_id = 45
                        THEN skor * 29.67 ELSE 0 END) AS kuantitatif,

                    SUM(CASE WHEN pelajaran_id = 46
                        THEN skor * 100 ELSE 0 END) AS penalaran,

                    SUM(CASE WHEN pelajaran_id = 47
                        THEN skor * 23.81 ELSE 0 END) AS figural,

                    SUM(
                        CASE
                            WHEN pelajaran_id = 44 THEN skor * 41.67
                            WHEN pelajaran_id = 45 THEN skor * 29.67
                            WHEN pelajaran_id = 46 THEN skor * 100
                            WHEN pelajaran_id = 47 THEN skor * 23.81
                            ELSE 0
                        END
                    ) AS total

                FROM nilai

                WHERE materi_uji_id = 4

                GROUP BY nisn, nama

                ORDER BY total DESC
            ");

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);

        }
    }

}
