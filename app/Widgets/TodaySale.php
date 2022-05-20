<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class TodaySale extends AbstractWidget
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
        $today = date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($today .' -1 day'));
        $currentyear = array_filter($fulldata, function ($var) use($today){
            return ($var['StartDate'] >= $today || $var['EndDate'] <= $today);
            });
        $previousyear = array_filter($fulldata, function ($var) use($prev_date){
            return ($var['StartDate'] >= $prev_date || $var['EndDate'] <= $prev_date);
            });

        $data['todaysale'] = array_sum(Arr::pluck($currentyear,'TotalDollars'));        
        $yesterdaysale = array_sum(Arr::pluck($previousyear,'TotalDollars'));
    
        $difference = $data['todaysale']-$yesterdaysale;
        if($data['todaysale']>0)
            $data['precentage'] = ($difference/$data['todaysale'])*100;
        else
            $data['precentage']=0;
        return view('widgets.today_sale', [
            'config' => $this->config,
            'data' => $data,
        ]);
    }
}
