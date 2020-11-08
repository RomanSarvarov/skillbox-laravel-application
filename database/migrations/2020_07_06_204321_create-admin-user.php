<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUser extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 * @throws Throwable
	 */
    public function up()
    {
    	throw_if(
    		User::where('email', 'best.admin@gmail.com')->exists(),
		    LogicException::class,
		    'Админ уже существует!'
	    );

        factory( User::class)
            ->state('admin')
            ->create(['email' => 'best.admin@gmail.com']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where('email', 'best.admin@gmail.com')->delete();
    }
}
