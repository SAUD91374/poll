<nav class="navbar navbar-expand-lg" aria-label="Fifth navbar example">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="<?= asset('assets/images/Poll.png" alt="Poll.png');?>" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample05">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link navbar_optine" aria-current="page" href="/"
                                style="font-family: Rajdhani; font-size: 18px; font-weight: 500; color:#000000;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navbar_optine" href="create_poll"
                                style="font-family: Rajdhani; font-size: 18px; font-weight: 500; color:#000000;">Create
                                Poll</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link navbar_optine" href="create_image_poll"
                                style="font-family: Rajdhani; font-size: 18px; font-weight: 500; color:#000000;">Create
                                Poll 2</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link navbar_optine" href="vote_page"
                                style="font-family: Rajdhani; font-size: 18px; font-weight: 500; color:#000000;">Vote
                                Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="images_vote_page"><button type="button"
                                    class="header_button">Vote Page 2</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="multiple_vote_page"><button
                                    type="button" class="header_button_blue">Vote Page 3</button></a>
                        </li>


                        <li class="nav-item social-icons ">
                            <a class="nav-link" href="#"><i class="bi bi-facebook social_icon"></i></a>
                        </li>
                        <li class="nav-item social-icons">
                            <a class="nav-link" href="#"><i class="bi bi-instagram social_icon"></i></a>
                        </li>
                        <li class="nav-item social-icons">
                            <a class="nav-link" href="#"><i class="bi bi-twitter social_icon"></i></a>
                        </li>
                        <li class="nav-item social-icons">
                            <a class="nav-link" href="#"><i class="bi bi-linkedin social_icon"></i></a>
                        </li>

                        <span class="hidden_icon">
                        <a class="nav-link " href="#"><i class="bi bi-facebook social_icon"></i></a>
                        <a class="nav-link ms-3" href="#"><i class="bi bi-instagram social_icon"></i></a>
                        <a class="nav-link ms-3" href="#"><i class="bi bi-twitter social_icon"></i></a>
                        <a class="nav-link ms-3" href="#"><i class="bi bi-linkedin social_icon"></i></a>
                        </span>


                    </ul>
                </div>
            </div>
        </nav>
