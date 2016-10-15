<?php
use App\User;
use App\LocationModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<100;$i++) {
            $User = User::find($i+1)->first();
            $Location = new LocationModel;

            $Location->user_id= $User->id;
            $Location->lat = "43.3161809".$i;
            $Location->lon =  "21.8933594".$i;
            $Location->save();
        }
    }
}
