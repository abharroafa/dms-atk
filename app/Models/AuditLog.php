<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nota_id',
        'aksi',
        'detail',
        'ip_address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function nota(): BelongsTo
    {
        return $this->belongsTo(Nota::class);
    }

    public static function catat(
        string $aksi,
        ?int $notaId = null,
        array $detail = [],
        ?int $userId = null,
        ?string $ipAddress = null
    ): self {
        return self::create([
            'user_id' => $userId ?? auth()->id(),
            'nota_id' => $notaId,
            'aksi' => $aksi,
            'detail' => empty($detail)
                ? null
                : json_encode($detail, JSON_UNESCAPED_UNICODE),
            'ip_address' => $ipAddress
                ?? request()->ip(),
        ]);
    }
}
