<?php

namespace Mlantz\Quarx\Repositories;

use Config;
use Mlantz\Quarx\Models\Images;
use Mlantz\Quarx\Services\FileService;
use Illuminate\Support\Facades\Schema;

class ImagesRepository
{

    /**
     * Returns all Images
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Images::orderBy('created_at', 'desc')->all();
    }

    /**
     * Returns all Images for the API
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function apiPrepared()
    {
        $images = Images::orderBy('created_at', 'desc')->get();

        foreach ($images as $image) {
            $image->location = FileService::fileAsPublicAsset($image->location);
        }

        return $images;
    }

    public function search($input)
    {
        $query = Images::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));

        $columns = Schema::getColumnListing('images');
        $attributes = array();

        foreach($columns as $attribute){
            if(isset($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] =  $input[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        return [$query, $attributes, $query->render()];

    }

    /**
     * Stores Images into database
     *
     * @param array $input
     *
     * @return Images
     */
    public function store($input)
    {
        $savedFile = FileService::saveFile($input['location'], 'images/');

        if (! $savedFile) {
            Quarx::notification('Image could not be saved.', 'danger');
            return false;
        }

        if (! isset($input['is_published'])) {
            $input['is_published'] = 0;
        } else {
            $input['is_published'] = 1;
        }

        $input['location'] = $savedFile['name'];
        $input['original_name'] = $savedFile['original'];

        return Images::create($input);
    }

    /**
     * Find Images by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Images
     */
    public function findImagesById($id)
    {
        return Images::find($id);
    }

    /**
     * Updates Images into database
     *
     * @param Images $images
     * @param array $input
     *
     * @return Images
     */
    public function update($images, $input)
    {
        if (isset($input['location'])) {
            $savedFile = FileUtilities::saveFile($input['location'], 'images/');

            if (! $savedFile) {
                Quarx::notification('Image could not be updated.', 'danger');
                return false;
            }

            $input['location'] = $savedFile['name'];
            $input['original_name'] = $savedFile['original'];
        } else {
            $input['location'] = $images->location;
        }

        if (! isset($input['is_published'])) {
            $input['is_published'] = 0;
        } else {
            $input['is_published'] = 1;
        }

        $images->fill($input);
        $images->save();

        return $images;
    }
}