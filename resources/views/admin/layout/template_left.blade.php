<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    	<ul class="sidebar-menu">
        	<li>
        		<a href="{{ route('admin.home') }}">
					<i class="fa fa-home fa-lg"></i> <span>Dashboard</span> <i class="fa fa-angle-right pull-right"></i>
				</a>
        	</li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users fa-lg"></i> <span>Agent Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('agent.add') }}"><i class="fa fa-plus"></i>Add New Agent</a></li>
					<li><a href="{{ route('agent.index') }}"><i class="fa fa-eye"></i>View All Agents</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users fa-lg"></i> <span>Client Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('client.index') }}"><i class="fa fa-eye"></i>View All Clients</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-list fa-lg"></i> <span>Entry Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('entry.add') }}"><i class="fa fa-plus"></i>Add New Entry</a></li>
					<li><a href="{{ route('entry.index') }}"><i class="fa fa-eye"></i>View All Entries</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-university fa-lg"></i> <span>Embassy Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-medkit fa-lg"></i> <span>Medical Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-cog fa-lg"></i> <span>Manpower Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-delicious fa-lg"></i> <span>Delivery Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-plus"></i>Add New</a></li>
					<li><a href="#"><i class="fa fa-eye"></i>View</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-usd fa-lg"></i> <span>Accounts Module</span> <i class="fa fa-angle-left pull-right"></i>
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
					<i class="fa fa-wrench fa-lg"></i> <span>Administration Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('user.add') }}"><i class="fa fa-plus"></i>Add New User</a></li>
					<li><a href="{{ route('user.index') }}"><i class="fa fa-eye"></i>View User</a></li>
				</ul>
            </li>

      	</ul>
    </section>
    <!-- /.sidebar -->
</aside>