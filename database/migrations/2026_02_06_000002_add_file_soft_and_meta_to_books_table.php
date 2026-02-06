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
        Schema::table('books', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('is_available');
            $table->timestamp('last_modified_at')->nullable()->after('file_path');
            $table->decimal('average_rating', 3, 2)->nullable()->after('last_modified_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'last_modified_at', 'average_rating']);
            $table->dropSoftDeletes();
        });
    }
};
