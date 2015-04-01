<div class="flat_area grid_16"><h2>Departments
        <div class="holder">
            <?php echo CHtml::link('<button class="blue full_width left div_icon has_text"><div class="ui-icon ui-icon-plusthick"></div><span>Create Department</span></button>',array('/admin/department/create'),array('class'=>'blue full_width left div_icon has_text')) ?>
        </div>
    </h2></div>
<div class="box grid_16 single_datatable">
    <div class="no_margin">
        <table class="datatable" id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Department Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Add / Edit Department Head</th>
                    <th>Visible in Hierarchy</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $key => $department): ?>
                    <tr>
                        <td align="center"><?php echo $key + 1; ?></td>
                        <td align="center"><?php echo $department->dept_name ?></td>
                        <td align="center"><?php echo $department->deptParent->dept_name ?></td>
                        <td align="center"><?php echo $department->status == '1' ? 'Active' : 'Inactive' ?></td>
                        <td align="center">
                            <?php
                            $icon = $department->dept_head_user_id != 0 ? 'ui-icon-pencil' : 'ui-icon-circle-plus';
                            echo CHtml::link('<button class="light icon_only div_icon narrow"><div class="ui-icon '.$icon.'"></div></button>', array('/admin/department/adduser', 'id' => $department->dept_id), array('id' => 'tooltip1')) . "&nbsp;&nbsp;";
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            echo $department->dept_head_user_id != 0 ? '<div class="ui-icon ui-icon-check"></div>' : '<div class="ui-icon ui-icon-close"></div>';
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            echo CHtml::link('<button class="light icon_only div_icon narrow"><div class="ui-icon ui-icon-search"></div></button>', array('/admin/department/view', 'id' => $department->dept_id), array('id' => 'tooltip1')) . "&nbsp;&nbsp;";
                            echo CHtml::link('<button class="light icon_only div_icon narrow"><div class="ui-icon ui-icon-pencil"></div></button>', array('/admin/department/update', 'id' => $department->dept_id), array('id' => 'tooltip')) . "&nbsp;&nbsp;";
                            echo CHtml::link('<button class="light icon_only div_icon narrow"><div class="ui-icon ui-icon-close"></div></button>', array('/admin/department/delete', 'id' => $department->dept_id), array('id' => 'tooltip', 'onclick' => "return confirm('Are you sure you want to delete?');"));
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
                                    { "bSortable": false, "aTargets": [ 2,3 ] }
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