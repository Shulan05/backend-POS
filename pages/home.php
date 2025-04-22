<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://vatvostudio.vn/wp-content/uploads/2023/01/Galaxy-S23-series-lo-poster-truoc-ngay-ra-mat-4.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/34b5bf180145769.6505ae7623131.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://i.ytimg.com/vi/amJT0Nq6yy0/maxresdefault.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container">
<h1 class="my-3">Feature Product</h1>
<div class="row ">


<?php
                $manage_products = getProducts();
                if ($manage_products !== null) {
                    while ($row = $manage_products->fetch_object()) {
                ?>
<div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex justify-content-center">
<div class="card" style="width: 18rem; ">
<img src="assets/images/<?php echo $row->image ?>" class="card-img-top" alt="Product Image">

  <div class="card-body">
    <h5 class="card-title"><?php echo $row->name?></h5>
    <p class="card-text"><?php echo $row->price?></p>
    <p class="card-text"><?php echo $row->short_desc?></p>
    <a href="./?page=cart/create&id=<?php echo $row->id_product?>" class="btn btn-primary">Add to Card</a>
  </div>
</div>
</div>




<?php
                    }
                }
                ?>
  
  </div>

</div>