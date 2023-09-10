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

        $typeInfo = $subforms[$type] ?? [];
        $data = $this->generate_single_data($type);
        $html = View::make('admin.partials.utils.subform', [
            'typeData' => $data,
            'type' => $type,
            'typeFields' => $typeInfo['fields'],
            'key' => 0
        ])->render();
        return response()->json(['html' => $html]);

    }


    private function generate_single_data($type) {
        $subforms = config('subform');
        $data = [
                'subform_id' => $type
        ];
        if(isset($subforms[$type])) {
            foreach($subforms[$type]['fields'] as $key => $field) {
                $data[$key] = "";
            }
        }
        return $data;
    }

    public function get_template_by_type_old($type) {
        // Source is Config File
        $subforms = config('subform');
        if(!isset($subforms[$type])) {
            // Type Not Found
            return response()->json(['html' => '']);
        }

        $type_data = $subforms[$type] ?? [];

        $html = View::make('admin.partials.utils.subform', [
            'typeData' => $type_data['data'],
            'type' => $type,
            'typeLabels' => $type_data['labels']
        ])->render();
        return response()->json(['html' => $html]);

    }
}
