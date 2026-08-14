<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'qr_code')) {
                $table->string('qr_code')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'card_uid')) {
                $table->string('card_uid')->nullable()->after('qr_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['qr_code', 'card_uid']);
        });
    }
};