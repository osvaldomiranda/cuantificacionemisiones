            $table->string('ccf8');
            $table->string('polulant_id')->nullable();
            $table->string('polulant')->nullable();
            $table->float('factor',16,8)->nullable();
            $table->string('unity')->nullable();
            $table->string('measure_unit')->nullable();
            $table->integer('measure_value')->nullable();

App\Factor::create(["ccf8"=>"  ",  "polulant"=>" ", "factor"=> ,  "unity"=> " ",  "measure_unit"=> " ", "measure_value"=> ]);