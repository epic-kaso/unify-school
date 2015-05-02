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
				<tr ng-repeat="student in Students.data" class="student-row" ng-click="viewStudent(student.id)">
					<td>@{{ 1 + $index }}</td>
					<td><img style="height: 50px;border-radius: 100px;" 
							class="img-responsive img-rounded img-thumbnail" 
							ng-src="@{{ student.picture.dataURL || '/img/placeholder.jpg'}}" 
							alt=""
						/>
					</td>
					<td>@{{ student.last_name }}</td>
					<td>@{{ student.first_name }}</td>
					<td><strong>@{{ student.reg_number }}</strong></td>
					<td>@{{ student.current_class_student.school_class.display_name || 'N/A' }}</td>
					<td><span class="btn btn-default"><span class="fa fa-navicon"></span></span></td>
				</tr>
			</tbody>
		
		</table>
		<ul class="pager">
		  <li ng-class="{disabled: !Students.prev_page_url}" class="previous"><a href="" ng-click="fetchPage(Students.prev_page_url)" >« Previous</a></li>
		  <li ng-class="{disabled: !Students.next_page_url}" class="next"><a href="" ng-click="fetchPage(Students.next_page_url)">Next »</a></li>
		</ul>
	</div>
</div>