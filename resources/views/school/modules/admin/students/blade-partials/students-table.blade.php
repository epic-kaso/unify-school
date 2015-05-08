<div class="row">
	
	<div class="col-sm-12" style="margin: 0px 0px 30px 0px;">
		<form class="form-inline col-sm-12"  name="SearchForm" ng-submit="searchStudents(query)">
			<div class="form-group">
				<input type="text" 
					 style="width: 400px;"
					 placeholder="Search Students" 
					 class="form-inline form-control"
					 ng-model="query"
					 required
					 >
			</div>
			<div class="form-group">
				<div class="btn-group">
					<button class="btn btn-primary" ng-click="searchStudents(query)">Search</button>
				</div>
			</div>
		</form>
	
  <div class="col-sm-12">
    
    <div style="margin-top: 10px;margin-bottom: 10px;">
      
      <div style="margin-left: 10px;" class="btn-group pull-right">
  			<button class="btn btn-default" 
                ng-disabled="!showContextMenu" 
                ng-click="menu.changeSelectedStudentsClass(Students.data)">
                CHANGE CLASS
        </button>
  			<button class="btn btn-default" 
                ng-disabled="!showContextMenu" 
                ng-click="menu.printSelectedStudents(Students.data)">
                PRINT
        </button>
  			<button class="btn btn-default" 
                ng-disabled="!showContextMenu" 
                ng-click="menu.exportSelectedStudentsToExcel(Students.data)">
                EXCEL
        </button>
  			<button class="btn btn-danger"  
                ng-disabled="!showContextMenu" 
                ng-click="menu.deleteSelectedStudents(Students.data)">
                DELETE
        </button>
		  </div>
      
      <div style="margin-left: 10px;" class="btn-group pull-right">
        <button class="btn btn-success" 
                ng-disabled="!showContextMenu" 
                ng-click="menu.promoteSelectedStudents(Students.data)">
                PROMOTE
        </button>
        <button class="btn btn-warning" 
                ng-disabled="!showContextMenu" 
                ng-click="menu.demoteSelectedStudents(Students.data)">
                DEMOTE
        </button>
      </div>
	</div>
  </div>
  
  <div class="col-sm-12">
    
		<table style="margin-top: 10px;" class="table table-striped table-bordered" ng-class="{'whirl standard': loadingStudents}">
			<thead>
				<tr>
					<td>
						<input type="checkbox" ng-model="select_all_students" ng-change="selectAllStudents(Students.data,select_all_students)">
					</td>
					<td>ID</td>
					<td>Sur Name</td>
					<td>First Name</td>
					<td>Middle Name</td>
					<td>Reg Number</td>
					<td>Class</d>
					<td>..</td>
				</tr>
			</thead>
			
			<tbody>
				<tr ng-class="{'whirl standard': student.updating}" ng-repeat="student in Students.data" class="student-row" >
					<td>
						<input type="checkbox" ng-model="student.selected" ng-change="studentSelected(Students.data,student,$index)">
					</td>
					<td ng-click="viewStudent(student.id)">@{{ Students.from + $index }}</td>
