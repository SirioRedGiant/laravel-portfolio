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
        Schema::table('projects', function (Blueprint $table) {

            $table->foreignId('type_id')
                ->nullable()
                ->after('id') // after('id') --> per metterla dopo la colonna ID
                ->constrained() // Attiva il vincolo di relazione (Laravel capisce che punta alla tabella 'types')
                ->onDelete('set null'); // se si elimina una tipologia, i progetti ad essa collegati non si cancellano, ma il loro type_id diventa NULL.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            // per fare il  rollback bisogna prima distruggere il vincolo e poi cancellare la colonna
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });
    }
};
