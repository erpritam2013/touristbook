<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class UtilityController extends Controller
{
    public function get_template_by_type($type) {
        // Source is Config File
        $subforms = config('subform');
        if(!isset($subforms[$type])) {
            // Type Not Found
            return response()->json(['html' => '']);
        }

        $type_data = $subforms[$type] ?? [];
        $html = View::make('admin.partials.utils.subform', [
            'typeData' => $type_data,
            'type' => $type
        ])->render();
        return response()->json(['html' => $html]);

    }
}
