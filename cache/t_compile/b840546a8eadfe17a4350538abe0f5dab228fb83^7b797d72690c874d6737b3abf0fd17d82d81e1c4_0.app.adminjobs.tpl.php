<?php
/* Smarty version 4.3.1, created on 2026-05-14 08:38:54
  from 'app:adminjobs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a058a1ee90239_78356628',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b797d72690c874d6737b3abf0fd17d82d81e1c4' => 
    array (
      0 => 'app:adminjobs.tpl',
      1 => 1763774521,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a058a1ee90239_78356628 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6755820706a058a1ee8f506_27536135', "page");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/backend.tpl");
}
/* {block "page"} */
class Block_6755820706a058a1ee8f506_27536135 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page' => 
  array (
    0 => 'Block_6755820706a058a1ee8f506_27536135',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<h1 class="app__pageHeading">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['pageTitle']->value),$_smarty_tpl ) );?>

	</h1>
	<div class="app__contentPanel">
		<pkp-table
			:columns="columns"
			:rows="rows"
			:description="description"
			:label="label"
		></pkp-table>

		<pagination v-if="lastPage > 1"
			:current-page="currentPage"
			:last-page="lastPage"
			:is-loading="isLoadingItems"
			@set-page="handlePagination"
		/>
	</div>
<?php
}
}
/* {/block "page"} */
}
