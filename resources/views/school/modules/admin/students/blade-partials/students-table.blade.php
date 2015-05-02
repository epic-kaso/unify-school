<div class="row">
	
	<div class="col-sm-12">
		<form class="form-inline">
			<div class="form-group">
				<input type="text" placeholder="Search Students" class="form-inline form-control">
			</div>
			<div class="form-group">
				<div class="btn-group">
					<button class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
	
	<div class="col-sm-12">
		<table class="table">
			<thead>
				<tr>
					<td>..</td>
					<td>Picture</td>
					<td>Last Name</td>
					<td>First Name</td>
					<td>Reg Number</td>
					<td>Class</td>
					<td>Options</td>
				</tr>
			</thead>
			
			<tbody>
				<tr ng-repeat="student in Students.data" class="student-row" >
					<td ng-click="viewStudent(student.id)">@{{ 1 + $index }}</td>
					<td ng-click="viewStudent(student.id)"><img style="height: 50px;border-radius: 100px;" 
							class="img-responsive img-rounded img-thumbnail" 
							ng-src="@{{ student.picture.dataURL || '/img/placeholder.jpg'}}" 
							alt=""
						/>
					</td>
					<td ng-click="viewStudent(student.id)">@{{ student.last_name }}</td>
					<td ng-click="viewStudent(student.id)">@{{ student.first_name }}</td>
					<td ng-click="viewStudent(student.id)"><strong>@{{ student.reg_number }}</strong></td>
					<td ng-click="viewStudent(student.id)">@{{ student.current_class_student.school_class.display_name || 'N/A' }}</td>
					<td>  
						<span class="dropdown" dropdown on-toggle="toggled($event)">
					      <a href class="dropdown-toggle" dropdown-toggle>
					        <span class="fa fa-navicon"></span>
					      </a>
					      <ul class="dropdown-menu">
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