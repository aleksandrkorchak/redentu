<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property int $id
 * @property string $rubric1
 * @property string $rubric2
 * @property int $category
 * @property string $manufacturer
 * @property string $name
 * @property string $code
 * @property string $description
 * @property float $price
 * @property int $guarantee
 * @property int $availability
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereGuarantee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereRubric1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereRubric2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'rubric1',
        'rubric2',
        'category',
        'manufacturer',
        'name',
        'code',
        'description',
        'price',
        'guarantee',
        'availability'
    ];
}
