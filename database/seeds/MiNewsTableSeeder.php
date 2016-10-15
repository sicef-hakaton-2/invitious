<?php
use App\NewsModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MiNewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $News = new NewsModel;
            $News->subject = "News" . $i;
            $News->text = "Lorem ipsum dolor sit amet, nihil nullam adipiscing id eos, ad mel salutatus iracundia, soluta lobortis et duo. Sea et vide epicurei euripidis, sumo dicta omnesque vis et. Et dicant dolorem usu. Ex nec scaevola eleifend vituperata, in his modo debet conclusionemque. Idque nusquam sea id, mea ne vero molestiae ullamcorper.";
            $News->img_url = 'news.jpg';
            $News->save();
        }
    }
}
