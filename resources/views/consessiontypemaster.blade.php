@include('layout.header',array("pagetitle"=>"consession Type"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

<?php $breadcrumb = array("Home", "Consession Type");
$breadcrumb_url   = array("dashboard", "ConsessionType");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Consession Type";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);?>
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Consession Type','action'=>'consessiontypemaster','fnid'=>'submit_consessionType'))
@include('layout.forminputtext',array('ft'=>'Consession Type','fin'=>'consession_desc','fph'=>'Consession Type','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'consession Type List'))

<form action="consessiontypemaster" method="POST" encType="multipart/form-data">
    <input Type="hidden" name="_method" value="post">
    <input Type="hidden" name="_token" value="<?php echo csrf_token();?>">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Consession Type </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input Type="text" name="search_consession_desc" id="search_consession_desc" value="<?php echo $search_consession_desc;?>" class="form-control form-filter" /></th>
            <th>
                <select name="search_status" id="search_status" class="form-control form-filter">
                    <option value="" <?php if ($search_status == "") {?> selected="selected"  <?php }?>>Select</option>
                    <option value="1" <?php if ($search_status == "1") {?> selected="selected"  <?php }?> >Active</option>
                    <option value="2" <?php if ($search_status == "2") {?> selected="selected"  <?php }?> >Suspended</option>
                    <option value="0" <?php if ($search_status == "0") {?> selected="selected"  <?php }?> >Deleted</option>
                </select>
            </th>
            <th>
                <button Type="submit" name="search_submit" id="search_submit" class="btn btn-sm green btn-outline filter-submit margin-bottom" value="Search">
                    <i class="fa fa-search"></i> Search</button>
                <a  class="btn btn-sm red btn-outline filter-cancel" href="consessiontypemaster"><i class="fa fa-times"></i> Reset</a>
            </th>
        </tr>
        </tfoot>
        <tbody><?php $i = 1;?>
        @foreach($allconsessionType as $consessionType)
            <?php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            ?>
            <tr class="<?php echo $odd_even;?>">
                <td class="SNO"> </td>
                <td> {{ $consessionType->consession_desc }} </td>
                <td>    <?php if ($consessionType->status == 1) {?>
                    <span class="label label-sm label-info"> Active </span>
                    <?php } else if ($consessionType->status == 2) {?>
                    <span class="label label-sm label-warning"> Suspended </span>
                    <?php } else if ($consessionType->status == 0) {?>
                    <span class="label label-sm label-danger"> Deleted </span>
                    <?php }?>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" Type="button" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu">
                            <li>
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $consessionType->id }}" data-consession_desc="{{ $consessionType->consession_desc }}"   class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $consessionType->id }}" data-consession_desc="{{ $consessionType->consession_desc }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            <li class="divider"> </li>
                            <?php if ($consessionType->status == 1) {?>
                            <li>
                            <?php } else if ($consessionType->status == 2) {?>
                            <li>
                            <?php }?>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View consession Type','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'consession Type','fin'=>'view_consession_desc'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit consessionType','action'=>'consessiontypemaster','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'consession Type','fin'=>'edit_consession_desc','fph'=>'consession Type','fiv'=>''))

@include('layout.modalformclose')

<?php $js = array("js/consessionType.js");?>
@include('layout.footer',array('js' =>$js))


