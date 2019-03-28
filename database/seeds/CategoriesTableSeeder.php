<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1 = new Category;
        $cat1->title = "Sport";
        $cat1->description = "This is the description of sport";
        $cat1->save();

        $cat2 = new Category;
        $cat2->title = "Romance";
        $cat2->description = "This is the description of romance";
        $cat2->save();

        $cat3 = new Category;
        $cat3->title = "Food";
        $cat3->description = "This is the description of Food";
        $cat3->save();

        $cat4 = new Category;
        $cat4->title = "Technology";
        $cat4->description = "This is the description of Technology";
        $cat4->save();

        $cat5 = new Category;
        $cat5->title = "Academic";
        $cat5->description = "This is the description of Technology";
        $cat5->save();

        $cat6 = new Category;
        $cat6->title = "Games";
        $cat6->description = "This is the description of Games";
        $cat6->save();
    }
}
