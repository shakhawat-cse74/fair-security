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
        Schema::create('division_wise_securities', function (Blueprint $table) {
            $table->id();
            $table->string('division_name');
            $table->string('security_qty')->nullable();
            $table->string('security_purpose')->nullable();
            $table->string('deployment_area')->nullable();
            $table->string('support_staff')->nullable();
            $table->string('total_employees')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_wise_securities');
    }
};
