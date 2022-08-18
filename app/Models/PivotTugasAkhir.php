<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotTugasAkhir extends Model
{
    use HasFactory;
    protected $table = 'tbl_pivot_tugas_akhir';
    protected $fillable = [
        'mahasiswa_id',
        'dosbing1_id',
        'dosbing2_id',
    ];
}