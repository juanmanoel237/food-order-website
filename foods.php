<?php include('partiels-front/menu.php'); ?>

<!-- Section Recherche Nourriture -->
<section class="food-search text-center">
  <div class="container">
    <form action="food-search.html" method="POST">
      <input type="search" name="search" placeholder="Search for Food.." required />
      <input type="submit" name="submit" value="Search" class="btn btn-primary" />
    </form>
  </div>
</section>
<!-- fin Section Recherche Nourriture -->

<!-- Section Menu Nourriture -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Food Menu</h2>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Food Title</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-burger.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Smoky Burger</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-burger.jpg" alt="Chicke Hawain Burger" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Nice Burger</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Food Title</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order
          Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Food Title</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="food-menu-box">
      <div class="food-menu-img">
        <img src="images/menu-momo.jpg" alt="Chicke Hawain Momo" class="img-responsive img-curve" />
      </div>

      <div class="food-menu-desc">
        <h4>Chicken Steam Momo</h4>
        <p class="food-price">$2.3</p>
        <p class="food-detail">
          Made with Italian Sauce, Chicken, and organice vegetables.
        </p>
        <br />

        <a href="#" class="btn btn-primary">Order Now</a>
      </div>
    </div>

    <div class="clearfix"></div>
  </div>
</section>
<!-- Fin Section Menu Nourriture -->

<?php include('partiels-front/footer.php'); ?>