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
					<li><a href="{{ route('agent.ledger') }}"><i class="fa fa-bar-chart"></i>Agent Ledger</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users fa-lg"></i> <span>Supplier Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('supplier.add') }}"><i class="fa fa-plus"></i>Add New Supplier</a></li>
					<li><a href="{{ route('supplier.index') }}"><i class="fa fa-eye"></i>View All Supplier</a></li>
					<li><a href="{{ route('supplier.ledger') }}"><i class="fa fa-bar-chart"></i>Supplier Ledger</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users fa-lg"></i> <span>Passenger Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('client.add') }}"><i class="fa fa-plus"></i>Add New Passenger</a></li>
					<li><a href="{{ route('client.index') }}"><i class="fa fa-eye"></i>View All Passengers</a></li>
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
					<li><a href="{{ route('embassy.index') }}"><i class="fa fa-eye"></i>View All</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-cog fa-lg"></i> <span>Manpower Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('manpower.index') }}"><i class="fa fa-eye"></i>View All</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-delicious fa-lg"></i> <span>Delivery Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('delivery.index') }}"><i class="fa fa-eye"></i>View All</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-users fa-lg"></i> <span>Purchase Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('purchase.add') }}"><i class="fa fa-plus"></i>Add New Purchase</a></li>
					<li><a href="{{ route('purchase.index') }}"><i class="fa fa-eye"></i>Manage Purchase</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-calculator fa-lg"></i> <span>Accounts Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('payment.index') }}"><i class="fa fa-eye"></i>Manage Payment</a></li>
					<li><a href="{{ route('received.index') }}"><i class="fa fa-eye"></i>Manage Received</a></li>
					<li><a href="{{ route('expense.index') }}"><i class="fa fa-eye"></i>Manage Expense</a></li>
				</ul>
            </li>

			<li class="treeview">
				<a href="javascript:">
					<i class="fa fa-usd fa-lg"></i> <span>Bank Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('bank.index') }}"><i class="fa fa-plus"></i>Manage Bank</a></li>
					<li><a href="{{ route('bank.ledger') }}"><i class="fa fa-bar-chart"></i>Bank Ledger</a></li>
				</ul>
            </li>

            <li class="treeview">
				<a href="javascript:">
					<i class="fa fa-wrench fa-lg"></i> <span>Administration Module</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('user.add') }}"><i class="fa fa-plus"></i>Add New User</a></li>
					<li><a href="{{ route('user.index') }}"><i class="fa fa-eye"></i>View All User</a></li>
				</ul>
            </li>

      	</ul>
    </section>
    <!-- /.sidebar -->
</aside>