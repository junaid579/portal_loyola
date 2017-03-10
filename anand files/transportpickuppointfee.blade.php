@include('layout.header',array("pagetitle"=>"Transport pickup points and fee"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Transport Pickup Points & Fees");
$breadcrumb_url   = array("dashboard", "transportpickuppointfees");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Transport Pickup Points & Fees";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')

@include('layout.formopen',array('formheading'=>'Add Transport Pickup Point Fee','action'=>'transportpickuppointfee','fnid'=>'submit_sections'))
@include('layout.forminputtext',array('ft'=>'Pickup Point Name','fin'=>'pickup_point_name','fph'=>'Pickup Point Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Twoway Amount','fin'=>'twoway_amount','fph'=>'Twoway Amount','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Oneway Amount','fin'=>'oneway_amount','fph'=>'Oneway Amount','fiv'=>''))
@include('layout.formselectnumber',array('ft'=>'No of Terms','fin'=>'no_of_terms','startcount'=>'0','endcount'=>'12','fiv'=>'0'))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Transport Pickup Point Fee List'))

<form action="transportpickuppointfee" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th> SNO.</th>
            <th> Pickup Point </th>
            <th> Twoway Fee </th>
            <th> Oneway Fee </th>
            <th> No of Terms </th>
            <th> Twoway Terms Breakup </th>
            <th> Oneway Terms Breakup </th>
            <th> Status </th>
            <th> Action </th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_pickuppoint" id="search_pickuppoint" value="<?php echo $search_pickuppoint;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_twowayfee" id="search_twowayfee" value="<?php echo $search_twowayfee;?>" class="form-control form-filter" /></th>
            <th> <input type="text" name="search_onewayfee" id="search_onewayfee" value="<?php echo $search_onewayfee;?>" class="form-control form-filter"/></th>
            <th> <input type="text" name="search_noofterms" id="search_noofterms" value="<?php echo $search_noofterms;?>" class="form-control form-filter"/></th>
            <th> - </th>
            <th> - </th>
             <th>
                <select name="search_status" id="search_status" class="form-control form-filter">
                    <option value="" <?php if ($search_status == "") {?> selected="selected"  <?php }?>>Select</option>
                    <option value="1" <?php if ($search_status == "1") {?> selected="selected"  <?php }?> >Active</option>
                    <option value="2" <?php if ($search_status == "2") {?> selected="selected"  <?php }?> >Suspended</option>
                    <option value="0" <?php if ($search_status == "0") {?> selected="selected"  <?php }?> >Deleted</option>
                </select>
            </th>
            <th>
            	<button type="submit" name="search_submit" id="search_submit" class="btn btn-sm green btn-outline filter-submit margin-bottom" value="Search"><i class="fa fa-search"></i> Search</button>
            	<a  class="btn btn-sm red btn-outline filter-cancel" href="sections"><i class="fa fa-times"></i> Reset</a>
            </th>
        </tr>
    </tfoot>
    <tbody><?php $i = 1;

            $month =  array("0"=>"","1"=>"Janaury","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December"); 
            ?>
	@foreach($transportpickup as $tpickup)
		<?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++; ?>
        <?php   $twc = array(); 
        $twc = explode(",", $tpickup->twowayconcat);
        $owc = explode(",", $tpickup->onewayconcat);
        $tmc = explode(",", $tpickup->termmonthconcat);
        $tyc = explode(",", $tpickup->termyearconcat);
        $twowayterms = "";
        $onwwayterms = "";
        for($i=0;$i<$tpickup->no_of_terms;$i++){
            $temp = $i+1;
            $twowayterms = $twowayterms."<div style='padding:2px;'><b>Term".$temp.": </b>".$twc[$i].", ".$month[$tmc[$i]].", ".$tyc[$i]."</div>";
            $onwwayterms = $onwwayterms."<div style='padding:2px;'><b>Term".$temp.": </b>".$owc[$i].", ".$month[$tmc[$i]].", ".$tyc[$i]."</div>";
        }?> 
        <tr class="<?php echo $odd_even;?>">
            <td class="SNO"> </td>
            <td> {{ $tpickup->pickup_point_name }} </td>
            <td> {{ $tpickup->two_way_amount }} </td>
            <td> {{ $tpickup->one_way_amount }} </td>
            <td> {{ $tpickup->no_of_terms }} </td>
            <td> <?php echo $twowayterms; ?> </td>
            <td> <?php echo $onwwayterms; ?> </td>
            <td>    <?php if ($tpickup->status == 1) {?>
				<span class="label label-sm label-info"> Active </span>
				<?php } else if ($tpickup->status == 2) {?>
				<span class="label label-sm label-warning"> Suspended </span>
				<?php } else if ($tpickup->status == 0) {?>
				<span class="label label-sm label-danger"> Deleted </span>
				<?php }?>
			</td>
            <td>
            <a data-toggle="modal" href="#responsive" 
                                data-id="{{ $tpickup->tpuid }}" 
                                data-name="{{ $tpickup->pickup_point_name }}" 
                                data-twoway="{{ $tpickup->two_way_amount }}" 
                                data-oneway="{{ $tpickup->one_way_amount }}" 
                                data-noofterms="{{ $tpickup->no_of_terms }}" 
                                data-twowayterms="{{ $tpickup->twowayconcat }}" 
                                data-onwwayterms="{{ $tpickup->onewayconcat }}" 
                                data-monthterms="{{ $tpickup->termmonthconcat }}" 
                                data-yearterms="{{ $tpickup->termyearconcat }}" 
                                data-termsids="{{ $tpickup->termsids }}" class="edit-data btn btn-sm green">
                                    <i class="fa fa-edit"></i>  
                            </a>
            <a data-toggle="modal" href="#view-data-model" 
                                data-id="{{ $tpickup->tpuid }}" 
                                data-name="{{ $tpickup->pickup_point_name }}" 
                                data-twoway="{{ $tpickup->two_way_amount }}" 
                                data-oneway="{{ $tpickup->one_way_amount }}" 
                                data-noofterms="{{ $tpickup->no_of_terms }}" 
                                data-twowayterms="{{ $tpickup->twowayconcat }}" 
                                data-onwwayterms="{{ $tpickup->onewayconcat }}" 
                                data-monthterms="{{ $tpickup->termmonthconcat }}" 
                                data-yearterms="{{ $tpickup->termyearconcat }}" 
                                data-termsids="{{ $tpickup->termsids }}" class="view-data btn btn-sm yellow">
                                    <i class="fa fa-search"></i>  
                            </a>
                            <a  class="btn btn-sm red" data-toggle="confirmation" data-original-title="Are you sure want to delete?" data-singleton="true" href="transportpickuppointfee/{{$tpickup->tpuid}}/0"><i class="fa fa-trash-o"></i></a>
                            <a  class="btn btn-sm purple" data-toggle="confirmation" data-original-title="Are you sure want to Suspended?" data-singleton="true" href="transportpickuppointfee/{{$tpickup->tpuid}}/2"><i class="fa fa-pause"></i></a>
                         </td>
        </tr>
        @endforeach
    </tbody>
</table>
</form>
@include('layout.datatableclosing')

@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Transport Pickup Term Fee','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Pickup Point Name','fin'=>'v_pickup_point_name'))
@include('layout.forminputvalue',array('ft'=>'Twoway Amount','fin'=>'v_twoway_amount'))
@include('layout.forminputvalue',array('ft'=>'Oneway Amount','fin'=>'v_oneway_amount'))
@include('layout.forminputvalue',array('ft'=>'No of Terms','fin'=>'v_no_of_terms'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Transport Pickup Term Fee','action'=>'transportpickuppointfee','fnid'=>'edit_form'))
@include('layout.forminputtext',array('ft'=>'Pickup Point Name','fin'=>'e_pickup_point_name','fph'=>'Pickup Point Name','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Twoway Amount','fin'=>'e_twoway_amount','fph'=>'Twoway Amount','fiv'=>''))
@include('layout.forminputtext',array('ft'=>'Oneway Amount','fin'=>'e_oneway_amount','fph'=>'Oneway Amount','fiv'=>''))
@include('layout.formselectnumber',array('ft'=>'No of Terms','fin'=>'e_no_of_terms','startcount'=>'0','endcount'=>'12','fiv'=>'0'))     
@include('layout.modalformclose')


<?php $js = array("js/transportpickuppointfee.js","assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js","assets/pages/scripts/ui-confirmations.js");?>
@include('layout.footer',array('js' =>$js))
