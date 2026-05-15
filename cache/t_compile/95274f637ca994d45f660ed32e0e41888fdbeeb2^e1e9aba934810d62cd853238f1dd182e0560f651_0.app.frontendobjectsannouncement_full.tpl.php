<?php
/* Smarty version 4.3.1, created on 2026-05-15 07:55:26
  from 'app:frontendobjectsannouncement_full.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a06d16e330276_45032814',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1e9aba934810d62cd853238f1dd182e0560f651' => 
    array (
      0 => 'app:frontendobjectsannouncement_full.tpl',
      1 => 1763774521,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a06d16e330276_45032814 (Smarty_Internal_Template $_smarty_tpl) {
?>
<article class="obj_announcement_full">
	<h1>
		<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getLocalizedTitle() ));?>

	</h1>
	<div class="date">
		<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date_format' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getDatePosted(),$_smarty_tpl->tpl_vars['dateFormatShort']->value ));?>

	</div>
	<div class="description">
		<?php if ($_smarty_tpl->tpl_vars['announcement']->value->getLocalizedDescription()) {?>
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getLocalizedDescription() ));?>

		<?php } else { ?>
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getLocalizedDescriptionShort() ));?>

		<?php }?>
	</div>
</article><!-- .obj_announcement_full -->
<?php }
}
