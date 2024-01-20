
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
                </ul>
             
            </nav>
            <nav class="auth-nav">
                <ul>
                    <li><a href="auth">Login</a></li>
                    <li><a href="auth/register">Register</a></li>
                </ul>
            </nav>
        </div>

        <button class="mobile-icon">Menu</button>
    </header>

    <script>
        let micon = document.querySelector('.mobile-icon')
        micon.onclick = () => {
            let nav = document.querySelector('.navs')
            nav.classList.toggle('open')
        }
    </script>