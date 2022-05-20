<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class MonthlySales extends AbstractWidget
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
        $last_month_start = date("Y-m-d", strtotime("first day of previous month"));
        $last_month_end = date("Y-m-d", strtotime("last day of previous month"));

        $previous_month = date('Y-m', strtotime('-2 month'));
        $previous_month_start = date("Y-m-01", strtotime($previous_month));
        $previous_month_end = date("Y-m-t", strtotime($previous_month));

        $lastmonth = array_filter($fulldata, function ($var) use($last_month_start,$last_month_end){
            return ($var['StartDate'] >= $last_month_start && $var['EndDate'] <= $last_month_end);
            });
        $previoumonth = array_filter($fulldata, function ($var) use($previous_month_start,$previous_month_end){
            return ($var['StartDate'] >= $previous_month_start && $var['EndDate'] <= $previous_month_end);
            });

        $data['lastmonthtotaldollars'] = array_sum(Arr::pluck($lastmonth,'TotalDollars'));        
        $previoumonthtotaldollars = array_sum(Arr::pluck($previoumonth,'TotalDollars'));
    
        $difference = $data['lastmonthtotaldollars']-$previoumonthtotaldollars;
        $data['precentage'] = 0;
        if($data['lastmonthtotaldollars'] > 0)
        $data['precentage'] = ($difference/$data['lastmonthtotaldollars'])*100;

        return view('widgets.monthly_sales', [
            'config' => $this->config,
            'data' => $data
        ]);
    }
}
