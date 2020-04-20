<?php

use App\Models\Client;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterToClientTypeClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('document_number')->unique()->change();
            $table->date('date_birth')->nullable()->change();
            DB::statement('ALTER TABLE clients CHANGE sex sex CHAR NULL');
            DB::statement('ALTER TABLE clients CHANGE marital_status marital_status ENUM(' . $this->maritalStatusString() . ') NULL');
            $table->string('company_name')->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropUnique('clients_document_number_unique');
            $table->date('date_birth')->change();
            DB::statement('ALTER TABLE clients CHANGE sex sex CHAR NOT NULL');
            DB::statement('ALTER TABLE clients CHANGE marital_status marital_status ENUM(' . $this->maritalStatusString() . ') NOT NULL');
            $table->dropColumn('company_name');
        });
    }

    protected function maritalStatusString(){
        return implode(',', array_map(function ($value) {
            $i = array_search($value, Client::MARITAL_STATUS);
            return "'$i'";
        }, Client::MARITAL_STATUS));
    }
}
