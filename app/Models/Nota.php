<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nota extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nomor_nota',
        'nama_supplier',
        'tanggal_nota',
        'total',
        'file_path',
        'file_name',
        'kategori',
        'status',
        'uploaded_by',
        'verified_at',
    ];

    protected $casts = [
        'tanggal_nota' => 'date',
        'total' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(NotaItem::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
