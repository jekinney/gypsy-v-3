<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::segment(2) === null ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{ Request::segment(2) === 'blog' ? 'active' : '' }}">
                <a role="button">
                    <i class="fa fa-th-large"></i>
                    <span>Blog</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.blog.article.create') }}"><i class="fa fa-circle-o"></i> Create Article</a></li>
                    <li><a href="{{ route('admin.blog.article.unpublished.list') }}"><i class="fa fa-circle-o"></i> Unpublished/Draft Articles</a></li>
                    <li><a href="{{ route('admin.blog.article.published.list') }}"><i class="fa fa-circle-o"></i> Published Articles</a></li>
                    <li><a href="{{ route('admin.blog.category.list') }}"><i class="fa fa-circle-o"></i> Manage Categories</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::segment(2) === 'market' ? 'active' : '' }}">
                <a role="button">
                    <i class="fa fa-globe"></i>
                    <span>Markets</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.market.index') }}"><i class="fa fa-circle-o"></i> List of All Markets</a></li>
                    <li><a href="{{ route('admin.market.create') }}"><i class="fa fa-circle-o"></i> Create New Market</a></li>
                    <li><a href="{{ route('admin.market.create') }}"><i class="fa fa-circle-o"></i> Manage Market Types</a></li>
                </ul>
            </li>
            <li class="{{ Request::segment(2) === 'gallery' ? 'active' : '' }}">
                <a href="">
                    <i class="fa fa-camera"></i> <span>Image Gallery</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) === 'notifications' ? 'active' : '' }}">
                <a href="">
                    <i class="fa fa-bell"></i> <span>Notifications</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) === 'newsletter' ? 'active' : '' }}">
                <a role="button">
                    <i class="fa fa-bullhorn"></i>
                    <span>Newsletter</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) === 'users' ? 'active' : '' }}">
                <a role="button">
                    <i class="fa fa-user"></i>
                    <span>Manage Users</span>
                </a>
            </li>
        </ul>
    </section>
</aside>