 <?php 
require_once 'config.php';

$articulos = mysqli_query($mysqli,"select * from productos where cprov = 'YGH';");
while($articulo = mysqli_fetch_array($articulos)){
echo '<div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="single-product.html">
                                                <img class="img-fluid" src="',$articulo['imagen'],'" alt="',$articulo{'descripcion'},'">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Vista Rapida
                                                </a>
                                                <a class="item-mail" href="javascript:void(0)">chat</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">agregar a lista de deseos</a>
                                                <a class="item-addCart" href="javascript:void(0)">agregar al carrito</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="shop-v1-root-category.html">',$articulo['categoria'],'</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="shop-v2-sub-category.html">',$articulo['subcategoria'],'</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="single-product.html">',$articulo{'descripcion'},'</a>
                                                </h6>
                                                <div class="item-stars">
                                                    inventario
                                                    <span>(1)</span>
                                                </div>
                                            </div>
                                            <div class="price-template">
                                                <div class="item-new-price">
                                                   ',$articulo{'pv2'},'
                                                </div>
                                                <div class="item-old-price">
                                                    $120.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>';
}
?>