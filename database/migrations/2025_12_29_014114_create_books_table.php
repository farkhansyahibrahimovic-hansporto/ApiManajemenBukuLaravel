<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
      Schema::create('books', function (Blueprint $table) {
    $table->id();

    $table->foreignId('category_id')
          ->constrained('categories')
          ->cascadeOnDelete();

    $table->string('judul');
    $table->string('penulis');
    $table->string('penerbit')->nullable();
    $table->integer('tahun_terbit');
    $table->integer('stok')->default(0);
    $table->text('deskripsi')->nullable();

    $table->timestamps();
});
    }
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
