<?php
	global $current_custom_user;

	$args = array(
		'post_type' => 'client',
		'posts_per_page' => -1,
		'order' => 'DESC'
	);

	$wp_query = new WP_Query($args);
?>

<section class="project-tracker-wrap wow animated fadeIn delay-2">
	<div class="project-status overflow">
		<div class="project-column first">
			<div class="project-title">
				<?php _e( 'Project', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column roi">
			<div class="stage">
				<?php _e( 'ROI', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column profit">
			<div class="stage">
				<?php _e( 'Net Profit', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column">
			<div class="stage">
				<?php _e( 'Pre-Purchase', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column">
			<div class="stage">
				<?php _e( 'Settlement Period', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column">
			<div class="stage">
				<?php _e( 'Post Settlement', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column">
			<div class="stage">
				<?php _e( 'TP & Demo', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column">
			<div class="stage">
				<?php _e( 'Engineering', 'html5blank' ); ?>
			</div>
		</div>

		<div class="project-column">
			<div class="stage">
				<?php _e( 'Build', 'html5blank' ); ?>
			</div>
		</div>
	</div>

	<?php if ($wp_query->have_posts()): while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php $clients = get_field('client_id'); ?>

		<?php if($clients) : ?>
			<?php if (in_array_r($current_custom_user, $clients)) : ?>
				<div class="project-status overflow">
					<div class="project-column first">
						<div class="project-address">
							<?php if( get_field('project_address') ): ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_field('project_address'); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>

					<div class="project-column roi grey">
						<div class="status">
							<?php the_field('admin_net_roi'); ?>
						</div>
					</div>

					<div class="project-column profit grey">
						<div class="status">
							<?php the_field('admin_share'); ?>
						</div>
					</div>

					<?php if( get_field('status_prepurchase') ): ?>
						<?php
							$status = get_field_object('status_prepurchase');
							$value = $status['value'];
							$label = $status['choices'][$value];
						?>

						<div class="project-column">
							<div class="status <?php echo $value; ?>">
								<?php echo $label; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if( get_field('status_settlement_period') ): ?>
						<?php
							$status = get_field_object('status_settlement_period');
							$value = $status['value'];
							$label = $status['choices'][$value];
						?>

						<div class="project-column">
							<div class="status <?php echo $value; ?>">
								<?php echo $label; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if( get_field('status_post_settlement') ): ?>
						<?php
							$status = get_field_object('status_post_settlement');
							$value = $status['value'];
							$label = $status['choices'][$value];
						?>

						<div class="project-column">
							<div class="status <?php echo $value; ?>">
								<?php echo $label; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if( get_field('status_tp_demo') ): ?>
						<?php
							$status = get_field_object('status_tp_demo');
							$value = $status['value'];
							$label = $status['choices'][$value];
						?>

						<div class="project-column">
							<div class="status <?php echo $value; ?>">
								<?php echo $label; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if( get_field('status_engineering') ): ?>
						<?php
							$status = get_field_object('status_engineering');
							$value = $status['value'];
							$label = $status['choices'][$value];
						?>

						<div class="project-column">
							<div class="status <?php echo $value; ?>">
								<?php echo $label; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if( get_field('status_build') ): ?>
						<?php
							$status = get_field_object('status_build');
							$value = $status['value'];
							$label = $status['choices'][$value];
						?>

						<div class="project-column">
							<div class="status <?php echo $value; ?>">
								<?php echo $label; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endwhile; ?>

	<?php endif; ?>
</section>
