<div class="row">
	
	<div class="col-sm-12" style="margin: 0px 0px 30px 0px;">
		<form class="form-inline col-sm-6"  name="SearchForm" ng-submit="searchStudents(query)">
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
		
		<div class="btn-group pull-right">
			<button class="btn btn-default" ng-click="">CHANGE CLASS</button>
			<button class="btn btn-default" ng-click="">PRINT</button>
			<button class="btn btn-default" ng-click="">EXCEL</button>
			<button class="btn btn-default" ng-click="">PDF</button>
			<button class="btn btn-danger" ng-click="">DELETE</button>
		</div>
	</div>
	
	<div class="col-sm-12">
		<table class="table table-striped table-bordered" ng-class="{'whirl standard': loadingStudents}">
			<thead>
				<tr>
					<td><button class="btn btn-default btn-block">ID</button></td>
					<td><button class="btn btn-default btn-block">Picture</button></td>
					<td><button class="btn btn-default btn-block">Last Name</button></td>
					<td><button class="btn btn-default btn-block">First Name</button></td>
					<td><button class="btn btn-default btn-block">Reg Number</button></td>
					<td><button class="btn btn-default btn-block">Class</button></td>
					<td><button class="btn btn-default btn-block">Options</button></td>
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