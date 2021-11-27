<?php


namespace App\Helpers\Blade;


use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserHelper
 *
 * @package App\Helpers\Blade
 */
class CategoryHelper
{
    /**
     * @var User
     */
    private $categories;

    /**
     * Get all categories in constructor
     *
     * UserHelper constructor.
     */
    public function __construct()
    {
        $this->categories = Category::all();
    }

    /**
     * @return Collection|array|User
     */
    public function getCategories(): Collection|array|User
    {
        return $this->categories;
    }

}
