<?php

use App\Enums\StatusAbsensi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained('class_rooms')->onDelete('cascade');
            $table->date('tanggal');
            $table->dateTime('jam_masuk')->nullable();
            $table->dateTime('jam_pulang')->nullable();
            $table->enum('status', [
                StatusAbsensi::alpha->value,
                StatusAbsensi::hadir->value,
                StatusAbsensi::sakit->value,
                StatusAbsensi::izin->value,
                StatusAbsensi::others->value
            ])->default(StatusAbsensi::others->value);
            $table->text('message')->nullable();
            $table->foreignId('scanned_masuk_by')->nullable()->constrained('teachers')->onDelete('set null');
            $table->foreignId('scanned_pulang_by')->nullable()->constrained('teachers')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
