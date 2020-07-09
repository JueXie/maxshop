<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">

    <div class="menu_dropdown bk_2">
        <dl id="menu-article">
            <dt @yield('sidebar1')><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd @yield('sidebar1-1')>
                <ul>
                    <li @yield('sidebar1-1-1')><a href="article-list.html" title="资讯管理">资讯管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-picture">
            <dt @yield('sidebar2')><i class="Hui-iconfont">&#xe613;</i> 媒体管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd @yield('sidebar2-1')>
                <ul>
                    <li @yield('sidebar2-1-1')><a href="/admin/media/management" title="媒体管理">媒体管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-product">
            <dt @yield('sidebar3')><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd @yield('sidebar3-1')>
                <ul>
                    <li @yield('sidebar3-1-1')><a href="product-brand.html" title="品牌管理">品牌管理</a></li>
                    <li @yield('sidebar3-1-2')><a href="/admin/category-list" title="分类管理">分类列表</a></li>
                    <li @yield('sidebar3-1-3')><a href="/admin/product-list" title="产品管理">产品列表</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-comments">
            <dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="http://h-ui.duoshuo.com/admin/" title="评论列表">评论列表</a></li>
                    <li><a href="feedback-list.html" title="意见反馈">意见反馈</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="member-list.html" title="会员列表">会员列表</a></li>
                    <li><a href="member-del.html" title="删除的会员">删除的会员</a></li>
                    <li><a href="member-level.html" title="等级管理">等级管理</a></li>
                    <li><a href="member-scoreoperation.html" title="积分管理">积分管理</a></li>
                    <li><a href="member-record-browse.html" title="浏览记录">浏览记录</a></li>
                    <li><a href="member-record-download.html" title="下载记录">下载记录</a></li>
                    <li><a href="member-record-share.html" title="分享记录">分享记录</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="admin-role.html" title="角色管理">角色管理</a></li>
                    <li><a href="admin-permission.html" title="权限管理">权限管理</a></li>
                    <li><a href="admin-list.html" title="管理员列表">管理员列表</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-tongji">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="charts-1.html" title="折线图">折线图</a></li>
                    <li><a href="charts-2.html" title="时间轴折线图">时间轴折线图</a></li>
                    <li><a href="charts-3.html" title="区域图">区域图</a></li>
                    <li><a href="charts-4.html" title="柱状图">柱状图</a></li>
                    <li><a href="charts-5.html" title="饼状图">饼状图</a></li>
                    <li><a href="charts-6.html" title="3D柱状图">3D柱状图</a></li>
                    <li><a href="charts-7.html" title="3D饼状图">3D饼状图</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-system">
            <dt @yield('sidebar8')><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd @yield('sidebar8-1')>
                <ul>
                    <li @yield('sidebar8-1-1')><a href="/admin/shipping" title="运费设置">运费设置</a></li>
                    <li @yield('sidebar8-1-2')><a href="/admin/payment" title="支付设置">支付设置</a></li>
                    <li><a href="system-data.html" title="数据字典">数据字典</a></li>
                    <li><a href="system-shielding.html" title="屏蔽词">屏蔽词</a></li>
                    <li><a href="system-log.html" title="系统日志">系统日志</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->
