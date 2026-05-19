<?php
/* Smarty version 4.3.1, created on 2026-05-19 02:08:27
  from 'app:statscounterReports.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a0bc61b1d2606_65562132',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6088e863d6276941de054797a7cde6788afeab9' => 
    array (
      0 => 'app:statscounterReports.tpl',
      1 => 1763774521,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a0bc61b1d2606_65562132 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17079224526a0bc61b1d0941_63930489', "page");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/backend.tpl");
}
/* {block "page"} */
class Block_17079224526a0bc61b1d0941_63930489 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page' => 
  array (
    0 => 'Block_17079224526a0bc61b1d0941_63930489',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<h1 class="app__pageHeading">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.statistics.counterR5Reports"),$_smarty_tpl ) );?>

	</h1>
	<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.statistics.counterR5Reports.description"),$_smarty_tpl ) );?>
</p>
	<?php if (!$_smarty_tpl->tpl_vars['usagePossible']->value) {?>
		<notification class="pkpNotification--backendPage__header" type="warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"manager.statistics.counterR5Reports.usageNotPossible"),$_smarty_tpl ) );?>
</notification>
	<?php }?>
	<panel>
		<panel-section>
			<counter-reports-list-panel
				v-bind="components.counterReportsListPanel"
				@set="set"
			/>
		</panel-section>
	</panel>
<?php
}
}
/* {/block "page"} */
}
