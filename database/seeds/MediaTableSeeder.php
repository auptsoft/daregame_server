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
        $sportMedia = new Media;
        $sportMedia->name = "Sport";
        $sportMedia->file_name = "sport.png";
        $sportMedia->owner_type = "category";
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
        $romanceMedia->url = "/media/cateogry/image/romance.png";
        $romanceMedia->type = "image";
        $romanceMedia->description = "Sport Image";
        $romanceMedia->save();

        $adventureMedia = new Media;
        $adventureMedia->name = "Adventure";
        $adventureMedia = new Media;
        $adventureMedia->file_name = "adventure.png";
        $adventureMedia->owner_type = "category";
        $adventureMedia->owner_id = 1;
        $adventureMedia->url = "/media/cateogry/image/adventure.png";
        $adventureMedia->type = "image";
        $adventureMedia->description = "Adventure Image";
        $adventureMedia->save();

        $technologyMedia = new Media;
        $technologyMedia->name = "Technology";
        $technologyMedia->file_name = "technology.png";
        $technologyMedia->owner_type = "category";
        $technologyMedia->owner_id = 1;
        $technologyMedia->url = "/media/cateogry/image/technology.png";
        $technologyMedia->type = "image";
        $technologyMedia->description = "Technology Image";
        $technologyMedia->save();

        $academicMedia = new Media;
        $academicMedia->name = "Academic";
        $academicMedia->file_name = "academic.png";
        $academicMedia->owner_type = "category";
        $academicMedia->owner_id = 1;
        $academicMedia->url = "/media/cateogry/image/academic.png";
        $academicMedia->type = "image";
        $academicMedia->description = "Academic Image";
        $academicMedia->save();
    }
}
