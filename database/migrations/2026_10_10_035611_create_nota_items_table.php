
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nota_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('nota_id')
                ->constrained('notas')
                ->cascadeOnDelete();

            $table->string('nama_barang')->nullable();
            $table->decimal('jumlah', 12, 2)->default(1);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_items');
    }
};
