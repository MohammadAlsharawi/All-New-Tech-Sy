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
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('post_code');
            $table->foreignId('property_type_id')->constrained();
            $table->string('address');
            $table->foreignId('service_id')->constrained();
            $table->date('preferred_date');
            $table->foreignId('preferred_time_id')->constrained();
            $table->text('notes')->nullable();
            $table->boolean('confirmation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_visits');
    }
};
