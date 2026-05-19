<?php
/* Smarty version 4.3.1, created on 2026-05-19 02:47:41
  from 'plugins-2-plugins-generic-customBlockManager-generic-customBlockManager:block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a0bcf4d8ff6f6_69170618',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2c7763ed9cbd24d28766d981f416888c019bde5' => 
    array (
      0 => 'plugins-2-plugins-generic-customBlockManager-generic-customBlockManager:block.tpl',
      1 => 1778144766,
      2 => 'plugins-2-plugins-generic-customBlockManager-generic-customBlockManager',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a0bcf4d8ff6f6_69170618 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pkp_block block_custom" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customBlockId']->value ));?>
">
	<h2 class="title<?php if (!$_smarty_tpl->tpl_vars['showName']->value) {?> pkp_screen_reader<?php }?>"><?php echo $_smarty_tpl->tpl_vars['customBlockTitle']->value;?>
</h2>
	<div class="content">
		<?php echo $_smarty_tpl->tpl_vars['customBlockContent']->value;?>

	</div>
</div>
<?php }
}
