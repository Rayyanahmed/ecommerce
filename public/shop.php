<?php require_once("./resources/config.php"); ?>

<?php include (TEMPLATE_FRONT . DS . "header.php"); ?>
    
    <!-- This page is going to display ALL of our products regardless of category -->
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header>
            <h1>Shop</h1>
        </header>

        <hr>

        <!-- Title -->
        <!-- Try to sort this by timestamps at one point -->
        <div class="row">
            <div class="col-lg-12">
                <h3>All Products</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php get_shop_products(); ?>

        </div>
        <!-- /.row -->

        <hr>

  

    </div>
    <!-- /.container -->


<?php include (TEMPLATE_FRONT . DS . "footer.php"); ?>