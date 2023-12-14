<?php

namespace App\Shortcodes;

use tehwave\Shortcodes\Shortcode;

class origincode_videogallery extends Shortcode
{
    /**
     * The code to run when the Shortcode is being compiled.
     *
     * You may return a string from here, that will then
     * be inserted into the content being compiled.
     *
     * @return string|null
     */

    protected $tag = 'origincode_videogallery';
    public function handle(): ?string
    {
        
        if (isset($this->attributes['id']) && !empty($this->attributes['id'])) {
            return  $this->attributes['id'];
        }
        return sprintf('<i>%s</i>', htmlspecialchars($this->body));
    }
}
