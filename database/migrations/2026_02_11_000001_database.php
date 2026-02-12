<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('clientes')) {
            return;
        }

        if (Schema::hasColumn('clientes', 'full_name')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('full_name', 'nombre_completo');
            });
        }

        if (Schema::hasColumn('clientes', 'email')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('email', 'correo');
            });
        }

        if (Schema::hasColumn('clientes', 'phone')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('phone', 'telefono');
            });
        }

        if (Schema::hasColumn('clientes', 'address')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('address', 'direccion');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('clientes')) {
            return;
        }

        if (Schema::hasColumn('clientes', 'nombre_completo')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('nombre_completo', 'full_name');
            });
        }

        if (Schema::hasColumn('clientes', 'correo')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('correo', 'email');
            });
        }

        if (Schema::hasColumn('clientes', 'telefono')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('telefono', 'phone');
            });
        }

        if (Schema::hasColumn('clientes', 'direccion')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->renameColumn('direccion', 'address');
            });
        }
    }
};
