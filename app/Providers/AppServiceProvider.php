<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        if (isset(request()->state_id) && empty(request()->state_id[0])) {
            request()->merge([
                'state_id' => [],
            ]);
        }

        // Set Default Currency
        $defaultCurrency = Session::get('currency');

        // Check if currency is not set in session
        if (!$defaultCurrency) {
            // Set your default currency here (INR in this case)
            Session::put('currency', 'INR');

            Session::put('currency_symbol', '₹');
        }

        // Note: It is adding gallery key to every request
        if (isset(request()->gallery) && (request()->gallery == '' || empty(request()->gallery) || request()->gallery == '"[]"' || request()->gallery == '""')) {
            request()->merge([
                'gallery' => "[]",
            ]);
        }
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
      
        Collection::macro('toPackageTypeNested', function () {
            $parentKey = "parent_id";
            $grouped = $this->groupBy($parentKey);


            $nestedCollection = function ($parentId) use ($grouped, &$nestedCollection) {
                $groupedArr = $grouped->get($parentId, []);
                return collect($groupedArr)->map(function ($resource) use ($nestedCollection) {
                    return [
                        'id' => $resource['id'],
                        'name' => $resource['name'],
                        'button' => $resource['button'],
                        'extra_data' => $resource['extra_data'],
                        'children' => $nestedCollection($resource['id']),
                    ];
                });
            };

            $nestedResult = $nestedCollection(0);
            return $nestedResult;
        });
        Validator::extend('unique_custom', function ($attribute, $value, $parameters) {
            // Get the parameters passed to the rule
            if (count($parameters) == 4) {
                list($table, $field, $field2, $field2Value) = $parameters;
                if ($field2 == 'id') {
                    return DB::table($table)->where($field, $value)->where($field2, '!=', $field2Value)->count() == 0;
                } else {
                    return DB::table($table)->where($field, $value)->where($field2, $field2Value)->count() == 0;
                }
            }
            if (count($parameters) == 6) {
                list($table, $field, $field2, $field2Value, $field3, $field3Value) = $parameters;
                return DB::table($table)->where($field, $value)->where($field2, $field2Value)->where($field3, '!=', $field3Value)->count() == 0;
            }

            // Check the table and return true only if there are no entries matching
            // both the first field name and the user input value as well as
            // the second field name and the second field value
            Builder::useVite();
        });

        Validator::replacer('unique_custom', function ($message, $attribute, $rule, $parameters) {

            if ($rule == 'unique_custom' && $message == 'validation.unique_custom') {
                $message = 'The ' . $attribute . ' has already been taken.';
            }
            return $message;
        });
    }
}
