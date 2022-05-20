<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Arr;

class InteractivePieChart extends AbstractWidget
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
        $sales = array();
        $sales[0]['year'] = date("Y");
        $sales[0]['Sales'] = 0;
       
        for($i = 1; $i < 6; $i++){
            $sales[$i]['year'] = $sales[0]['year'] - $i;
            $sales[$i]['Sales'] = 0;
        }

        foreach($sales as $key => $value){
            $salesarray = array_filter($fulldata, function ($var) use($value){
                return ($var['StartDate'] >= $value['year'].'-01-01' && $var['EndDate'] <=$value['year'].'-12-31');
                });
            
            $dollararray = Arr::pluck($salesarray,'TotalDollars');
            $sales[$key]['Sales'] += array_sum($dollararray);  
        }
        
        return view('widgets.interactive_pie_chart', [
            'config' => $this->config,
            'sales' => $sales,
        ]);
    }
}
