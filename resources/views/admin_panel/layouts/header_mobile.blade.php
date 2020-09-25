<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                control panel
                <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                </button>
            </div>
        </div>
    </div>

    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">

                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>الاستعارة</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{route('borrow.setitem')}}">تسجيل استعارة جديدة</a>
                        </li>
                        <li>
                            <a href="{{route('borrow.index')}}">إدارة الاستعارات</a>
                        </li>
                        <li>
                            <a href="{{route('borrow_state.index')}}">إدارة حالات الاستعارات</a>
                        </li>

                        <li>
                            <a href="{{route('borrow.extend.all')}}">طلبات تمديد الاستعارة</a>
                        </li>

                    </ul>
                </li>

                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>المستخدمون</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{route('user.create')}}">إضافة مستخدم جديد</a>
                        </li>
                        <li>
                            <a href="{{route('user.index')}}">إدارة المستخدمين</a>
                        </li>
                        <li>
                            <a href="{{route('role.index')}}">إدارة أدوار المستخدمون</a>
                        </li>

                        <li>
                            <a href="{{route('user.add_user_request')}}"> طلبات تسجيل العضوية </a>
                        </li>

                    </ul>
                </li>


                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>عناصر المكتبة</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{route('item.create')}}">إضافة عنصر جديد</a>
                        </li>
                        <li>
                            <a href="{{route('item.index')}}">إدارة العناصر</a>
                        </li>

                        <li>
                            <a href="{{route('item_type.index')}}">إدارة أنواع العناصر</a>
                        </li>
                        <li>
                            <a href="{{route('item_state.index')}}">إدارة أنواع حالات العناصر</a>
                        </li>
                        <li>
                            <a href="{{route('tag.index')}}">إدارة ال tags</a>
                        </li>

                        <li>
                            <a href="{{route('item.add_item_request')}}">طلبات إضافة العناصر</a>
                        </li>

                    </ul>
                </li>


                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>الأشخاص</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{route('maintainer.create')}}">إضافة دكتور مشرف جديد</a>
                        </li>
                        <li>
                            <a href="{{route('maintainer.index')}}">إدارة الدكاترة المشرفين</a>
                        </li>
                        <li>
                            <a href="{{route('author.create')}}">إضافة مؤلف جديد</a>
                        </li>
                        <li>
                            <a href="{{route('author.index')}}">إدارة المؤلفون</a>
                        </li>
                    </ul>
                </li>


                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>المواد</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{route('subject.create')}}">إضافة مادة جديدة</a>
                        </li>
                        <li>
                            <a href="{{route('subject.index')}}">إدارة المواد</a>
                        </li>
                        <li>
                            <a href="{{route('academic_year.index')}}">إدارة السنوات الدراسية</a>
                        </li>
                        <li>
                            <a href="{{route('specialize.index')}}">إدارة الاختصاصات</a>
                        </li>
                    </ul>
                </li>

                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>إعدادات الموقع</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{route('site_setting.create')}}">إضافة إعداد جديد</a>
                        </li>
                        <li>
                            <a href="{{route('site_setting.index')}}">إدارة الإعدادات</a>
                        </li>
                    </ul>
                </li>







            </ul>
        </div>
    </nav>
</header>
