
-------------------------------------Update permission to MA------------------------------------------------------
INSERT INTO user_user_groups (user_group_id, user_id)
SELECT user_group_id, 112983
FROM user_groups
WHERE role_id = 16 
AND user_group_id NOT IN (
    SELECT user_group_id FROM user_user_groups WHERE user_id = 112983
);

-------------------------------------Disable plugin OJS3.4.10------------------------------------------------------
UPDATE plugin_settings 
SET setting_value = '0' 
WHERE setting_name = 'enabled' 
AND plugin_name IN (
    'webfeedplugin', 
    'announcementfeedplugin', 
    'dataverseplugin', 
    'keywordcloudblockplugin', 
    'shariffplugin', 
    'driverplugin', 
    'openaireplugin'
);

-------------------------------------Update Theme Webs OJS3.4.10------------------------------------------------------
UPDATE plugin_settings
SET setting_value = '0'
WHERE setting_name = 'enabled'
AND plugin_name = 'bootstrap3betathemeplugin';

UPDATE plugin_settings SET setting_value = '1' WHERE setting_name = 'enabled' AND plugin_name = 'manuscriptchildthemeplugin';
UPDATE journal_settings SET setting_value = 'manuscriptchildthemeplugin' WHERE setting_name = 'theme';

---------------------------------Disable Lang box-----------------------------------------------------------------------
UPDATE plugin_settings 
SET setting_value = '0' 
WHERE setting_name = 'enabled' AND plugin_name = 'languagetoggleblockplugin';