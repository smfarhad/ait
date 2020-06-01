<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
       
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{URL::asset('assets/admin/img/avatar5.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION
                
            
            </li>
            <li class="active treeview">
                <a href="{{URL::to('/admin')}}">
                    <i class="fa fa-dashboard"></i> <span> Dashboard</span>
                </a>
            </li>
            @foreach(session()->get('permission') as $row)
                @if($row->module_id == 2 && $row->read_access == 1 )
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-bookmark-o"></i> <span> {{config('site_nav.ait.name')}} </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{URL::to(config('site_nav.ait.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.ait.list')}}</a></li>
                            <li><a href="{{URL::to(config('site_nav.ait.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.ait.add')}}</a></li>
                        </ul>
                    </li>
                @endif
            @endforeach
            @foreach(session()->get('permission') as $row)
                @if($row->module_id == 1 && $row->read_access == 1)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-bookmark-o"></i> <span> {{config('site_nav.aitapprove.name') }} {{$row->module_id . $row->read_access }} </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{URL::to(config('site_nav.aitapprove.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.aitapprove.list')}}</a></li>

                        </ul>
                    </li>
                @endif
            @endforeach
            @foreach(session()->get('permission') as $row)
                @if($row->module_id == 5 && $row->read_access == 1 )
                    <li class="treeview">
                        <a href="#">

                            <i class="fa fa-align-justify"></i> <span> {{config('site_nav.head.name')}} </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{URL::to(config('site_nav.head.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.head.list')}}</a></li>
                            <li><a href="{{URL::to(config('site_nav.head.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.head.add')}}</a></li>
                        </ul>
                    </li> 
               @endif
            @endforeach
            @foreach(session()->get('permission') as $row)
                @if($row->module_id == 9 && $row->read_access == 1 )
            <li class="treeview">
                <a href="#">

                    <i class="fa fa-align-justify"></i> <span> {{config('site_nav.paymentcode.name')}} </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a  href="{{URL::to(config('site_nav.paymentcode.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.paymentcode.list')}}</a></li>
                    <li><a href="{{URL::to(config('site_nav.paymentcode.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.paymentcode.add')}}</a></li>
                </ul>
            </li> 
             @endif
            @endforeach
            @foreach(session()->get('permission') as $row)
                @if($row->module_id == 3 && $row->read_access == 1)
            <li class="treeview">
                <a href="#">        
                    <i class="fa fa-money"></i> <span> {{config('site_nav.bank.name')}} </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a  href="{{URL::to(config('site_nav.bank.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.bank.list')}}</a></li>
                    <li><a href="{{URL::to(config('site_nav.bank.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.bank.add')}}</a></li>
                </ul>
            </li> 
              @endif
            @endforeach
            @foreach(session()->get('permission') as $row)
                @if($row->module_id == 4 && $row->read_access == 1 )
                <li class="treeview">
                    <a href="#">        
                        <i class="fa fa-delicious"></i><span> {{config('site_nav.branch.name')}} </span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a  href="{{URL::to(config('site_nav.branch.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.branch.list')}}</a></li>
                        <li><a href="{{URL::to(config('site_nav.branch.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.branch.add')}}</a></li>
                    </ul>
                </li>
               @endif
            @endforeach
            @foreach(session()->get('permission') as $row)
                @if($row->module_id == 11 && $row->read_access == 1 )
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i> <span> {{config('site_nav.report.name')}} </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a  href="{{URL::to(config('site_nav.report.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.report.list')}}</a></li>

                </ul>
            </li>
             @endif
            @endforeach
            @if(Auth::user()->user_type == 1)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-institution"></i> <span> {{config('site_nav.office.name')}} </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{URL::to(config('site_nav.office.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.office.list')}}</a></li>
                            <li><a href="{{URL::to(config('site_nav.office.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.office.add')}}</a></li>
                        </ul>
                    </li>  

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-users"></i> <span> {{config('site_nav.users.name')}} </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{URL::to(config('site_nav.users.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.users.list')}}</a></li>
                            <li><a href="{{URL::to(config('site_nav.users.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.users.add')}}</a></li>
                        </ul>
                    </li> 

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-th-list"></i> <span> {{config('site_nav.module.name')}} </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{URL::to(config('site_nav.module.list_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.module.list')}}</a></li>
                            <li><a href="{{URL::to(config('site_nav.module.add_url'))}}"><i class="fa fa-circle-o"></i> {{config('site_nav.module.add')}}</a></li>
                        </ul>
                    </li> 

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-lock"></i> <span> User Permission </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{URL::to('/admin/users_permission/create')}}"><i class="fa fa-circle-o"></i>  Settings </a></li>
                        </ul>
                    </li> 
                </ul>
            </li>

            @endif;

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>