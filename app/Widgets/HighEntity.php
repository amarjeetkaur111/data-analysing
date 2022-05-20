<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class HighEntity extends AbstractWidget
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
        $sunday = strtotime("last sunday");
        $sunday = date('w', $sunday)==date('w') ? $sunday+7*86400 : $sunday;
        $saturday = strtotime(date("Y-m-d",$sunday)." +6 days");
        $this_week_sd = date("Y-m-d",$sunday);
        $this_week_ed = date("Y-m-d",$saturday);
        $maxkey ='';
        $maxvalue ='';

        $weekdata = array_filter($fulldata, function ($var) use($this_week_sd,$this_week_ed){
            return ($var['StartDate'] >= $this_week_sd && $var['EndDate'] <= $this_week_ed);
            });
            
        if($weekdata){
            $weekdata = array_reduce($weekdata, function ($a, $b) {
                isset($a[$b['Description']]) ? $a[$b['Description']]['TotalDollars'] += $b['TotalDollars'] : $a[$b['Description']] = $b;  
                return $a;
            });
            $mergelist = array_column($weekdata,'TotalDollars','Description');
            $maxvalue = max($mergelist);
            $maxkey = array_search($maxvalue,$mergelist);
        }

        return view('widgets.high_entity', [
            'config' => $this->config,
            'field' => $maxkey,
            'value' => $maxvalue,
        ]);
    }
}
