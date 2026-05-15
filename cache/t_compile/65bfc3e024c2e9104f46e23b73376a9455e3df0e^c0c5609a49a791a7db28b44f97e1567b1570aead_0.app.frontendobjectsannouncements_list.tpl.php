<?php
/* Smarty version 4.3.1, created on 2026-05-15 07:51:14
  from 'app:frontendobjectsannouncements_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_6a06d072229af9_26554312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0c5609a49a791a7db28b44f97e1567b1570aead' => 
    array (
      0 => 'app:frontendobjectsannouncements_list.tpl',
      1 => 1763774521,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/objects/announcement_summary.tpl' => 1,
  ),
),false)) {
function content_6a06d072229af9_26554312 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/ojs/lib/pkp/lib/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<?php if ($_smarty_tpl->tpl_vars['numAnnouncements']->value && smarty_modifier_count($_smarty_tpl->tpl_vars['announcements']->value)) {?>
    <section class="cmp_announcements highlight_first">
        <a id="homepageAnnouncements"></a>
        <h2>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"announcement.announcements"),$_smarty_tpl ) );?>

        </h2>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['announcements']->value, 'announcement', false, NULL, 'announcements', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['announcement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration']++;
?>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration'] : null) > $_smarty_tpl->tpl_vars['numAnnouncements']->value) {?>
                <?php break 1;?>
            <?php }?>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration'] : null) == 1) {?>
                <?php $_smarty_tpl->_subTemplateRender("app:frontend/objects/announcement_summary.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('heading'=>"h3"), 0, true);
?>
                <div class="more">
            <?php } else { ?>
                <article class="obj_announcement_summary">
                    <h4>
                        <a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>\PKP\core\PKPApplication::ROUTE_PAGE,'page'=>"announcement",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['announcement']->value->getId()),$_smarty_tpl ) );?>
">
                            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getLocalizedTitle() ));?>

                        </a>
                    </h4>
                    <div class="date">
                        <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date_format' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getDatePosted(),$_smarty_tpl->tpl_vars['dateFormatShort']->value ));?>

                    </div>
                </article>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div><!-- .more -->
    </section>
<?php }
}
}
