<h1>Shopping cart</h1>

<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) >= 1): ?>
<table>
	<tr>
		<th>Image</th>
		<th>Name</th>
		<th>Price</th>
		<th>Units</th>
		<th>Remove</th>
	</tr>
	<?php 
		foreach($cart as $index => $element): 
		$product = $element['product'];
	?>
	
	<tr>
		<td>
			<?php if ($product->image != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $product->image ?>" class="img_cart" />
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/shirt.png" class="img_cart" />
			<?php endif; ?>
		</td>
		<td>
			<a href="<?= base_url ?>product/ver&id=<?=$product->id?>"><?=$product->name?></a>
		</td>
		<td>
			<?=$product->price?>
		</td>
		<td>
			<?=$element['units']?>
			<div class="updown-units">
				<a href="<?=base_url?>cart/up&index=<?=$index?>" class="button">+</a>
				<a href="<?=base_url?>cart/down&index=<?=$index?>" class="button">-</a>
			</div>
		</td>
		<td>
			<a href="<?=base_url?>cart/delete&index=<?=$index?>" class="button button-cart button-red">Remove product</a>
		</td>
	</tr>
	
	<?php endforeach; ?>
</table>
<br/>
<div class="delete-cart">
	<a href="<?=base_url?>cart/delete_all" class="button button-delete button-red">Empty cart</a>
</div>
<div class="total-cart">
	<?php $stats = Utils::statsCart(); ?>
	<h3>Price total: <?=$stats['total']?> $</h3>
	<a href="<?=base_url?>order/hacer" class="button button-order">Make order</a>
</div>

<?php else: ?>
	<p>This cart is empty, please add some thing!</p>
<?php endif; ?>