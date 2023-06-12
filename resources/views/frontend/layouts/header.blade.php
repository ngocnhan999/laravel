<header id="header" class="transparent-header" data-sticky-class="not-dark">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
            <!-- Logo ============================================= -->
            <div id="logo" class="clearfix">
                <a href="{!! url('/') !!}" class="standard-logo float-left"
                   data-dark-logo="images/logo-light.png">
                    <img src="{!! asset('frontend/images/logo-light.png') !!}" width="180" alt="Vietseeds">
                </a>
                <a href="{!! url('/') !!}" class="retina-logo float-left"
                   data-dark-logo="images/logo-light.png">
                    <img src="{!! asset('frontend/images/logo-light.png') !!}" alt="Vietseeds"/>
                </a>
                <!-- language -->
                <div id="language">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="{!! asset('frontend/images/vi.gif') !!}" alt="VIE"> VIE
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <img src="{!! asset('frontend/images/vi.gif') !!}" alt="VIE"> VIE
                        </a>
                        <a class="dropdown-item" href="#">
                            <img src="{!! asset('frontend/images/en.gif') !!}" alt="VIE"> EN
                        </a>
                    </div>
                </div>
                <!-- #language end -->
            </div><!-- #logo end -->
            <!-- Primary Navigation ============================================= -->
            <nav id="primary-menu" class="">
                <ul>
                    <li>
                        <a href="#">
                            Về chúng tôi
                        </a>
                        <ul>
                            <li>
                                <a href="https://www.vietseeds.org/vi/about-us/vision-and-mission">
                                    Tầm nhìn & Sứ mệnh
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/about-us/our-journey">
                                    Hành Trình Phát Triển
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/about-us/our-team">
                                    Đội ngũ sáng lập
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/about-us/foundation-documents">
                                    Tài liệu tổ chức
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            Học bổng
                        </a>
                        <ul>
                            <li>
                                <a href="https://www.vietseeds.org/vi/scholarships/financial-support">
                                    Hỗ trợ tài chính
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/scholarships/training-program">
                                    Chương trình đào tạo
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/scholarships/mentoring-program">
                                    Chương trình Mentor
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            Dự án
                        </a>
                        <ul>
                            <li>
                                <a href="https://www.vietseeds.org/vi/projects/vietseeds-hue">
                                    VietSeeds - Huế
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/projects/vietseeds-snap-learning">
                                    VietSeeds Snap Learning
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/projects/upskilling-vietnam">
                                    UpSkilling Vietnam
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/projects/hsbc-business-case-competition">
                                    HSBC Business Case Competition
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/projects/fulbright">
                                    HSBC Business Case Competition
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <div>Sinh viên VietSeeds</div>
                        </a>
                        <ul>
                            <li>
                                <a href="https://www.vietseeds.org/vi/our-students/current-students">
                                    <div>Sinh viên đang nhận học bổng</div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/our-students/alumni">
                                    <div>Trở thành sinh viên VietSeeds</div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/our-students/become-our-student">
                                    <div>Cựu sinh viên</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">
                            <div>Nhà tài trợ</div>
                        </a>
                        <ul>
                            <li>
                                <a href="https://www.vietseeds.org/vi/sponsor/individual-sponsor">
                                    Tài trợ cá nhân
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/sponsor/corporate-sponsor">
                                    Tài trợ doanh nghiệp
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">
                            <div>Mentor</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{!! route('mentor.register') !!}">
                                    Đăng ký Mentor
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('mentor.login') !!}">
                                    Đăng nhập Mentor
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/mentor/be-a-mentor">
                                    Để trở thành Mentor
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/mentor/our-mentors">
                                    <div>Mentor hiện tại</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">
                            <div>Tin tức</div>
                        </a>
                        <ul>
                            <li>
                                <a href="https://www.vietseeds.org/vi/news-and-blog/training">
                                    Chương trình Đào tạo
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/news-and-blog/events">
                                    Sự kiện
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/news-and-blog/vietseeds-plus">
                                    VietSeeds+
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/news-and-blog/vietseeds-community">
                                    <div>Cộng đồng VietSeeds</div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/news-and-blog/newsletter">
                                    Newsletter
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/news-and-blog/mentorship">
                                    Chương trình Mentor
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vietseeds.org/vi/news-and-blog/seed-recruitment">
                                    Tuyển sinh
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="https://www.vietseeds.org/vi/contact/individual-sponsor">
                            Liên hệ>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('dashboard.index') !!}" class="other">
                            <div>Đóng góp admin</div>
                        </a>
                    </li>
                </ul>
            </nav><!-- #primary-menu end -->
        </div>
    </div>
</header>
