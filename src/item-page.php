<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>MyAmazon Store 3.0</title>
    <link rel="stylesheet" href="style/css-all.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/item-style.css">
</head>

<body>
  <?php include "include/header.php";
        include "include/catelogry-list.php";
        include "include/db_credentials.php";
  ?>

    <main>

        <article id="item-bar">
            <div id="main-content-itempage">
                <h2 id="item-page-itemname">2014 Mazda 3</h2>
                <figure>
                    <img src="images/example-mazda3.jpg" alt="">
                </figure>

                <div id="container-description-price">
                    <p id="description-itempage">Description:<br> Lorem ipsum dolor sit amet, quod quodsi apeirian id
                        his. Epicuri adipisci duo ex, eros commodo sapientem his ut, alterum vituperata has an. Adhuc
                        mucius est an, eu his illum iusto. Purto dissentias ei per, summo labitur postulant ad nec.
                        Veri doming eos eu, eam semper vivendo efficiantur ad, ad ius tractatos voluptaria. Nec ei
                        option comprehensam, mea tale numquam ne.

                        Sed diam iudico tincidunt eu, te mel omnis laoreet. Eripuit accumsan corrumpit in ius, fabulas
                        saperet intellegat sed ut. Modo sonet mea ea, ne veniam vidisse singulis cum. An est eruditi
                        menandri, laudem persius sententiae an mea. Mel novum malorum suscipit ad.

                        Mei omnesque repudiandae vituperatoribus an, in nec dicit altera, an sed scripta vivendum
                        maluisset. Ut idque adversarium eum. Odio offendit voluptaria cu est, assum apeirian scripserit
                        est ad. Nihil euismod definiebas vim at, mei commodo impedit ad.

                        At mei legere regione similique, no sit inermis voluptatum, inani iuvaret scribentur vel ut.
                        Tantas latine scribentur eum eu, dicit veniam maluisset ut cum. Illum audire mnesarchum ut nec,
                        elit choro id sea, mel no noster mnesarchum. Ea cum veniam viderer antiopam, duo veri
                        deseruisse scribentur te, velit aperiam quo ne. Ex cum autem harum eirmod, ad vim discere
                        invidunt.

                        Verear tacimates corrumpit eum cu, mentitum salutatus eu sea. Nam at quodsi dissentiet, ipsum
                        mundi vix at. Soleat noster erroribus at his, sea ex inciderint necessitatibus, illud dicam
                        reprehendunt per eu. Eius propriae posidonium et vim. Vix in commodo molestiae. Vim option
                        recusabo eu, eu vel mentitum conclusionemque.
                    </p>
                    <p id="price-itempage">Price: $11500</p>

                </div>

                <button type="button" class="btn-item-page">Add to Cart </button>
            </div>
            <div id="comments-itempage">
                <!-- <hr> -->
                <p id="comment">Comments</p>

                <div class="comment-template">

                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                        fames ac turpis egestas.
                        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                        sit amet quam
                        egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                    </span>
                </div>

                <div class="comment-template">
                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                        fames ac turpis
                        egestas.
                    </span>
                </div>

                <div class="comment-template">

                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                        fames ac turpis egestas.
                        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                        sit amet quam
                        egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                    </span>
                </div>

                <div class="comment-template">
                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                        fames ac turpis
                        egestas.
                    </span>
                </div>

                <div class="comment-template">

                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                        fames ac turpis egestas.
                        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                        sit amet quam
                        egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                    </span>
                </div>

                <div class="comment-template">
                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum."
                    </span>
                </div>

                <div class="comment-template">

                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">Pellentesque habitant morbi tristique senectus et netus et malesuada
                        fames ac turpis egestas.
                        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                        sit amet quam
                        egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                    </span>
                </div>

                <div class="comment-template">
                    <span class="user-id">Lorem:</span>
                    <span class="user-comment">"But I must explain to you how all this mistaken idea of denouncing
                        pleasure and praising pain was born and I will give you a complete account of the system, and
                        expound the actual teachings of the great explorer of the truth, the master-builder of human
                        happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but
                        because those who do not know how to pursue pleasure rationally encounter consequences that are
                        extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of
                        itself, because it is pain, but because occasionally circumstances occur in which toil and pain
                        can procure him some great pleasure. To take a trivial example, which of us ever undertakes
                        laborious physical exercise, except to obtain some advantage from it? But who has any right to
                        find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one
                        who avoids a pain that produces no resultant pleasure?"
                    </span>
                </div>
            </div>
            <!-- <hr> -->
            <div id="ur-comment">
                <p id="write-ur-comment">write your comment:</p>
                <form id="ur-comment-form">
                    <input type="textarea" name="ur-comment-textarea"rows="6" cols="70">
                    <input type="button" name="submit" value="submit">
                </form>
            </div>
        </article>

    </main>
    <footer>
        <a href="#top" id="back-to-top">Back to Top</a>
        <div id="about-us">
            <p>About Us</p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                    Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        </div>
        <div class="top-border">
            <div id="contact-us">
                <p>Contact Us</p>
                <p>Email: <a href="#">aa@a.com</a></p>
                <p>Tel: <a href="#">111.222.3333</a></p>
            </div>
        </div>
        <div class="top-border" id="copyright">
            <p>Copyright &copy; 2018 Project</p>
        </div>
    </footer>
</body>

</html>
