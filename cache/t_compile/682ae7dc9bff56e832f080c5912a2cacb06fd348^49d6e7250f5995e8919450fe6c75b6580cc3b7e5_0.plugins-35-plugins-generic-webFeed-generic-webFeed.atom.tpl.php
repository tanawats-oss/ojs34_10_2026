<?php
/* Smarty version 4.3.1, created on 2026-07-14 08:38:42
  from 'plugins-35-plugins-generic-webFeed-generic-webFeed:atom.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a55f59261f503_39916135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49d6e7250f5995e8919450fe6c75b6580cc3b7e5' => 
    array (
      0 => 'plugins-35-plugins-generic-webFeed-generic-webFeed:atom.tpl',
      1 => 1784012791,
      2 => 'plugins-35-plugins-generic-webFeed-generic-webFeed',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a55f59261f503_39916135 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?'; ?>
xml version="1.0" encoding="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['defaultCharset']->value ));?>
"<?php echo '?>'; ?>

<feed xmlns="http://www.w3.org/2005/Atom">
		<id><?php echo $_smarty_tpl->tpl_vars['feedUrl']->value;?>
</id>
	<title><?php echo preg_replace('!\s+!u', ' ',call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['context']->value->getLocalizedName(),"html" )));?>
</title>

	<updated><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date_format' ][ 0 ], array( $_smarty_tpl->tpl_vars['latestDate']->value,"Y-m-d\TH:i:sP" ));?>
</updated>

		<?php if ($_smarty_tpl->tpl_vars['context']->value->getData('contactName')) {?>
		<author>
			<name><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['context']->value->getData('contactName')),"html" ));?>
</name>
			<?php if ($_smarty_tpl->tpl_vars['context']->value->getData('contactEmail')) {?>
			<email><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['context']->value->getData('contactEmail')),"html" ));?>
</email>
			<?php }?>
		</author>
	<?php }?>

	<link rel="alternate" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('context'=>$_smarty_tpl->tpl_vars['context']->value->getPath()),$_smarty_tpl ) );?>
" />
	<link rel="self" type="application/atom+xml" href="<?php echo $_smarty_tpl->tpl_vars['feedUrl']->value;?>
" />

	
		
	<generator uri="https://pkp.sfu.ca/<?php echo $_smarty_tpl->tpl_vars['applicationIdentifier']->value;?>
/" version="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['applicationVersion']->value ));?>
"><?php echo $_smarty_tpl->tpl_vars['applicationName']->value;?>
</generator>
	<?php if ($_smarty_tpl->tpl_vars['context']->value->getLocalizedDescription()) {?>
		<?php $_smarty_tpl->_assignInScope('description', $_smarty_tpl->tpl_vars['context']->value->getLocalizedDescription());?>
	<?php } elseif ($_smarty_tpl->tpl_vars['context']->value->getLocalizedData('searchDescription')) {?>
		<?php $_smarty_tpl->_assignInScope('description', $_smarty_tpl->tpl_vars['context']->value->getLocalizedData('searchDescription'));?>
	<?php }?>

	<subtitle type="html"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['description']->value),"html" ));?>
</subtitle>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['submissions']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('submission', $_smarty_tpl->tpl_vars['item']->value['submission']);?>
		<?php $_smarty_tpl->_assignInScope('publication', $_smarty_tpl->tpl_vars['submission']->value->getCurrentPublication());?>
		<entry>
						<id><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['publicationPage']->value,'op'=>$_smarty_tpl->tpl_vars['publicationOp']->value,'path'=>(($tmp = $_smarty_tpl->tpl_vars['publication']->value->getData('urlPath') ?? null)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['submission']->value->getId() ?? null : $tmp)),$_smarty_tpl ) );?>
</id>
			<title><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['publication']->value->getLocalizedTitle()),"html" ));?>
</title>
			<updated><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date_format' ][ 0 ], array( $_smarty_tpl->tpl_vars['publication']->value->getData('lastModified'),"Y-m-d\TH:i:sP" ));?>
</updated>

			
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['publication']->value->getData('authors'), 'author');
$_smarty_tpl->tpl_vars['author']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['author']->value) {
$_smarty_tpl->tpl_vars['author']->do_else = false;
?>
				<author>
					<name><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['author']->value->getFullName(false)),"html" ));?>
</name>
				</author>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<link rel="alternate" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['publicationPage']->value,'op'=>$_smarty_tpl->tpl_vars['publicationOp']->value,'path'=>(($tmp = $_smarty_tpl->tpl_vars['publication']->value->getData('urlPath') ?? null)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['submission']->value->getId() ?? null : $tmp)),$_smarty_tpl ) );?>
" />

			<?php if ($_smarty_tpl->tpl_vars['publication']->value->getLocalizedData('abstract') || $_smarty_tpl->tpl_vars['includeIdentifiers']->value) {?>
				<summary type="html" xml:base="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['publicationPage']->value,'op'=>$_smarty_tpl->tpl_vars['publicationOp']->value,'path'=>(($tmp = $_smarty_tpl->tpl_vars['publication']->value->getData('urlPath') ?? null)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['submission']->value->getId() ?? null : $tmp)),$_smarty_tpl ) );?>
">
					<?php if ($_smarty_tpl->tpl_vars['includeIdentifiers']->value) {?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['identifiers'], 'identifier');
$_smarty_tpl->tpl_vars['identifier']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['identifier']->value) {
$_smarty_tpl->tpl_vars['identifier']->do_else = false;
?>
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['identifier']->value['label']),"html" ));?>
: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'implode' ][ 0 ], array( ', ',$_smarty_tpl->tpl_vars['identifier']->value['values'] ))),"html" ));?>
&lt;br /&gt;
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>						&lt;br /&gt;
					<?php }?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',(($tmp = $_smarty_tpl->tpl_vars['publication']->value->getLocalizedData('abstract') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)),"html" ));?>

				</summary>
			<?php }?>

			
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['identifiers'], 'identifier');
$_smarty_tpl->tpl_vars['identifier']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['identifier']->value) {
$_smarty_tpl->tpl_vars['identifier']->do_else = false;
?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['identifier']->value['values'], 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
					<category term="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['value']->value),"html" ));?>
" label="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['identifier']->value['label']),"html" ));?>
" scheme="https://pkp.sfu.ca/<?php echo $_smarty_tpl->tpl_vars['applicationIdentifier']->value;?>
/category/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['identifier']->value['type']),"html" ));?>
"/>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			
			<published><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date_format' ][ 0 ], array( $_smarty_tpl->tpl_vars['publication']->value->getData('datePublished'),"Y-m-d\TH:i:sP" ));?>
</published>

						<rights><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.copyrightStatement",'copyrightYear'=>$_smarty_tpl->tpl_vars['publication']->value->getData('copyrightYear'),'copyrightHolder'=>$_smarty_tpl->tpl_vars['publication']->value->getLocalizedData('copyrightHolder')),$_smarty_tpl ) ) ));?>
</rights>
		</entry>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></feed>
<?php }
}
