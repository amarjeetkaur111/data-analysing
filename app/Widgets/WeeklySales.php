<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class WeeklySales extends AbstractWidget
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
     */
    public function run(BaseController $baseclass)
    {
        $fulldata = $baseclass->details();
        $last_week = strtotime("-1 week +1 day");
        $last_week_start = strtotime("last sunday midnight",$last_week);
        $last_week_end = strtotime("next saturday",$last_week_start);
        $last_week_start = date("Y-m-d",$last_week_start);
        $last_week_end = date("Y-m-d",$last_week_end);

        $previous_week = strtotime("-2 week +1 day");
        $previous_week_start = strtotime("last sunday midnight",$previous_week);
        $previous_week_end = strtotime("next saturday",$previous_week_start);
        $previous_week_start = date("Y-m-d",$previous_week_start);
        $previous_week_end = date("Y-m-d",$previous_week_end);

        $lastweek = array_filter($fulldata, function ($var) use($last_week_start,$last_week_end){
            return ($var['StartDate'] >= $last_week_start && $var['EndDate'] <= $last_week_end);
            });
        $previousweek = array_filter($fulldata, function ($var) use($previous_week_start,$previous_week_end){
            return ($var['StartDate'] >= $previous_week_start && $var['EndDate'] <= $previous_week_end);
            });

        $data['lastweektotaldollars'] = array_sum(Arr::pluck($lastweek,'TotalDollars'));        
        $previousweektotaldollars = array_sum(Arr::pluck($previousweek,'TotalDollars'));
    
        $difference = $data['lastweektotaldollars']-$previousweektotaldollars;
        $data['precentage'] = 0;
        if($data['lastweektotaldollars'] > 0)
        $data['precentage'] = ($difference/$data['lastweektotaldollars'])*100;

        return view('widgets.weekly_sales', [
            'config' => $this->config,
            'data' => $data
        ]);
    }
}
