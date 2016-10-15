<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;$i++) {
            DB::table('organizations')->insert([
                'username' => "organizacija".$i,
                'password' => "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8",
                'email' => 'organization@mail.com',
                'name' => str_random(10),
                'type' => 'reception center',
                'country' => 'Serbia',
                'city' => 'address',
                'lat' => "43.3161809",
                'lon' => "21.8933594",
                'description' => "Lorem ipsum dolor sit amet, nihil nullam adipiscing id eos, ad mel salutatus iracundia, soluta lobortis et duo. Sea et vide epicurei euripidis, sumo dicta omnesque vis et. Et dicant dolorem usu. Ex nec scaevola eleifend vituperata, in his modo debet conclusionemque. Idque nusquam sea id, mea ne vero molestiae ullamcorper.",
                'capacity' => 100,
                'reserved' => 50
            ]);
        }
        for($i=20;$i<40;$i++) {
            DB::table('organizations')->insert([
                'username' => "organizacija".$i,
                'password' => "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8",
                'email' => 'organization@mail.com',
                'name' => str_random(10),
                'type' => 'private accommodation',
                'country' => 'Serbia',
                'city' => 'address',
                'lat' => "43.3161809",
                'lon' => "21.8933594",
                'description' => "Lorem ipsum dolor sit amet, nihil nullam adipiscing id eos, ad mel salutatus iracundia, soluta lobortis et duo. Sea et vide epicurei euripidis, sumo dicta omnesque vis et. Et dicant dolorem usu. Ex nec scaevola eleifend vituperata, in his modo debet conclusionemque. Idque nusquam sea id, mea ne vero molestiae ullamcorper.",
                'capacity' => 100,
                'reserved' => 50
            ]);
        }
        for($i=40;$i<60;$i++) {
            DB::table('organizations')->insert([
                'username' => "organizacija".$i,
                'password' => "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8",
                'email' => 'organization@mail.com',
                'name' => str_random(10),
                'type' => 'kitchen',
                'country' => 'Serbia',
                'city' => 'address',
                'lat' => "43.3161809",
                'lon' => "21.8933594",
                'description' => "Lorem ipsum dolor sit amet, nihil nullam adipiscing id eos, ad mel salutatus iracundia, soluta lobortis et duo. Sea et vide epicurei euripidis, sumo dicta omnesque vis et. Et dicant dolorem usu. Ex nec scaevola eleifend vituperata, in his modo debet conclusionemque. Idque nusquam sea id, mea ne vero molestiae ullamcorper.",
                'capacity' => 100,
                'reserved' => 50
            ]);
        }
    }
}
