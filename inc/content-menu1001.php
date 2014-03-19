<?php

error_reporting(E_ALL);
//error_reporting(0);


$postId = get_the_ID();

switch ($postId) {
	case '91': //Menu
		$idCarte = '350812';
		break;
	case '201': //Menu
		$idCarte = '350812';
		break;	
	case '93': //carte vin
		$idCarte = '352792';
		break;
	case '203': //carte vin
		$idCarte = '352792';
		break;	
	//case '95': // boisson ??????
	//	$idCarte = '350822';
	//	break;
	default:
		$idCarte = '350812';
		break;
}

define('API_USERNAME', 'food2vous');
define('API_PASSWORD', 'e285af236dbc740f1b1d50d3f8904f96d2158ba2');
define('ID_CARTE', $idCarte);
define('ID_RESTO', '333832');
//$resto = getRestaurant(ID_RESTO);

function getRestaurant($id) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_URL, "http://api.mobimenu.fr/restaurant/".$id.".xml");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/xml"));
	curl_setopt($ch, CURLOPT_USERPWD, API_USERNAME.":".API_PASSWORD);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	$output = curl_exec($ch);
	//$output = str_replace("<description>", "<description><![CDATA[", $output);
	//$output = str_replace("</description>", "]]></description>", $output);
	if($output === false || !$output)
		error_log(curl_error($ch));        
	else
	{
		$xml = simplexml_load_string($output);
		return $xml->restaurant;
	}
	return false;
}

//
function getMenu($menu_id) {
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
   curl_setopt($ch, CURLOPT_URL, "http://api.mobimenu.fr/menu/".$menu_id);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/xml"));
   curl_setopt($ch, CURLOPT_USERPWD, API_USERNAME.":".API_PASSWORD);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
   $output = curl_exec($ch);
   if($output === false)
   {
	   error_log(curl_error($ch));
   }
   else
   {
	   $xml = simplexml_load_string($output);
	   $menu = $xml->menu; 
	   $restaurant_light = $menu->restaurant;
   }
   curl_close($ch);
   return array ($menu, $restaurant_light);
}

$menu = array(ID_CARTE);

function displayMenuWeb($menu, $restaurant) {
	?>  
	<section class="menu">
	<?php if(isset($menu) && (!empty($menu))):
		foreach($menu as $currentmenu): ?>
			<header>
				<span class="title">
					<?php // echo $currentmenu->title; ?>
					<?php if ($currentmenu->price && $currentmenu->price > 0) :?>
						<div class="menu-price"><?php echo $currentmenu->price."&euro;"; ?></div>
					<?php endif; ?>
				</span>		  			
			</header>
			<?php if ($currentmenu->description && $currentmenu->description != "") :?>
				<div class="menu-description"><?php echo $currentmenu->description; ?></div>
			<?php endif; ?>
			<div class="menu-presentation">
			<?php
			foreach($currentmenu->category as $category) {
				?>  
				<div id="cat<?php echo $category->categoryid; ?>" class="menu-presentation-categorie">
					<div class="menu-titre-cat">
						<div>
							<h2><?php echo $category->label; ?></h2>
							<?php
							if ($category->price && $category->price > "0") {
							?>
							<div class="cat-price"><?php echo $category->price."&euro;"; ?></div>
							<?php 
							}
							?>
						</div>
<!-- 						<?php if ($category->description && $category->description != "") :?>
							<div class="cat-description"><?php echo $category->description; ?></div>
						<?php else: ?>
							<div class="cat-description">***</div>
							<?php endif; ?> -->
					</div>
					<div class="menu-sous-cat-container">
					<?php
					if (isset($category->subcategory)) 
					{
						foreach($category->subcategory as $subcategory) 
						{
							?>
							<div class="menu-titre-sous-cat">
								<div>
									<h3 title="<?php echo $subcategory->label; ?>"><?php echo $subcategory->label; ?>  
										<?php if (isset($subcategory->price) && $subcategory->price > "0") { ?>
											<span class="sous-cat-price"> : <?php echo $subcategory->price."&euro;"; ?></span>
										<?php } ?>
									</h3>
								</div>
<!-- 								<?php if ($subcategory->description && trim($subcategory->description) != ""):?>
									<div class="sous-cat-description"><?php echo $subcategory->description; ?></div>
								<?php else:?>
									<div class="sous-cat-description">***</div>
								<?php endif;?> -->
							</div>                  
							<?php
							if (isset($subcategory->dishes))
							{
								?>
								<table class="menu-liste">
									<tr><td></td><td></td><td></td><td></td></tr>
									<?php
									foreach($subcategory->dishes->dish as $dish) {
										displayDishWeb($dish, $restaurant);		                                
									}
									?>
								</table>                           
								<?php
							}		                    
						}
					}
					if (isset($category->dishes))
					{
						?>
						<table class="menu-liste">
							<td ></td>
							<td ></td>
							<td ></td>
							<td ></td>
						<?php
						foreach($category->dishes->dish as $dish) {
							displayDishWeb($dish, $restaurant);		                    
						}
						?>
						</table>                           
						<?php
					}
					?>
					</div>
				</div>          
				<?php       		        
			}
			if (isset($currentmenu->dishes)) :
					?>
					<table class="menu-liste">
						<!-- <tr>
							<td class="dish"></td>
							<td class="price-dish"></td>
							<td class="price-2eme-dish"></td>
							<td class="price-3eme-dish"></td>
						</tr> -->
					<?php
					foreach($currentmenu->dishes->dish as $dish) :
						displayDishWeb($dish, $restaurant);
					endforeach;
					?>
					</table>                           
					<?php
			endif;
			?>
			</div>
			<!--[if !IE]>--><div class="shadow"></div><!--<![endif]-->
			
		<?php endforeach;
	endif;?>
	</section>
	<?php
}

