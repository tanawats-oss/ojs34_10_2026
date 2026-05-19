<?php
/* Smarty version 4.3.1, created on 2026-05-19 02:29:58
  from 'plugins-6-plugins-blocks-developedBy-blocks-developedBy:block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a0bcb26910f07_68343656',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08327b3615e3b2d0c45604665e3ac7397d59c3cf' => 
    array (
      0 => 'plugins-6-plugins-blocks-developedBy-blocks-developedBy:block.tpl',
      1 => 1778144766,
      2 => 'plugins-6-plugins-blocks-developedBy-blocks-developedBy',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a0bcb26910f07_68343656 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pkp_block block_developed_by">
	<h2 class="pkp_screen_reader">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"plugins.block.developedBy.blockTitle"),$_smarty_tpl ) );?>

	</h2>

	<div class="content">
		<a href="https://pkp.sfu.ca/ojs/">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.software"),$_smarty_tpl ) );?>

		</a>
	</div>
</div>
<?php }
}
