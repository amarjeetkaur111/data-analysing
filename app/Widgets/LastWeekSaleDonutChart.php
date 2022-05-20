<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;
use App\Models\PharmacyModel;

class LastWeekSaleDonutChart extends AbstractWidget
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
        $GetPharmacy = PharmacyModel::select('PharmacyId','PharmacyName')->get()->toArray();
        $sales = array();
        $last_week = strtotime("-1 week +1 day");
        $last_week_start = strtotime("last sunday midnight",$last_week);
        $last_week_end = strtotime("next saturday",$last_week_start);
        $last_week_start = date("Y-m-d",$last_week_start);
        $last_week_end = date("Y-m-d",$last_week_end);

        foreach($GetPharmacy as $pharmacy){
            $lastweek = array_filter($fulldata, function ($var) use($last_week_start,$last_week_end,$pharmacy){
                return ($var['StartDate'] >= $last_week_start && $var['EndDate'] <= $last_week_end && $var['Pharmacy'] == $pharmacy['PharmacyName']);
                });
            
            $dollararray = Arr::pluck($lastweek,'TotalDollars');
            $sales[$pharmacy['PharmacyName']] = array_sum($dollararray);
        }
        
        return view('widgets.last_week_sale_donut_chart', [
            'config' => $this->config,
            'sales' => $sales,
        ]);
    }
}
