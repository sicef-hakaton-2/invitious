<?php
use App\User;
use App\OrganizationModel;
use App\HostedModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HostedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for($i=0;$i<20;$i++){
           $User = User::find($i+1)->first();
           $Organization = OrganizationModel::find($i+1)->first();

           $Hosted = new HostedModel;

           $Hosted->user_id = $User->id;
           $Hosted->organization_id = $Organization->id;

           $Hosted->save();
       }
    }
}
