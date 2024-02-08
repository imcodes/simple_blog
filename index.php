<?php 
require_once "init.php";
use \Model\User;
$user = new User();
$post = new Model\Post();
$userlist = $user->getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= SITE_FAVICON ?>" type="image/x-icon">
    <title>Awesome Blog</title>
    <?php require_once "core/inc/_header_script.php"; ?>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/news.css">
</head>
<body>
    <?php require_once "core/inc/nav.php"; ?>
    
    <section class="news-list-container py-5">
        <div class="container">
            <aside id="searchKeyword" class="py-3 lead">Showings Articles with keywords: <span></span></aside>
            <div class="row card-groups g-4" id="news-list">
                <!-- Dynamic content from Javascript here -->
            </div>
        </div>
    </section>
    <!-- News detail Modal Template -->
    

    <!-- Font awesome script -->
    <!-- <script src="https://kit.fontawesome.com/7cfae44c46.js" crossorigin="anonymous"></script> -->
   
    <!-- Moment script -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script> -->

    
<?php require_once "core/inc/_footer_script.php"; ?>

<!-- Custom scritp -->
<script type="module">
        import {News} from './assets/js/news.js'
        const proxyUrl = "https://cors-anywhere.herokuapp.com/"
        // const url = `${proxyUrl}https://newsapi.org/v2/everything?sortBy=publishedAt`
        const url = `<?= SITE_URL.'api/getpost?' ?>`
        const N = new News(url,'d1ab8e0e75c641d98fb7dd3c6756e7ba','blockchain')
        

        N.getNewsList()
        const nlist = document.getElementById('news-list')
        const skwd = document.querySelector('#searchKeyword > span')
        N.displayNewsList(nlist).then( output => {
            N.handlePop(output)
        })

        //display the active search keyword on the webpage
        skwd.innerHTML = N.getKeyword();
        
        // Handle the Search Opeartion
        const searchF = document.getElementById('searchForm')
        searchF.onsubmit = e => {
            e.preventDefault() //ignore the default behaviour of the form submit (prevents the form submission)
            const s = document.getElementById('search').value
            if(s == '') {
                alert('Search input must not be empty')
                return false
            }

            N.setKeyword(s) //set the user search keyword for the news object
            N.getNewsList() //get newlist again for the new set keyword
            skwd.innerHTML = N.getKeyword();
            const HtmlOuptut = N.displayNewsList(nlist)

            HtmlOuptut.then((tag)=>{
                N.handlePop(tag)
            })
        }

    </script>
</body>
</html>