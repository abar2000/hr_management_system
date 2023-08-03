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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee')->unsigned()->index()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->bigInteger('type')->unsigned()->index()->nullable();
            $table->foreign('type')->references('id')->on('leave_types')->onDelete('set null');
            $table->date('request_on');
            $table->date('dates');
            $table->integer('days');
            $table->string('reason');
            $table->string('status');
            $table->bigInteger('aproved_by')->unsigned()->index()->nullable();
            $table->foreign('aproved_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
