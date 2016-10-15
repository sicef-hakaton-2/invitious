<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<100;$i++){
            $User = new User;
            $User->name = "hakaton".$i;
            $User->username = 'korisnik'.$i;
            $User->surname = "hakaton".$i;
            $User->birthdate = new DateTime();
            $User->country = "Serbia";
            $User->city = "Nis";
            $User->address = "Bulevar Nemanjica";
            $User->password = "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8";
            $User->profession = "driver";
            $User->illness = "";
            $User->sex = "male";
            $User->img_url = "avatar.jpg";

            $User->save();
        }

    }
}
