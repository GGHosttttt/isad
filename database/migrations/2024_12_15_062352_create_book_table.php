<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->Integer('fieldId'); // Auto-incrementing and unique field ID
            $table->string('username'); // String for username
            $table->string('phoneNumber'); // String for phone number
            $table->integer('time'); // Time column
            $table->date('date'); // Date column
            $table->text('message'); // Text column for longer messages
            $table->tinyInteger('status')      // Status column with default value
                ->default(0)                 // Default to 0 (e.g., "waiting for approval")
                ->comment('0: Waiting, 1: Approved, 2: Rejected'); // Optional for clarity

            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
