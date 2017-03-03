@include('layout.header',array("pagetitle"=>"Payment Types"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Payment Types");
$breadcrumb_url   = array("dashboard", "PaymentTypes");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Payment Types";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Payment Type','action'=>'paymenttypesmaster','fnid'=>'submit_paymentType'))
@include('layout.forminputtext',array('ft'=>'Payment Type','fin'=>'payment_desc','fph'=>'Payment Types','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Payment Type List'))

<form action="paymenttypesmaster" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Payment Type </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_payment_desc" id="search_payment_desc" value="<?php echo $search_payment_desc;?>" class="form-control form-filter" /></th>
            
            {{-- For search buttons  --}} 
           @include('layout.search')
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allpaymentTypes as $paymentTypes)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $paymentTypes->payment_desc }} </td>
                <td>    <?php if ($paymentTypes->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($paymentTypes->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($paymentTypes->status == 0) {?>
                    <span class="label label-sm label-danger"> Deleted </span>
                    <?php }?>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu">
                            <li>
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $paymentTypes->id }}" data-payment_desc="{{ $paymentTypes->payment_desc }}"   class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $paymentTypes->id }}" data-payment_desc="{{ $paymentTypes->payment_desc }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            {{-- For actions Delete and Suspend buttons function --}}
                    @include('layout.actions',array('loopobj'=>$paymentTypes,'blade_name'=>'paymenttypesmaster'))
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Payment Types','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Payment Types','fin'=>'view_payment_desc'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit PaymentType','action'=>'paymenttypesmaster','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Payment Types','fin'=>'edit_payment_desc','fph'=>'Payment Types','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/paymentType.js");?>
@include('layout.footer',array('js' =>$js))


