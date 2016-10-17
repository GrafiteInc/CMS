<?php

namespace Yab\Quarx\Repositories;

use Quarx;
use Config;
use CryptoService;
use Yab\Quarx\Models\Image;
use Yab\Quarx\Services\FileService;
use Illuminate\Support\Facades\Schema;

class ImageRepository
{
    /**
     * Returns all Images.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Image::orderBy('created_at', 'desc')->all();
    }

    public function paginated()
    {
        return Image::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    public function publishedAndPaginated()
    {
        return Image::orderBy('created_at', 'desc')->where('is_published', 1)->paginate(Config::get('quarx.pagination', 25));
    }

    public function published()
    {
        return Image::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    /**
     * Returns all Images for the API.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function apiPrepared()
    {
        return Image::orderBy('created_at', 'desc')->where('is_published', 1)->get();
    }

    /**
     * Returns all Images for the API.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getImagesByTag($tag = null)
    {
        $images = Image::orderBy('created_at', 'desc')->where('is_published', 1);

        if (!is_null($tag)) {
            $images->where('tags', 'LIKE', '%'.$tag.'%');
        }

        return $images;
    }

    /**
     * Returns all Images tags.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allTags()
    {
        $tags = [];
        $images = Image::orderBy('created_at', 'desc')->where('is_published', 1)->get();

        foreach ($images as $image) {
            foreach (explode(',', $image->tags) as $tag) {
                if ($tag > '') {
                    array_push($tags, $tag);
                }
            }
        }

        return array_unique($tags);
    }

    /**
     * Search the images.
     *
     * @param string $input
     *
     * @return Collection
     */
    public function search($input)
    {
        $query = Image::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('images');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];
    }

    /**
     * Stores Images into database.
     *
     * @param array $input
     *
     * @return Images
     */
    public function apiStore($input)
    {
        $savedFile = FileService::saveClone($input['location'], 'images/');

        if (!$savedFile) {
            return false;
        }

        $input['is_published'] = 1;
        $input['location'] = $savedFile['name'];
        $input['original_name'] = $savedFile['original'];

        return Image::create($input);
    }

    /**
     * Stores Images into database.
     *
     * @param array $input
     *
     * @return Images
     */
    public function store($input)
    {
        $savedFile = $input['location'];

        if (!$savedFile) {
            Quarx::notification('Image could not be saved.', 'danger');

            return false;
        }

        if (!isset($input['is_published'])) {
            $input['is_published'] = 0;
        } else {
            $input['is_published'] = 1;
        }

        $input['location'] = CryptoService::decrypt($savedFile['name']);
        $input['original_name'] = $savedFile['original'];

        return Image::create($input);
    }

    /**
     * Find Images by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Images
     */
    public function findImagesById($id)
    {
        return Image::find($id);
    }

    /**
     * Updates Images into database.
     *
     * @param Images $images
     * @param array  $input
     *
     * @return Images
     */
    public function update($images, $input)
    {
        if (isset($input['location']) && !empty($input['location'])) {
            $savedFile = FileService::saveFile($input['location'], 'images/');

            if (!$savedFile) {
                Quarx::notification('Image could not be updated.', 'danger');

                return false;
            }

            $input['location'] = $savedFile['name'];
            $input['original_name'] = $savedFile['original'];
        } else {
            $input['location'] = $images->location;
        }

        if (!isset($input['is_published'])) {
            $input['is_published'] = 0;
        } else {
            $input['is_published'] = 1;
        }

        return $images->update($input);
    }
}
