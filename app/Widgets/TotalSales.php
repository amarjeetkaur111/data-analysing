<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class TotalSales extends AbstractWidget
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
        $cyear = date('Y');
        $pyear = date('Y')-1;
        $currentyear = array_filter($fulldata, function ($var) use($cyear){
            return ($var['StartDate'] >= $cyear.'-01-01' && $var['EndDate'] <= $cyear.'-12-31');
            });
        $previousyear = array_filter($fulldata, function ($var) use($pyear){
            return ($var['StartDate'] >= $pyear.'-01-01' && $var['EndDate'] <= $pyear.'-12-31');
            });

        $data['cysumtotaldollars'] = array_sum(Arr::pluck($currentyear,'TotalDollars'));        
        $pysumtotaldollars = array_sum(Arr::pluck($previousyear,'TotalDollars'));
    
        $difference = $data['cysumtotaldollars']-$pysumtotaldollars;
        if($data['cysumtotaldollars']>0)
            $data['precentage'] = ($difference/$data['cysumtotaldollars'])*100;
        else 
            $data['precentage'] =0;
        return view('widgets.total_sales', [
            'config' => $this->config,
            'data' => $data
        ]);
    }
}