function displayDishWeb ($dish, $restaurant) {
	$i = 4;
	if($dish->price && $dish->price > "0") $i--;
	if($dish->price_2 && $dish->price_2 > "0") $i--;
	if($dish->price_3 && $dish->price_3 > "0") $i--;
	?>
	<tr id="dish<?php echo $dish->dishid; ?>">
		<td colspan="<?php echo $i; ?>" class="dish <?php echo "menu-colspan-".$i ?> ">
			<span class="dish-label"><?php echo $dish->label; ?></span>
			<?php if ($dish->description && $dish->description != "") : ?>
				<div class="dish-description"><?php echo $dish->description; ?></div>
			<?php endif; ?>        	
		</td><!--
	--><td class="price-dish">
			<?php if ($dish->price && $dish->price > "0") : ?>
			<div class="dish-price-block">
				<span class="dish-price-label"><?php if ($dish->price_label && $dish->price_label != "") echo $dish->price_label;?></span>
				<br />
				<span><?php echo $dish->price."&euro;"; ?></span>
			</div>
			<?php endif; ?>
		</td><!--
	--><?php if (($dish->price_label_2 && $dish->price_label_2 != "") || ($dish->price_2 && $dish->price_2 > "0")): ?><!--
	--><td class="price-2eme-dish">
			<div class="dish-price-block">
				<span class="dish-price-label">
					<?php
					if ($dish->price_label_2 && $dish->price_label_2 != "") echo $dish->price_label_2;
					else echo ' - ';
					?>
				</span>
				<br />
				<span><?php if ($dish->price_2 && $dish->price_2 > "0") echo $dish->price_2."&euro;";?></span>
			</div>
		</td><!--
	--><?php endif; ?><!--
	--><?php if (($dish->price_label_3 && $dish->price_label_3 != "") || ($dish->price_3 && $dish->price_3 > "0")): ?><!--
	--><td class="price-3eme-dish">
			<div class="dish-price-block">
				<span class="dish-price-label">
					<?php
					if ($dish->price_label_3 && $dish->price_label_3 != "") echo $dish->price_label_3;
					else echo ' - ';
					?>
				</span>
				<br />			
				<span><?php if ($dish->price_3 && $dish->price_3 > "0") echo $dish->price_3."&euro;";?></span>
			</div>
		</td>
		<?php endif; ?>	
	</tr>    	
	<?php
}

?>