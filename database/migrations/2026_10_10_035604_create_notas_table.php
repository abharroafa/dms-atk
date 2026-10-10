
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_nota')->nullable();
            $table->string('nama_supplier')->nullable();
            $table->date('tanggal_nota')->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->string('file_path');
            $table->string('file_name');
            $table->string('kategori')->nullable();
            $table->enum('status', ['draft', 'tersimpan'])
                  ->default('draft');
            $table->foreignId('uploaded_by')
                  ->constrained('users')
                  ->restrictOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('tanggal_nota');
            $table->index('kategori');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
