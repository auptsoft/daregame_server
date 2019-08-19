<?php

use Illuminate\Database\Seeder;

use App\Media;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $table->increments('id');
        // $table->string('name')->default('');
        // $table->string('url');
        // $table->string('type');
        // $table->string('description')->default('');
        // $table->integer('owner_id');			
        // $table->string('owner_type');
        // $table->string('media_source');
        // $table->string('file_name');
        // $table->string('extra')->default(''); //when used with 'challenge' as owner_type it must be either; 'chanllenger' or 'challenged'
        // $table->timestamps();
        // $table->softDeletes();

        $sportMedia = new Media;
        $sportMedia->name = "Sport";
        $sportMedia->file_name = "sport.png";
        $sportMedia->owner_type = "category";
        $sportMedia->media_source = "";
        $sportMedia->owner_id = 1;
        $sportMedia->url = "/media/cateogry/image/sport.png";
        $sportMedia->type = "image";
        $sportMedia->description = "Sport Image";
        $sportMedia->save();

        $romanceMedia = new Media;
        $romanceMedia->name = "Romance";
        $romanceMedia->file_name = "romance.png";
        $romanceMedia->owner_type = "category";
        $romanceMedia->owner_id = 1;
        $romanceMedia->media_source = "";
        $romanceMedia->url = "/media/cateogry/image/romance.png";
        $romanceMedia->type = "image";
        $romanceMedia->description = "Sport Image";
        $romanceMedia->save();

        $foodMedia = new Media;
        $foodMedia->name = "Food";
        $foodMedia = new Media;
        $foodMedia->file_name = "food.png";
        $foodMedia->owner_type = "category";
        $foodMedia->media_source = "";
        $foodMedia->owner_id = 1;
        $foodMedia->url = "/media/cateogry/image/food.png";
        $foodMedia->type = "image";
        $foodMedia->description = "Food Image";
        $foodMedia->save();

        $gameMedia = new Media;
        $gameMedia->name = "Game";
        $gameMedia = new Media;
        $gameMedia->file_name = "game.png";
        $gameMedia->owner_type = "category";
        $gameMedia->media_source = "";
        $gameMedia->owner_id = 1;
        $gameMedia->url = "/media/cateogry/image/game.png";
        $gameMedia->type = "image";
        $gameMedia->description = "Game Image";
        $gameMedia->save();

        $technologyMedia = new Media;
        $technologyMedia->name = "Technology";
        $technologyMedia->file_name = "technology.png";
        $technologyMedia->owner_type = "category";
        $technologyMedia->owner_id = 1;
        $technologyMedia->media_source = "";
        $technologyMedia->url = "/media/cateogry/image/technology.png";
        $technologyMedia->type = "image";
        $technologyMedia->description = "Technology Image";
        $technologyMedia->save();

        $academicMedia = new Media;
        $academicMedia->name = "Academic";
        $academicMedia->file_name = "academic.png";
        $academicMedia->owner_type = "category";
        $academicMedia->owner_id = 1;
        $academicMedia->media_source = "";
        $academicMedia->url = "/media/cateogry/image/academic.png";
        $academicMedia->type = "image";
        $academicMedia->description = "Academic Image";
        $academicMedia->save();
    }
}
