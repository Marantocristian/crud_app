<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('clientes') || ! Schema::hasColumn('clientes', 'telefono')) {
            return;
        }

        if ($this->constraintExists('clientes', 'clientes_telefono_unique')) {
            return;
        }

        Schema::table('clientes', function (Blueprint $table) {
            $table->unique('telefono');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('clientes') || ! Schema::hasColumn('clientes', 'telefono')) {
            return;
        }

        if (! $this->constraintExists('clientes', 'clientes_telefono_unique')) {
            return;
        }

        Schema::table('clientes', function (Blueprint $table) {
            $table->dropUnique(['telefono']);
        });
    }

    private function constraintExists(string $table, string $constraint): bool
    {
        return DB::table('information_schema.table_constraints')
            ->where('table_schema', 'public')
            ->where('table_name', $table)
            ->where('constraint_name', $constraint)
            ->exists();
    }
};
