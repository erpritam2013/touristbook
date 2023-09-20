<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class BreadcrumbComposer
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Initialize a new composer instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $view->with('breadcrumbs', $this->parseSegments());
        $view->with('post_types', config('global.post_types'));
        $view->with('lebal_types', config('global.lebal_types'));
        $view->with('stays', config('global.stay'));
        $view->with('important_note', config('global.important_note'));
        $view->with('booking_options', get_array_mapping(config('global.booking_options'),true));
        $view->with('type_activity', get_array_mapping(config('global.show_agent_contact_info'),true));
        $view->with('show_agent_contact_info', get_array_mapping(config('global.type_activity'),true));
        $view->with('activity_program_style', get_array_mapping(config('global.activity_program_style'),true));
        $view->with('helpful_facts', config('global.helpful_facts'));
        $view->with('term_activity_list_parent', config('global.term_activity_list_parent'));
        
    }

    /**
     * Parse the request route segments.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function parseSegments()
    {
        return collect($this->request->segments())->mapWithKeys(function ($segment, $key) {
            return [
                $segment => implode('/', array_slice($this->request->segments(), 0, $key + 1))
            ];
        });
    }
}