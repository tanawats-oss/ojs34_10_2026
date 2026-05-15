<?php
/* Smarty version 4.3.1, created on 2026-05-15 07:56:19
  from 'app:userprofile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a06d1a354b0d0_04438811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1008b726a28deeda1b111c8b996bfb7069c64388' => 
    array (
      0 => 'app:userprofile.tpl',
      1 => 1763774521,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a06d1a354b0d0_04438811 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12208210816a06d1a3544e82_69938843', "page");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/backend.tpl");
}
/* {block "page"} */
class Block_12208210816a06d1a3544e82_69938843 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page' => 
  array (
    0 => 'Block_12208210816a06d1a3544e82_69938843',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<h1 class="app__pageHeading">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.profile"),$_smarty_tpl ) );?>

	</h1>

	<?php echo '<script'; ?>
 type="text/javascript">
		// Attach the JS file tab handler.
		$(function() {
			$('#profileTabs').pkpHandler('$.pkp.controllers.TabHandler');
		});
	<?php echo '</script'; ?>
>
	<div id="profileTabs" class="pkp_controllers_tab">
		<ul>
			<li><a name="identity" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"tab.user.ProfileTabHandler",'op'=>"identity"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.profile.identity"),$_smarty_tpl ) );?>
</a></li>
			<li><a name="contact" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"tab.user.ProfileTabHandler",'op'=>"contact"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.profile.contact"),$_smarty_tpl ) );?>
</a></li>
			<li><a name="roles" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"tab.user.ProfileTabHandler",'op'=>"roles"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.roles"),$_smarty_tpl ) );?>
</a></li>
			<li><a name="publicProfile" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"tab.user.ProfileTabHandler",'op'=>"publicProfile"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.profile.public"),$_smarty_tpl ) );?>
</a></li>
			<li><a name="changePassword" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"tab.user.ProfileTabHandler",'op'=>"changePassword"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.password"),$_smarty_tpl ) );?>
</a></li>
			<li><a name="notificationSettings" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"tab.user.ProfileTabHandler",'op'=>"notificationSettings"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"notification.notifications"),$_smarty_tpl ) );?>
</a></li>
			<li><a name="apiSettings" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_COMPONENT,'component'=>"tab.user.ProfileTabHandler",'op'=>"apiProfile"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.apiKey"),$_smarty_tpl ) );?>
</a></li>
		</ul>
	</div>
<?php
}
}
/* {/block "page"} */
}
