<?php 
require "database.blade.php";
function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }
if(!is_ajax_request()) { exit; }

$token = $_GET['token'];
$categorie = (!($_GET['category']) == "") ? 'WHERE categorie = "'.$_GET['category'].'"' : '';
$id = (!($_GET['id']) == "") ? 'AND id != "'.$_GET['id'].'"' : '';
if($id == ''){
   $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
   $offset = (($page - 1) * 3);
   $offset = ($offset == 1) ? 0 : $offset;
} else {
   $offset = 0;
   $categorie .= " ".$id;
}

$sql2 = "SELECT id, nume, pret, descriere, categorie, imagine_front FROM produs $categorie ORDER BY categorie, id LIMIT 3 OFFSET $offset";
$result2 = mysqli_query($database,$sql2);
$i = 1;
?>

<?php while($produs = mysqli_fetch_assoc($result2)): ?>
   <li class="product <?=($i==1) ? 'first' : 'last'?>" style="min-height: 600px;">
      <div class="product-outer">
         <div class="product-inner">
            <div class="product-image-wrapper">
               <a href="single-product-v1/<?= $produs["id"]?>" class="woocommerce-LoopProduct-link">
               <img src="<?=($id != '') ? '../' : ''?>images/products/<?= $produs["imagine_front"]?>" class="img-responsive" alt=""
               style="width: 300px; height: 300px;">
               </a>
            </div>
            <div class="product-content-wrapper">
               <a href="single-product-v1/<?= $produs["id"]?>" class="woocommerce-LoopProduct-link">
                  <h3><?= $produs["nume"]; ?></h3>
                  <div itemprop="description">
                     <p style="max-height: none;"><?= $produs["descriere"]; ?></p>
                  </div>
                  <div  class="yith_wapo_groups_container">
                     <div  class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio">
                        <h3><span><?= $produs["categorie"]; ?></span></h3>
                        <div class="ywapo_input_container ywapo_input_container_radio">
                           <span class="ywapo_label_price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span><?= $produs["pret"] ?></span></span>
                        </div>                                          
                     </div>
                  </div>
               </a>
               <div class="hover-area">
                  <form action="<?= $produs['id']; ?>" method="post" enctype='multipart/form-data'>
                     <input type="hidden" name="_token" value="<?= $token; ?>">
                     <input type="hidden" name="id" value="<?= $produs['id']; ?>">
                     <input type="hidden" name="price" value="<?= $produs['pret'] ?>">
                     <input type="hidden" name="quantity" value="1">
                     <button type="submit" name="submit" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Add to cart</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- /.product-outer -->
   </li>
<?php $i++;
 endwhile ?>