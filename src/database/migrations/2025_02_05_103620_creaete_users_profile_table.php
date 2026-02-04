<?php

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
        Schema::create('users_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('jenis_identitas', array_column(\App\Enums\JenisIdentitasEnum::cases(), 'value'))->nullable();
            $table->string('nomor_identitas', 50)->nullable();
            $table->boolean('has_npwp')->default(false);
            $table->enum('jenis_kelamin', array_column(\App\Enums\JenisKelaminEnum::cases(), 'value'))->nullable();
            $table->string('ponsel', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('instansi', 50)->nullable();
            $table->enum('pendidikan', array_column(\App\Enums\JenisPendidikanEnum::cases(), 'value'))->nullable();
            $table->string('profile_photo')->nullable();
            // Timestamps and user tracking
            $table->unsignedBigInteger(('created_by'))->nullable();
            $table->unsignedBigInteger(('updated_by'))->nullable();
            $table->unsignedBigInteger(('deleted_by'))->nullable();
            // Timestamps and user tracking Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
            // timestamps 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
