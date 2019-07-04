<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Role;
        $user->nama = 'Administrator';
        $user->save();

        $user = new \App\Role;
        $user->nama = 'Waiter';
        $user->save();

        $user = new \App\Role;
        $user->nama = 'Cashier';
        $user->save();

        $user = new \App\Role;
        $user->nama = 'Owner';
        $user->save();

        $user = new \App\Role;
        $user->nama = 'Customer';
        $user->save();
        
        $user = new \App\User;
        $user->name = 'Administrasi';
        $user->username = 'admin';
        $user->email = 'admin@restoran.info';
        $user->password = bcrypt('admin123');
        $user->id_role = 1;
        $user->active = 1;
        $user->save();
        
        $user = new \App\User;
        $user->name = 'Pemilik';
        $user->username = 'owner';
        $user->email = 'owner@restoran.info';
        $user->password = bcrypt('owner123');
        $user->id_role = 4;
        $user->active = 1;
        $user->save();
        
    }
}