<!--					<td ng-click="viewStudent(student.id)"><img style="height: 50px;border-radius: 100px;" 
							class="img-responsive img-rounded img-thumbnail" 
							ng-src="@{{ student.picture.dataURL || '/img/placeholder.jpg'}}" 
							alt=""
						/>
					</td>-->
					<td>
						<span class="">
                <span class="span" ng-hide="student.edit_last_name">
                    <span style="text-decoration: none;color: #428bca;border-bottom: dashed 1px #428bca;">
                         @{{ student.last_name }}
                    </span>

                    <span class="btn btn-xs" ng-click="student.edit_last_name = true;">
                        <span class="fa fa-pencil"></span>
                    </span>
                </span>

                <span class="edit-box" style="display: inline-block;width: 220px;"
                      ng-show="student.edit_last_name">
                    <input style="width: 150px;display: inline-block" type="text"
                           ng-model="student.last_name"
                           class="form-control"/>
                    <span class="btn btn-primary btn-sm"
                          style="width: 30px"
                          ng-click="saveStudentEditMode($event,student,$index);student.edit_last_name = false;"><span class="fa fa-check"></span></span>
                    <span class="btn btn-default btn-sm"
                          style="width: 30px"
                          ng-click="student.edit_last_name = false;">
                          <span class="fa fa-times"></span>
                     </span>
                </span>
           </span>
					</td>
					<td>
						<span class="">
                <span class="span" ng-hide="student.edit_first_name">
                    <span style="text-decoration: none;color: #428bca;border-bottom: dashed 1px #428bca;">
                         @{{ student.first_name }}
                    </span>

                    <span class="btn btn-xs" ng-click="student.edit_first_name = true;">
                        <span class="fa fa-pencil"></span>
                    </span>
                </span>

                <span class="edit-box" style="display: inline-block;width: 220px;"
                      ng-show="student.edit_first_name">
                    <input style="width: 150px;display: inline-block" type="text"
                           ng-model="student.first_name"
                           class="form-control"/>
                    <span class="btn btn-primary btn-sm"
                          style="width: 30px"
                          ng-click="saveStudentEditMode($event,student,$index);student.edit_first_name = false;"><span class="fa fa-check"></span></span>
                    <span class="btn btn-default btn-sm"
                          style="width: 30px"
                          ng-click="student.edit_first_name = false;">
                          <span class="fa fa-times"></span>
                     </span>
                </span>
           </span>
					</td>
					<td>
						<span class="">
                <span class="span" ng-hide="student.edit_middle_name">
                    <span style="text-decoration: none;color: #428bca;border-bottom: dashed 1px #428bca;">
                         @{{ student.middle_name || 'empty' }}
                    </span>

                    <span class="btn btn-xs" ng-click="student.edit_middle_name = true;">
                        <span class="fa fa-pencil"></span>
                    </span>
                </span>

                <span class="edit-box" style="display: inline-block;width: 220px;"
                      ng-show="student.edit_middle_name">
                    <input style="width: 150px;display: inline-block" type="text"
                           ng-model="student.middle_name"
                           class="form-control"/>
                    <span class="btn btn-primary btn-sm"
                          style="width: 30px"
                          ng-click="saveStudentEditMode($event,student,$index);student.edit_middle_name = false;"><span class="fa fa-check"></span></span>
                    <span class="btn btn-default btn-sm"
                          style="width: 30px"
                          ng-click="student.edit_middle_name = false;">
                          <span class="fa fa-times"></span>
                     </span>
                </span>
           </span>
					</td>
					<td><strong>@{{ student.reg_number }}</strong></td>
					<td>
						<span class="">
                <span class="span" ng-hide="student.edit_school_class">
                    <span style="text-decoration: none;color: #428bca;border-bottom: dashed 1px #428bca;">
                         @{{ student.current_class_student.school_class.display_name || 'N/A' }}
                    </span>

                    <span class="btn btn-xs" ng-click="student.edit_school_class = true;">
                        <span class="fa fa-pencil"></span>
                    </span>
                </span>

                <span class="edit-box" style="display: inline-block;width: 220px;"
                      ng-show="student.edit_school_class">
                    <select style="width: 150px;display: inline-block" 
                           ng-model="student.current_class_student.scoped_school_category_arm_subdivision_id"
                           ng-options="sub_class.id as sub_class.display_name for sub_class in classes"
                           class="form-control">
	                  </select>
                    <span class="btn btn-primary btn-sm"
                          style="width: 30px"
                          ng-click="saveStudentEditMode($event,student,$index);student.edit_school_class = false;"><span class="fa fa-check"></span></span>
                    <span class="btn btn-default btn-sm"
                          style="width: 30px"
                          ng-click="student.edit_school_class = false;">
                          <span class="fa fa-times"></span>
                     </span>
                </span>
           </span>
          </td>
					<td>  
						<span class="dropdown" dropdown on-toggle="toggled($event)">
					      <a href class="dropdown-toggle" dropdown-toggle>
					        <span class="fa fa-navicon"></span>
					      </a>
					      <ul class="dropdown-menu">
							  <li><a ui-sref="app.students.view_student({id: student.id})">View</a></li>
					        <li ng-repeat="choice in studentActionMenuItems">
					          <a href>@{{ choice.name }}</a>
					        </li>
					      </ul>
					    </span> 
					</td>
				</tr>
			</tbody>
		
		</table>
		<ul class="pager">
		  <li ng-class="{disabled: !Students.prev_page_url}" class="previous"><a href="" ng-click="fetchPage(Students.prev_page_url)" >« Previous</a></li>
		  <li ng-class="{disabled: !Students.next_page_url}" class="next"><a href="" ng-click="fetchPage(Students.next_page_url)">Next »</a></li>
		</ul>
	</div>
</div>