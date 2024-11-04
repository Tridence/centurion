<?php
$tags = get_the_tags();
?>

<?php if ( $tags ) : ?>
	<div class="qodef-e-info-item qodef--tags">
		<?php the_tags( '', '<span class="qodef-info-separator-single"></span>' ); ?>
		<div class="qodef-info-separator-end"></div>
	</div>
<?php endif; ?>
