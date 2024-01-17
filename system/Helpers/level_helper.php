<?php

if (!function_exists('level_user')) {
    function level_user(string $namaController, string $namaFunction, string $kategori, string $akses): string
    {
        $db = db_connect(); // Mengambil koneksi database

        $query = $db->table('kategori_user_modul a')
            ->join('modul b', 'b.id = a.modul')
            ->select('a.kategori_user')
            ->where([
                'a.kategori_user' => $kategori,
                'a.akses' => $akses,
                'b.nama_function' => $namaFunction,
                'b.controller' => $namaController,
            ])
            ->get();

        return $query->getNumRows();
    }
}
