<?php
/* Smarty version 4.3.1, created on 2026-05-19 02:43:44
  from 'plugins-20-plugins-generic-citationStyleLanguage-generic-citationStyleLanguage:citationblock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a0bce6094df83_65161227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9c46f6cb33d1a835fcdd25369f822cc7f3558e4' => 
    array (
      0 => 'plugins-20-plugins-generic-citationStyleLanguage-generic-citationStyleLanguage:citationblock.tpl',
      1 => 1778144766,
      2 => 'plugins-20-plugins-generic-citationStyleLanguage-generic-citationStyleLanguage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a0bce6094df83_65161227 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['citation']->value) {?>
	<div class="item citation">
		<section class="sub_item citation_display">
			<h2 class="label">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.howToCite"),$_smarty_tpl ) );?>

			</h2>
			<div class="value">
				<div id="citationOutput" role="region" aria-live="polite">
					<?php echo $_smarty_tpl->tpl_vars['citation']->value;?>

				</div>
				<div class="citation_formats">
					<button class="citation_formats_button label" aria-controls="cslCitationFormats" aria-expanded="false" data-csl-dropdown="true">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.howToCite.citationFormats"),$_smarty_tpl ) );?>

					</button>
					<div id="cslCitationFormats" class="citation_formats_list" aria-hidden="true">
						<ul class="citation_formats_styles">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['citationStyles']->value, 'citationStyle');
$_smarty_tpl->tpl_vars['citationStyle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['citationStyle']->value) {
$_smarty_tpl->tpl_vars['citationStyle']->do_else = false;
?>
								<li>
									<a
											rel="nofollow"
											aria-controls="citationOutput"
											href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"citationstylelanguage",'op'=>"get",'path'=>$_smarty_tpl->tpl_vars['citationStyle']->value['id'],'params'=>$_smarty_tpl->tpl_vars['citationArgs']->value),$_smarty_tpl ) );?>
"
											data-load-citation
											data-json-href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"citationstylelanguage",'op'=>"get",'path'=>$_smarty_tpl->tpl_vars['citationStyle']->value['id'],'params'=>$_smarty_tpl->tpl_vars['citationArgsJson']->value),$_smarty_tpl ) );?>
"
									>
										<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['citationStyle']->value['title'] ));?>

									</a>
								</li>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</ul>
						<?php if (count($_smarty_tpl->tpl_vars['citationDownloads']->value)) {?>
							<div class="label">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.howToCite.downloadCitation"),$_smarty_tpl ) );?>

							</div>
							<ul class="citation_formats_styles">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['citationDownloads']->value, 'citationDownload');
$_smarty_tpl->tpl_vars['citationDownload']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['citationDownload']->value) {
$_smarty_tpl->tpl_vars['citationDownload']->do_else = false;
?>
									<li>
										<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"citationstylelanguage",'op'=>"download",'path'=>$_smarty_tpl->tpl_vars['citationDownload']->value['id'],'params'=>$_smarty_tpl->tpl_vars['citationArgs']->value),$_smarty_tpl ) );?>
">
											<span class="fa fa-download"></span>
											<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['citationDownload']->value['title'] ));?>

										</a>
									</li>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</ul>
						<?php }?>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php }
}
}
