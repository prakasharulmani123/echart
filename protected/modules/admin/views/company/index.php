<div class="flat_area grid_16"><h2>Companies
        <div class="holder">
            <?php echo CHtml::link('<button class="blue full_width left div_icon has_text"><div class="ui-icon ui-icon-plusthick"></div><span>Create Company</span></button>',array('/admin/company/create'),array('class'=>'blue full_width left div_icon has_text')) ?>
        </div>
    </h2></div>
<div class="box grid_16 single_datatable">
    <div class="no_margin">
        <table class="datatable" id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $key => $company): ?>
                    <tr>
                        <td align="center"><?php echo $key + 1; ?></td>
                        <td align="center"><?php echo $company->company_name ?></td>
                        <td align="center"><?php echo $company->company_address ?></td>
                        <td align="center"><?php echo $company->status == '1' ? 'Active' : 'Inactive' ?></td>
                        <td align="center">
                            <?php
//                            echo CHtml::link('<button class="light icon_only div_icon narrow"><div class="ui-icon ui-icon-search"></div></button>', array('/admin/company/view', 'id' => $company->company_id), array('id' => 'tooltip1')) . "&nbsp;&nbsp;";
                            echo CHtml::link('<button class="light icon_only div_icon narrow"><div class="ui-icon ui-icon-pencil"></div></button>', array('/admin/company/update', 'id' => $company->company_id), array('id' => 'tooltip')) . "&nbsp;&nbsp;";
                            echo CHtml::link('<button class="light icon_only div_icon narrow"><div class="ui-icon ui-icon-close"></div></button>', array('/admin/company/delete', 'id' => $company->company_id), array('id' => 'tooltip', 'onclick' => "return confirm('Are you sure you want to delete?');"));
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
Yii::app()->getClientScript()->registerScript('main', '$(document).ready(function() {
            $("#data-table").dataTable( {
				"bJQueryUI": true,
				"sScrollX": "",
				"bSortClasses": false,
				"aaSorting": [[0,"asc"]],
                                "aoColumnDefs": [
                                    { "bSortable": false, "aTargets": [ 3,4 ] }
                                 ],
				"bAutoWidth": true,
				"bInfo": true,
				"sScrollX": "101%",
				"bScrollCollapse": true,
				"sPaginationType": "full_numbers",
				"bRetrieve": true,
				"fnInitComplete": function () {
					$(".dataTables_length > label > select").uniform();
					$(".dataTables_filter input[type=text]").addClass("text");
					$(".datatable").css("visibility","visible");
				}
	});
        });');
?>