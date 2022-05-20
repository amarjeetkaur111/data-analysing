<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class Top5Fields extends AbstractWidget
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
        $finalarray  = array();
        $start_date = date("Y-m-d", strtotime( date( 'Y-m-01' )." -12 months"));
        $last_date = date('Y-m-d');

        $last12monthdata = array_filter($fulldata, function ($var) use($start_date,$last_date){
            return ($var['StartDate'] >= $start_date && $var['EndDate'] <= $last_date);
            });
     
        if($last12monthdata){
            $last12monthdata = array_reduce($last12monthdata, function ($a, $b) {
                isset($a[$b['Description']]) ? $a[$b['Description']]['TotalDollars'] += $b['TotalDollars'] : $a[$b['Description']] = $b;  
                return $a;
            });
            $mergelist = array_column($last12monthdata,'TotalDollars','Description');
            arsort($mergelist);
            $finalarray = array_slice($mergelist, 0 ,5);
        }
        return view('widgets.top5_fields', [
            'config' => $this->config,
            'topfields' => $finalarray,
        ]);
    }
}
