@include('layout.header',array("pagetitle"=>"Religion"))
@include('layout.topmenu')
@include('layout.leftsidemenu')

@php $breadcrumb = array("Home", "Religion");
$breadcrumb_url   = array("dashboard", "religion");
$breadcrumbs      = array_combine($breadcrumb, $breadcrumb_url);
$title            = "Religion";
$data             = array('breadcrumbs' => $breadcrumbs, 'title' => $title);@endphp
@include('layout.breadcrumb',array('data'=>$data))

@include('layout.messages')



@include('layout.formopen',array('formheading'=>'Add Religion','action'=>'religion','fnid'=>'submit_religion'))
@include('layout.forminputtext',array('ft'=>'Religion Name','fin'=>'religion_name','fph'=>'Religion Name','fiv'=>''))
@include('layout.formclose')

@include('layout.datatableopening',array('tableheading'=>'Religions List'))

<form action="religion" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="@php echo csrf_token();@endphp">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th> SNO.</th>
            <th> Religion Name </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> - </th>
            <th> <input type="text" name="search_religion_name" id="search_religion_name" value="@php echo $search_religion_name;@endphp" class="form-control form-filter" /></th>
            <th>
                <select name="search_status" id="search_status" class="form-control form-filter">
                    <option value="" @php if ($search_status == "") {@endphp selected="selected"  @php }@endphp>Select</option>
                    <option value="1" @php if ($search_status == "1") {@endphp selected="selected"  @php }@endphp >Active</option>
                    <option value="2" @php if ($search_status == "2") {@endphp selected="selected"  @php }@endphp >Suspended</option>
                    <option value="0" @php if ($search_status == "0") {@endphp selected="selected"  @php }@endphp >Deleted</option>
                </select>
            </th>
            <th>
                <button type="submit" name="search_submit" id="search_submit" class="btn btn-sm green btn-outline filter-submit margin-bottom" value="Search"><i class="fa fa-search"></i> Search</button>
                <a  class="btn btn-sm red btn-outline filter-cancel" href="religion"><i class="fa fa-times"></i> Reset</a>
            </th>
        </tr>
        </tfoot>
        <tbody>@php $i = 1;@endphp
        @foreach($allreligions as $religions)
            @php if ($i%2 == 0) {$odd_even = "odd gradeX";} else { $odd_even = "even gradeX";}$i++;
            @endphp
            <tr class="@php echo $odd_even;@endphp">
                <td class="SNO"> </td>
                <td> {{ $religions->religion_name }} </td>
                <td>    @php if ($religions->status == 1) {@endphp
                    <span class="label label-sm label-info"> Active </span>
                    @php } else if ($religions->status == 2) {@endphp
                    <span class="label label-sm label-warning"> Suspended </span>
                    @php } else if ($religions->status == 0) {@endphp
                    <span class="label label-sm label-danger"> Deleted </span>
                    @php }@endphp
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu">
                            <li>
                                <a data-toggle="modal" href="#view-data-model" data-id="{{ $religions->id }}" data-religion_name="{{ $religions->religion_name }}"    class="view-data"><i class="icon-docs"></i> View </a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#responsive" data-id="{{ $religions->id }}" data-religion_name="{{ $religions->religion_name }}"  class="edit-data"><i class="icon-tag"></i> Edit </a>
                            </li>
                            <li class="divider"> </li>
                            @php if ($religions->status == 1) {@endphp
                            <li>
                            @php } else if ($religions->status == 2) {@endphp
                            <li>
                            @php }@endphp
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
@include('layout.datatableclosing')


@include('layout.modalformopen',array('mid'=>'view-data-model','formheading'=>'View Religions','action'=>'','fnid'=>''))
@include('layout.forminputvalue',array('ft'=>'Religion Name','fin'=>'view_religion_name'))
@include('layout.modalviewformclose')

@include('layout.modalformopen',array('mid'=>'responsive','formheading'=>'Edit Religions','action'=>'religion','fnid'=>'edit_form'))

@include('layout.forminputtext',array('ft'=>'Religion Name','fin'=>'edit_religion_name','fph'=>'Religion Name','fiv'=>''))

@include('layout.modalformclose')



@php $js = array("js/religion.js");@endphp
@include('layout.footer',array('js' =>$js))


