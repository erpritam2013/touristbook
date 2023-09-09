<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Builder;
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
        Validator::extend('unique_custom', function ($attribute, $value, $parameters)
        {
    // Get the parameters passed to the rule
           if (count($parameters) == 4) {
            list($table, $field, $field2, $field2Value) = $parameters;
            return DB::table($table)->where($field, $value)->where($field2, $field2Value)->count() == 0;
        }
        if (count($parameters) == 6) {
            list($table, $field, $field2, $field2Value, $field3, $field3Value) = $parameters;
            return DB::table($table)->where($field, $value)->where($field2, $field2Value)->where($field3,'!=', $field3Value)->count() == 0;
        }

    // Check the table and return true only if there are no entries matching
    // both the first field name and the user input value as well as
    // the second field name and the second field value
        Builder::useVite();
        
    });

        Validator::replacer('unique_custom', function($message, $attribute, $rule, $parameters){

         if ($rule == 'unique_custom' && $message == 'validation.unique_custom') {
             $message = 'The '.$attribute.' has already been taken.';
         }
         return $message;
     });  
    }
}
