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
        Schema::table('pricing_features', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('feature');
        });

        $featuresByPackage = DB::table('pricing_features')
            ->select('id', 'package_id')
            ->orderBy('package_id')
            ->orderBy('id')
            ->get()
            ->groupBy('package_id');

        foreach ($featuresByPackage as $features) {
            foreach ($features->values() as $index => $feature) {
                DB::table('pricing_features')
                    ->where('id', $feature->id)
                    ->update([
                        'sort_order' => $index + 1,
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pricing_features', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
