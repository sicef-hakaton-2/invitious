<?php
use App\MissingPersonModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MissingPersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){
            $MissingPerson = new MissingPersonModel;
            $MissingPerson->name = "hakaton".$i;
            $MissingPerson->surname = "hakaton".$i;
            $MissingPerson->birthdate = new DateTime();
            $MissingPerson->country = "Serbia";
            $MissingPerson->city = "Nis";
            $MissingPerson->address = "Bulevar Nemanjica";
            $MissingPerson->sex = "male";
            $MissingPerson->img_url = "avatar.jpg";

            $MissingPerson->save();
        }
    }
}
