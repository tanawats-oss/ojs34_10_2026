<?php
/* Smarty version 4.3.1, created on 2026-05-19 02:13:25
  from 'plugins-16-plugins-generic-staticPages-generic-staticPages:staticPagesTab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a0bc745f306d6_70304343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9ee41b2f91ecae60ee0c64b94ca0167f6bb5f22' => 
    array (
      0 => 'plugins-16-plugins-generic-staticPages-generic-staticPages:staticPagesTab.tpl',
      1 => 1778144767,
      2 => 'plugins-16-plugins-generic-staticPages-generic-staticPages',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a0bc745f306d6_70304343 (Smarty_Internal_Template $_smarty_tpl) {
?><tab id="staticPages" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"plugins.generic.staticPages.staticPages"),$_smarty_tpl ) );?>
">
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'staticPageGridUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"plugins.generic.staticPages.controllers.grid.StaticPageGridHandler",'op'=>"fetchGrid",'escape'=>false),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_url_in_div'][0], array( array('id'=>"staticPageGridContainer",'url'=>$_smarty_tpl->tpl_vars['staticPageGridUrl']->value),$_smarty_tpl ) );?>

</tab>
<?php }
}
