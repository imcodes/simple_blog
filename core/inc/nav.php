
    <header class="custom-header">
        <div class="logo">
            <img class='white-mono' src="<?= SITE_LOGO ?>" alt="Official Logo">
        </div>
        <div class="navs">
            <nav class="main-nav">
                <ul>
                    <li><a href="/blog_demo">Home</a></li>
                    <li><a href="#">Sports</a></li>
                    <li><a href="#">Entertainment</a></li>
                    <li><a href="#">Politics</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><form action="" id="searchForm" class='mt-2'>
                    <div class="input-group">
                        <input type="search" id="search" name="search" placeholder="Search for News..." class="form-control" id="">
                        <div class="bg-white px-2 input-group-prepend">
                            <i class=" form-addon fa fa-search text-dark" aria-hidden="true"></i>
                        </div>
                    </div>
                </form></li>
                </ul>
             
            </nav>
            <nav class="auth-nav">
                <?php if(isUserLoggedIn()){ //Loged in user option
                     ?>
                <ul>
                    <li class='dropdown' >
                    <a href="" class="dropdown-toggle" data-bs-toggle="dropdown">Hi, <?= ucwords($_SESSION['user']['username']) ?></a>
                    <ul class="dropdown-menu logged-in">
                        <li><a href="dashboard/" class="dropdown-item"> <i class="lni lni-dashboard"></i> Dashboard</a></li>
                        <li><a href="auth/logout.php" class="dropdown-item"><i class='fa-solid fa-arrow-right-from-bracket'></i> Logout</a></li>
                    </ul>
                    </li>
                </ul>
                <?php }else{//Guest menu option
                    ?>
                    <ul>
                    <li><a href="auth">Login</a></li>
                    <li><a href="auth/register">Register</a></li>
                </ul>
                <?php
                }?>
            </nav>
        </div>

        <button class="mobile-icon btn btn-link text-white"><i class="lni lni-menu"></i></button>
    </header>

    <script>
        let micon = document.querySelector('.mobile-icon')
        micon.onclick = (e) => {
            icon = e.target//.querySelector('i.lni')
            if(icon.classList.contains('lni-menu')){
                icon.classList.remove('lni-menu')
                icon.classList.add('lni-close')
            }
            else if(icon.classList.contains('lni-close')){
                icon.classList.remove('lni-close')
                icon.classList.add('lni-menu')
            }
            
            let nav = document.querySelector('.navs')
            nav.classList.toggle('open')
        }
    </script>