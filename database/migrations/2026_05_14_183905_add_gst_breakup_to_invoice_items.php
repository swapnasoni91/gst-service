<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {

            $table->decimal('cgst_percent', 5, 2)
                  ->default(0);

            $table->decimal('sgst_percent', 5, 2)
                  ->default(0);

            $table->decimal('igst_percent', 5, 2)
                  ->default(0);

            $table->decimal('cgst_amount', 10, 2)
                  ->default(0);

            $table->decimal('sgst_amount', 10, 2)
                  ->default(0);

            $table->decimal('igst_amount', 10, 2)
                  ->default(0);

        });
    }

    public function down(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {

            $table->dropColumn([

                'cgst_percent',
                'sgst_percent',
                'igst_percent',
                'cgst_amount',
                'sgst_amount',
                'igst_amount'

            ]);

        });
    }
};