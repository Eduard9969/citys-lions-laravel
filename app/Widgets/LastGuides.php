<?php

namespace App\Widgets;

use App\Http\Models\Guide;
use Arrilot\Widgets\AbstractWidget;

class LastGuides extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * @param Guide $guide
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(Guide $guide)
    {
        $guides = $guide->with('user')->limit(5)->get();

        return view('widgets.last_guides', [
            'config' => $this->config,
            'guides' => $guides
        ]);
    }
}
