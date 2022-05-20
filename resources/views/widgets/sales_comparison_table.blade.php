<style>
    .last5sales .table td{color:white;border:none;font-size:15px;padding-top: 0.7rem !important;padding-bottom: 0.9rem !important;}
    .percentage{font-size:20px}
</style>

<!-- Grid column -->
 <div class="col-lg-8 col-md-6 mb-0">

    <!-- Panel -->
    <div class="card">

    <div class="card-header white-text gradient-card-header" style="background-color: #ee8863;">
        Sales Statistics - Compared To 2022
    </div>

    <div class="last5sales table-responsive view view-cascade gradient-card-header blue-gradient" >
        <!--Table-->
        <table class="table table-hover mb-2 text-center">

        <!-- Table head -->
        <!-- Table head -->

        <!-- Table body -->
        <tbody>
            @for($s = 1; $s < count($sales); $s++)
            <tr>
            <td>{{$sales[$s]['year']}}</td>
            <td>{{$sales[$s]['TotalDollars']}}</td>
            <td>@if($sales[$s]['percentage'] < 0)
                    <span class="percentage">{{round($sales[$s]['percentage'])*-1}}</span> Decrease
                @else
                    <span class="percentage">{{round($sales[$s]['percentage'])}}</span> Increase
                @endif%
            </td>
            </tr>
            @endfor
        </tbody>
        <!-- Table body -->

        </table>
        <!-- Table -->
    </div>
    </div>

</div>
<!-- Panel -->

</div>