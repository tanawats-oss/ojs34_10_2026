<?php
/* Smarty version 4.3.1, created on 2026-05-15 07:50:58
  from 'plugins-0-plugins-blocks-languageToggle-blocks-languageToggle:block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a06d062c2a6e0_58977790',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f52add7971c5e64b52808003c8573554df3ee24' => 
    array (
      0 => 'plugins-0-plugins-blocks-languageToggle-blocks-languageToggle:block.tpl',
      1 => 1778144766,
      2 => 'plugins-0-plugins-blocks-languageToggle-blocks-languageToggle',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a06d062c2a6e0_58977790 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/ojs/lib/pkp/lib/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
if ($_smarty_tpl->tpl_vars['enableLanguageToggle']->value) {?>
<div class="pkp_block block_language">
	<h2 class="title">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.language"),$_smarty_tpl ) );?>

	</h2>

	<div class="content">
		<ul>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languageToggleLocales']->value, 'localeName', false, 'localeKey');
$_smarty_tpl->tpl_vars['localeName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['localeKey']->value => $_smarty_tpl->tpl_vars['localeName']->value) {
$_smarty_tpl->tpl_vars['localeName']->do_else = false;
?>
				<li class="locale_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['localeKey']->value ));
if ($_smarty_tpl->tpl_vars['localeKey']->value == $_smarty_tpl->tpl_vars['currentLocale']->value) {?> current<?php }?>" lang="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['localeKey']->value,"_","-");?>
">
					<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_PAGE,'page'=>"user",'op'=>"setLocale",'path'=>$_smarty_tpl->tpl_vars['localeKey']->value,'source'=>$_SERVER['REQUEST_URI']),$_smarty_tpl ) );?>
">
						<?php echo $_smarty_tpl->tpl_vars['localeName']->value;?>

					</a>
				</li>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
	</div>
</div><!-- .block_language -->
<?php }
}
}
