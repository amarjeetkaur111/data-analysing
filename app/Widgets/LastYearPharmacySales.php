<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;
use App\Models\PharmacyModel;

class LastYearPharmacySales extends AbstractWidget
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
        for ($i = 0; $i < 12; $i++) {
            $sales[$i]['month'] = date("My", strtotime( date( 'Y-m-01' )." -$i months"));
            $sales[$i]['monthdate'] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
            $sales[$i]['Sales'] = 0;
        }

        foreach($sales as $key => $value){
            foreach($GetPharmacy as $pharmacy){
                $salesarray = array_filter($fulldata, function ($var) use($value,$pharmacy){
                    return ($var['StartDate'] >= $value['monthdate'].'-01' && $var['EndDate'] <=$value['monthdate'].'-31' && $var['Pharmacy'] == $pharmacy['PharmacyName']);
                    });
                
                $dollararray = Arr::pluck($salesarray,'TotalDollars');
                $sales[$key][$pharmacy['PharmacyName']] = array_sum($dollararray);
                $sales[$key]['Sales'] += array_sum($dollararray);  
            }
        }
        
        return view('widgets.last_year_pharmacy_sales', [
            'config' => $this->config,
            'sales' => $sales,
            'pharmacy' => $GetPharmacy,
        ]);
    }
}
