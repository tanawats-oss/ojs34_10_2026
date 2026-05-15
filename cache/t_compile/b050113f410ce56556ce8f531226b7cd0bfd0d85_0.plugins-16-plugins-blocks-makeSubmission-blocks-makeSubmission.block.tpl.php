<?php
/* Smarty version 4.3.1, created on 2026-05-15 07:54:57
  from 'plugins-16-plugins-blocks-makeSubmission-blocks-makeSubmission:block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a06d151725741_93149604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b050113f410ce56556ce8f531226b7cd0bfd0d85' => 
    array (
      0 => 'plugins-16-plugins-blocks-makeSubmission-blocks-makeSubmission:block.tpl',
      1 => 1778144766,
      2 => 'plugins-16-plugins-blocks-makeSubmission-blocks-makeSubmission',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a06d151725741_93149604 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pkp_block block_make_submission">
	<h2 class="pkp_screen_reader">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"plugins.block.makeSubmission.linkLabel"),$_smarty_tpl ) );?>

	</h2>

	<div class="content">
		<a class="block_make_submission_link" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_PAGE,'page'=>"about",'op'=>"submissions"),$_smarty_tpl ) );?>
">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"plugins.block.makeSubmission.linkLabel"),$_smarty_tpl ) );?>

		</a>
	</div>
</div>
<?php }
}
