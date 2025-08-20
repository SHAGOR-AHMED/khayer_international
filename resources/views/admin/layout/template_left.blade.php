<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    	<ul class="sidebar-menu">
        	<li>
        		<a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> <span>Dashboard</span> <i class="fa fa-angle-right pull-right"></i></a>
        	</li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Agent Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('agent.add') }}"><i class="fa fa-plus"></i>Add Agent</a></li>
					<li><a href="{{ route('agent.index') }}"><i class="fa fa-eye"></i>View Agent</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Client Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('client.index') }}"><i class="fa fa-eye"></i>View Client</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Entry Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View Entry</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Embassy Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Medical Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Manpower Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Delivery Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Accounts Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Advance Deposit Module</a></li>
					<li><a href="#"><i class="fa fa-plus"></i>Withdraw Module</a></li>
					<li><a href="#"><i class="fa fa-plus"></i>Due Management Module</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View Entry</a></li>
				</ul>
            </li>

            <li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users"></i> <span>Administration Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('user.add') }}"><i class="fa fa-plus"></i>Add User</a></li>
					<li><a href="{{ route('user.index') }}"><i class="fa fa-eye"></i>View User</a></li>
				</ul>
            </li>

      	</ul>
    </section>
    <!-- /.sidebar -->
</aside>