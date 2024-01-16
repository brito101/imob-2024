<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('experiences')->insert([
            [
                'name'      => 'Casa',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'Terreno',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'Apartamento Padrão',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'Cobertura',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'Alto Padrão',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'De frente para o Mar',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'Condomínio Fechado',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'Compacto',
                'created_at' => new \DateTime('now')
            ],
            [
                'name'      => 'Lojas e Salas',
                'created_at' => new \DateTime('now')
            ]
        ]);

        DB::statement("
        CREATE OR REPLACE VIEW `experiences_view` AS
        SELECT e.id, e.name
        FROM experiences as e
        WHERE e.deleted_at IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
        DB::statement("DROP VIEW experiences_view");
    }
};
