<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class Bottom5FieldsChart extends AbstractWidget
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
        $finalarray = array();
        $last_week = strtotime("-1 week +1 day");
        $last_week_start = strtotime("last sunday midnight",$last_week);
        $last_week_end = strtotime("next saturday",$last_week_start);
        $last_week_start = date("Y-m-d",$last_week_start);
        $last_week_end = date("Y-m-d",$last_week_end);


        $lastweekdata = array_filter($fulldata, function ($var) use($last_week_start,$last_week_end){
            return ($var['StartDate'] >= $last_week_start && $var['EndDate'] <= $last_week_end);
            });
            
        if($lastweekdata){
            $lastweekdata = array_reduce($lastweekdata, function ($a, $b) {
                isset($a[$b['Description']]) ? $a[$b['Description']]['TotalDollars'] += $b['TotalDollars'] : $a[$b['Description']] = $b;  
                return $a;
            });
            $mergelist = array_column($lastweekdata,'TotalDollars','Description');
            asort($mergelist);
            $finalarray = array_slice($mergelist, 0 ,5);
        }
        return view('widgets.bottom5_fields_chart', [
            'config' => $this->config,
            'topfields' => $finalarray,

        ]);
    }
}
