<?php
    
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    class CreateUsersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                
                // ** Columnas de la tabla users **
                $table->increments('id', 11);
                $table->string('name');
                $table->string('email', 48)->unique();
                $table->string('password', 255);
                $table->string('kind', 24)->default('operator');
                $table->rememberToken();
                
                $table->timestamps();
                // $table->timestamp('created_at');
                // $table->timestamp('updated_at')->nullable();
                
            });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('users');
        }
    }
