<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('clientes', 'name') && !Schema::hasColumn('clientes', 'nombre_completo')) {
            DB::statement('ALTER TABLE clientes RENAME COLUMN name TO nombre_completo');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('clientes', 'nombre_completo') && !Schema::hasColumn('clientes', 'name')) {
            DB::statement('ALTER TABLE clientes RENAME COLUMN nombre_completo TO name');
        }
    }
};
