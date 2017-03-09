$(document).ready(function() {
	$("#sample_1").on("click",".edit-data", function(){
        $("#edit_form")[0].reset();
        $("#edit_id").val( $(this).data("id") );
        $("#edit_classes").val( $(this).data("class") );
        $("#edit_sections").val( $(this).data("section") );
        $("#edit_subjects").val( $(this).data("subject") );
        $("#edit_test_name").val( $(this).data("name") );

    });
    $("#sample_1").on("click",".view-data", function(){
    	alert($(this).data("class"));
    	alert($(this).data("section"));
    	alert($(this).data("subject"));
    	alert($(this).data("name"));
    	
    	
        $("#view_classes, #view_sections, #view_subjects , #view_test_name").html("");
        $("#view_classes").html( $(this).data("class") );
        $("#view_sections").val( $(this).data("section") );
        $("#view_subjects").val( $(this).data("subject") );
        $("#view_test_name").val( $(this).data("name") );
    });
	var t = $('#sample_1').DataTable( {
        language:{
			aria:{
			sortAscending:": activate to sort column ascending",
			sortDescending:": activate to sort column descending"},
			emptyTable:"No data available in table",
			info:"Showing _START_ to _END_ of _TOTAL_ records",
			infoEmpty:"No records found",
			infoFiltered:"(filtered1 from _MAX_ total records)",
			lengthMenu:"Show _MENU_",
			search:"Search:",
			zeroRecords:"No matching records found",
			paginate:{
				previous:"Prev",
				next:"Next",
				last:"Last",
				first:"First"
			}
		},
		bStateSave:!0,
		lengthMenu:[[10,20,30,-1],[10,20,30,"All"]],
		pageLength:10,
		pagingType:"bootstrap_full_number",
		autoWidth: false,
		colReorder: true,
		columns: [
	        { name: 'col1' },
	        { name: 'col2' },
	        { name: 'col3' },
	        { name: 'col4' },
	        { name: 'col5' },
	        { name: 'col6' },
	        { name: 'col7' }
	       	],
		columnDefs:[
			{
				orderable:false,
				targets:[]
			},{
				searchable:false,
				targets:[-1,0],
			},{
				className:"dt-right"
			},{
				sortable: false,
        		targets: [-1,0]
			},{
				visible: false, 
				targets: [] 
			}
		],
		order:[[3,"asc"]],
		buttons: [
            { 	extend: 'print', 
            	exportOptions: {  columns: ':visible' }, 
            	className: 'btn dark btn-outline',
            	title: function () { return getExportHeading(); }
            },
            { extend: 'copy', exportOptions: {  columns: ':visible' }, className: 'btn red btn-outline' },
            { 	extend: 'pdf', 
            	exportOptions: {  columns: ':visible' }, 
            	className: 'btn green btn-outline',
            	filename: function () { return getExportFileName(); },
            	title: function () { return getExportHeading(); },
            },
            { extend: 'excel', exportOptions: {  columns: ':visible' }, className: 'btn yellow btn-outline',filename: function () { return getExportFileName(); } },
            { extend: 'csv', exportOptions: {  columns: ':visible' }, className: 'btn purple btn-outline',filename: function () { return getExportFileName(); } },
            { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
        ],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });
 
    t.on('order.dt search.dt', function () {
        t.column('col1:name', {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
});
function getExportFileName(){
    d = new Date()
    df = d.getDate()+'_'+d.getMonth()+'_'+d.getFullYear()+'_'+(d.getHours()+1)+'_'+d.getMinutes()
    return "TestMaster_"+df;
}
function getExportHeading(){
    return "TestMaster";
}