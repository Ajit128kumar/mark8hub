<div class="row">
	<?php if (count($listings) > 0): ?>
		<div class="col-lg-12">
			<a href="javascript:void(0)" class="btn btn-primary alignToTitle" onclick="showAjaxModal('<?php echo base_url('modal/popup/add_inventory/'.$active_listing_id);?>', '<?php echo get_phrase('add_new_inventory'); ?>');"><i class="entypo-plus"></i><?php echo get_phrase('add_new_inventory'); ?></a>
		</div>
		<div class="col-md-12">
			<h5><strong><?php echo get_phrase('select_your_shop'); ?></strong></h5>
		</div>
		<div class="col-md-3">
			<?php foreach ($listings as $listing):?>
				<div class="row" style="margin-bottom : 5px;">
					<div class="col-md-12">
						<a style="text-align: left;" href="<?php echo site_url('addons/shop/inventory_manager/' . $listing['id']);?>"
							class="<?php if ($active_listing_id == $listing['id'])
							echo 'btn btn-primary';
							else
							echo 'btn btn-default';?> btn-block btn-icon icon-left tooltip-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo sanitizer($listing['name']); ?>">
							<?php
							echo strlen($listing['name']) > 30 ? substr($listing['name'],0,30)."..." : $listing['name'];
							?>
							<i class="fa fa-cube"></i>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="col-md-5">
			<div class="panel panel-primary main_data">
				<div class="panel-heading">
					<div class="panel-title"><?php echo get_phrase('inventory_manager'); ?></div>
				</div>
				<table class="table  table-bordered">
					<thead>
						<tr>
							<th><?php echo get_phrase('product_name'); ?></th>
							<th><?php echo get_phrase('category'); ?></th>
							<th><?php echo get_phrase('price'); ?></th>
							<th>Unit</th>
							<th><?php echo get_phrase('availability'); ?></th>
							<th>Featured</th>
							<th width = "100"><?php echo get_phrase('action'); ?></th>
						</tr>
					</thead>

					<tbody>
						<?php if (count($inventories) > 0): ?>
							<?php foreach ($inventories as $inventory): ?>
								<tr>
									<td><?php echo sanitizer($inventory['name']); ?></td>
									<td>
										<?php
										$inventory_category = $this->shop_model->get_inventory_category_by_id($inventory['category_id']);
										echo sanitizer($inventory_category['name']);
										?>
									</td>
									<td><?php echo currency($inventory['price']); ?></td>
									 <td>
                                        <?php
                                        if(!empty($inventory['unit'])){
                                            echo 'Per '.$inventory['unit'];
                                        }

                                        ?>
                                    </td>
									<td><?php echo sanitizer($inventory['availability']) ? get_phrase('available') : get_phrase('not_available'); ?></td>
									<td>
                                        <?php
                                        echo
                                        ($inventory['is_featured']==1) ? 'Yes' : 'No';
                                        ?>
                                    </td>
									<td class="text-center">
										<button type="button" class="btn btn-sm btn-info" onclick="showAjaxModal('<?php echo base_url('modal/popup/edit_inventory/'.$inventory['id']);?>', '<?php echo get_phrase('update_inventory_category'); ?>');">
											<i class="entypo-pencil"></i>
										</button>
										<button type="button" class="btn btn-sm btn-danger" onclick="confirm_modal('<?php echo site_url('addons/shop/inventory_form/delete/'.$inventory['id']); ?>');">
											<i class="entypo-cancel"></i>
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="5"><?php echo get_phrase('no_data_found'); ?></td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">
								<i class="entypo-gauge"></i>
								<?php echo get_phrase('categories'); ?>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><?php echo get_phrase('name'); ?></th>
										<th><?php echo get_phrase('action'); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php if (count($inventory_categories) > 0): ?>
										<?php foreach ($inventory_categories as $inventory_category): ?>
											<tr>
												<td><?php echo sanitizer($inventory_category['name']); ?></td>
												<td class="text-center">
													<button type="button" class="btn btn-sm btn-info" onclick="showAjaxModal('<?php echo base_url('modal/popup/edit_inventory_category/'.$inventory_category['id']);?>', '<?php echo get_phrase('update_inventory_category'); ?>');">
														<i class="entypo-pencil"></i>
													</button>
													<button type="button" class="btn btn-sm btn-danger" onclick="confirm_modal('<?php echo site_url('addons/shop/inventory_category_form/delete/'.$inventory_category['id']); ?>');">
														<i class="entypo-cancel"></i>
													</button>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="2"><?php echo get_phrase('no_data_found'); ?></td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
							<br>
							<form action="<?php echo site_url('addons/shop/inventory_category_form/add'); ?>" method="post">
								<input type="hidden" class="form-control" name="active_listing_id" value="<?php echo sanitizer($active_listing_id); ?>">
								<div class="form-group">
									<label for="name" class="control-label"><?php echo get_phrase('category_title'); ?></label>
									<input type="text" class="form-control" name="name" id="name" placeholder="<?php echo get_phrase('provide_category_name'); ?>" required>
								</div>
								<button type="submit" name="button" class="btn btn-primary"><?php echo get_phrase('add'); ?></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="col-md-12 text-center">
			<h4><?php echo get_phrase('no_directory_found'); ?></h4>
		</div>
	<?php endif; ?>
</div>
