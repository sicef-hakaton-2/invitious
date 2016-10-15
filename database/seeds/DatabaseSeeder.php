<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('UsersTableSeeder');
        $this->call('LocationsTableSeeder');
        $this->call('OrganizationsTableSeeder');
        $this->call('MiNewsTableSeeder');
        $this->call('MissingPersonsTableSeeder');
        $this->call('HostedTableSeeder');
        // $this->call(UserTableSeeder::class);

      /*  Model::reguard();*/
    }
}
