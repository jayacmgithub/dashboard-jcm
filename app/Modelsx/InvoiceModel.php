<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'progress_invoice';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['kode', 'id_pkp', 'item', 'rencana', 'realisasi', 'keterangan'];

    public function updateInvoice($postData)
    {
        $data3 = [
            "memo_tagihan" => $postData['memo_tagihan'],
            "kwitansi" => strtoupper($postData["kwitansi"]),
            "keterangan" => $postData["keterangan"],
            "realisasi" => $postData["realisasi"],

        ];
        return $this->db->table('progress_invoice')->where('id', $postData['idd'])->update($data3);
    }

}
