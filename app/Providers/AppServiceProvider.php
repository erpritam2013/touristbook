<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO : Need Improvement by putting it to separate file. Or May be used it for Custom Collection for Models
        Collection::macro('toNested', function () {
            $parentKey = "parent_id";
            $grouped = $this->groupBy($parentKey);


            $nestedCollection = function ($parentId) use ($grouped, &$nestedCollection) {
                $groupedArr = $grouped->get($parentId, []);
                return collect($groupedArr)->map(function ($resource) use ($nestedCollection) {
                    return [
                        'id' => $resource['id'],
                        'name' => $resource['name'],
                        'children' => $nestedCollection($resource['id']),
                    ];
                });
            };

            $nestedResult = $nestedCollection(0);
            return $nestedResult;
        });
    }
}
