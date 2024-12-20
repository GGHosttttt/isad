<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Stores the name
            $table->text('detail'); // Suitable for larger text like details
            $table->float('price', 2); // Price with 2 decimal places
            $table->tinyInteger('bookStatus')      // Status column with default value
                ->default(1)                 // Default to 0 (e.g., "waiting for approval")
                ->comment('0: NotAvaliable, 1: Avaliable, 2: Using'); // Optional for clarity
            $table->string('image'); // Store image path or URL

            $table->timestamps(); // Created_at and Updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
