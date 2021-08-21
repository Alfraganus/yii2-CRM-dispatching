<?php
$array = array(
    'yes' => _e('Yes'),
    'yes_delete' => _e('Yes, delete'),
    'no' => _e('No'),
    'choose' => _e('Choose'),
    'close' => _e('Close'),
    'select' => _e('Select'),

    'success' => _e('Success'),
    'error' => _e('Error'),
    'warning' => _e('Warning'),

    'activate' => _e('Activate'),
    'block' => _e('Block'),
    'delete' => _e('Delete'),
    'publish' => _e('Publish'),
    'mv_trash' => _e('Move to trash'),
    'restore' => _e('Restore'),
    'unpublish' => _e('Unpublish'),

    'delete_order' => _e('Delete order'),
    'cancel_order' => _e('Cancel order'),
    'complete_order' => _e('Complete order'),
    'restore_order' => _e('Restore order'),

    'delete_item_qsn' => _e('Are you sure you want to delete this item?'),
    'delete_menu_item_qsn' => _e('Are you sure you want to delete menu item?'),

    'ta_activate_items' => _e("Activate items"),
    'ta_activate_items_qsn' => _e("Selected items will be activated. Continue?"),
    'ta_activate_item_qsn' => _e("Are you sure you want to activate this item?",),
    'ta_block_items' => _e("Block items"),
    'ta_block_items_qsn' => _e("Selected items will be blocked. Continue?"),
    'ta_block_item_qsn' => _e("Are you sure you want to block this item?"),
    'ta_publish_items' => _e("Publish items"),
    'ta_publish_items_qsn' => _e("Selected items will be published. Continue?"),
    'ta_publish_item_qsn' => _e("Are you sure you want to publish this item?"),
    'ta_unpublish_items' => _e("Unpublish items"),
    'ta_unpublish_items_qsn' => _e("Selected items will be unpublished. Continue?"),
    'ta_unpublish_item_qsn' => _e("Are you sure you want to unpublish this item?"),
    'ta_restore_items' => _e("Restore items"),
    'ta_restore_items_qsn' => _e("Selected items will be restored from the trashbox. Continue?"),
    'ta_restore_item_qsn' => _e("Are you sure you want to restore this item?"),
    'ta_mv_trash_items' => _e("Move to trash"),
    'ta_mv_trash_items_qsn' => _e("Selected items will be moved to trashbox. Continue?"),
    'ta_mv_trash_item_qsn' => _e("Are you sure you want to move to trash this item?"),
    'ta_delete_items' => _e("Delete items"),
    'ta_delete_items_qsn' => _e("Selected items will be deleted and cannot be restored. Continue?"),
    'ta_delete_item_qsn' => _e("This item will deleted and cannot be restored. Are you sure you want to delete?"),
    'ta_order_new_items' => _e("Set as new"),
    'ta_order_new_items_qsn' => _e("Selected orders status will be changed to new. Continue?"),
    'ta_order_new_item_qsn' => _e("The order's status will be changed to new. Continue?"),
    'ta_order_complete_items' => _e("Set as complete"),
    'ta_order_complete_items_qsn' => _e("Selected orders status will be changed to completed. Continue?"),
    'ta_order_complete_item_qsn' => _e("The order's status will be changed to completed. Continue?"),
    'ta_order_cancel_items' => _e("Set as cancel"),
    'ta_order_cancel_items_qsn' => _e("Selected orders status will be changed to cancelled. Continue?"),
    'ta_order_cancel_item_qsn' => _e("The order's status will be changed to cancelled. Continue?"),
    'ta_order_mv_trash_items_qsn' => _e("Selected orders will be deleted. Continue?"),
    'ta_order_mv_trash_item_qsn' => _e("The order will be deleted. Continue?"),
    'ta_order_delete_items_qsn' => _e("Selected orders will be deleted and cannot be restored. Continue?"),
    'ta_order_delete_item_qsn' => _e("The order will be deleted and cannot be restored. Continue?"),
    'ta_order_restore_items_qsn' => _e("Selected orders will be restored from the trashbox. Continue?"),
    'ta_order_restore_item_qsn' => _e("Are you sure you want to restore this order?"),

    'stb_invalid_path' => _e('Invalid folder path.'),
    'stb_files_selected' => _e('{count} files selected'),
    'stb_files_count' => _e('{count} files'),
); ?>

<script type="text/javascript">
    var trs = {};
    trs.messages = <?= json_encode($array); ?>;
</script>