<?php

namespace Mlantz\Quarx\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $table = "file_categories";

    public $primaryKey = "id";

    public $fillable = [
        "name"
    ];

    public static $rules = [
        'name' => 'required'
    ];

    public static function getAll()
    {
        $query = Categories::where('user', '=', Auth::id())->orderBy('id', 'desc')->paginate(15);
        return [$query, $query->render()];
    }

    public static function collectionNameByID($id)
    {
        $collection = Categories::where('user', '=', Auth::id())->find($id);

        if ( ! $collection) {
            return 'N/A';
        }

        return $collection->name;
    }

    public static function saveCategory($inputs)
    {
        $category = new Categories;
        $category->name = $inputs['name'];
        $category->user = Auth::id();
        return $category->save();
    }

    public static function updateCategory($inputs)
    {
        $category = Categories::find($inputs['id']);
        $category->name = $inputs['name'];
        return $category->save();
    }

    public static function destroyCategory($id)
    {
        $category = Categories::find($id);
        return $category->delete();
    }

    public function files()
    {
        return $this->hasMany(\Mlantz\Quarx\Models\Files::class);
    }

}
