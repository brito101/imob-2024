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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('headline')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('type_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('experience_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->string('cover')->nullable();
            $table->boolean('sale')->nullable();
            $table->boolean('rent')->nullable();

            //Ok

            /** pricing and values */
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->decimal('rent_price', 10, 2)->nullable();
            $table->decimal('tribute', 10, 2)->nullable();
            $table->decimal('condominium', 10, 2)->nullable();

            /** description */
            $table->text('description')->nullable();
            $table->integer('bedrooms')->default('0');
            $table->integer('suites')->default('0');
            $table->integer('bathrooms')->default('0');
            $table->integer('rooms')->default('0');
            $table->integer('garage')->default('0');
            $table->integer('garage_covered')->default('0');
            $table->integer('area_total')->default('0');
            $table->integer('area_util')->default('0');

            /** address */
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            $table->string('status')->nullable();

            $table->string('video')->nullable();

            $table->bigInteger('views')->default(0);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->string('owner')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("
        CREATE OR REPLACE VIEW `properties_view` AS
        SELECT p.id, p.title, p.cover, p.type, p.category_id, c.name as category, p.experience_id, e.name as experience, p.owner, p.views
        FROM properties as p
        LEFT JOIN categories as c ON c.id=p.category_id
        LEFT JOIN experiences as e ON e.id=p.experience_id       
        WHERE p.deleted_at IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
        DB::statement("DROP VIEW properties_view");
    }
};
