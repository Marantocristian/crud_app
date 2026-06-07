<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('clientes') || ! Schema::hasColumn('clientes', 'telefono')) {
            return;
        }

        // Usar el método nativo de Laravel (compatible con PostgreSQL, SQLite, MySQL)
        $indexes = Schema::getIndexes('clientes');
        $exists = collect($indexes)->contains(fn($i) => $i['name'] === 'clientes_telefono_unique');

        if ($exists) {
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

        $indexes = Schema::getIndexes('clientes');
        $exists = collect($indexes)->contains(fn($i) => $i['name'] === 'clientes_telefono_unique');

        if (! $exists) {
            return;
        }

        Schema::table('clientes', function (Blueprint $table) {
            $table->dropUnique(['telefono']);
        });
    }
};
