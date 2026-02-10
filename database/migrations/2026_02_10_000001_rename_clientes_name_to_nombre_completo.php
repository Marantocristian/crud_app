<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('clientes', 'name') && !Schema::hasColumn('clientes', 'full_name')) {
            DB::statement('ALTER TABLE clientes RENAME COLUMN name TO full_name');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('clientes', 'full_name') && !Schema::hasColumn('clientes', 'name')) {
            DB::statement('ALTER TABLE clientes RENAME COLUMN full_name TO name');
        }
    }
};
