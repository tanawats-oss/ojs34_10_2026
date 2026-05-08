SET FOREIGN_KEY_CHECKS = 1SET FOREIGN_KEY_CHECKS = 0;


ALTER TABLE review_form_responses DROP INDEX review_form_responses_unique;
ALTER TABLE review_round_files DROP INDEX review_round_files_unique;
ALTER TABLE review_files DROP INDEX review_files_unique;
ALTER TABLE scheduled_tasks DROP INDEX scheduled_tasks_unique;
ALTER TABLE announcement_type_settings DROP INDEX announcement_type_settings_unique;
ALTER TABLE announcement_settings DROP INDEX announcement_settings_unique;
ALTER TABLE category_settings DROP INDEX category_settings_unique;
ALTER TABLE versions DROP INDEX versions_unique;
ALTER TABLE site_settings DROP INDEX site_settings_unique;
ALTER TABLE user_settings DROP INDEX user_settings_unique;
ALTER TABLE notification_settings DROP INDEX notification_settings_unique;
ALTER TABLE email_templates_default_data DROP INDEX email_templates_default_data_unique;
ALTER TABLE email_templates_settings DROP INDEX email_templates_settings_unique;
ALTER TABLE oai_resumption_tokens DROP INDEX oai_resumption_tokens_unique;
ALTER TABLE plugin_settings DROP INDEX plugin_settings_unique;
ALTER TABLE genre_settings DROP INDEX genre_settings_unique;
ALTER TABLE library_file_settings DROP INDEX library_file_settings_unique;
ALTER TABLE event_log_settings DROP INDEX event_log_settings_unique;
ALTER TABLE citation_settings DROP INDEX citation_settings_unique;
ALTER TABLE filter_settings DROP INDEX filter_settings_unique;
ALTER TABLE navigation_menu_item_settings DROP INDEX navigation_menu_item_settings_unique;
ALTER TABLE navigation_menu_item_assignment_settings DROP INDEX navigation_menu_item_assignment_settings_unique;
ALTER TABLE review_form_settings DROP INDEX review_form_settings_unique;
ALTER TABLE review_form_element_settings DROP INDEX review_form_element_settings_unique;
ALTER TABLE user_group_settings DROP INDEX user_group_settings_unique;
ALTER TABLE user_user_groups DROP INDEX user_user_groups_unique;
ALTER TABLE user_group_stage DROP INDEX user_group_stage_unique;
ALTER TABLE submission_file_settings DROP INDEX submission_file_settings_unique;
ALTER TABLE submission_settings DROP INDEX submission_settings_unique;
ALTER TABLE publication_settings DROP INDEX publication_settings_unique;
ALTER TABLE author_settings DROP INDEX author_settings_unique;
ALTER TABLE subeditor_submission_group DROP INDEX section_editors_unique;
ALTER TABLE query_participants DROP INDEX query_participants_unique;
ALTER TABLE submission_search_object_keywords DROP INDEX submission_search_object_keywords_unique;
ALTER TABLE data_object_tombstone_settings DROP INDEX data_object_tombstone_settings_unique;


ALTER TABLE navigation_menu_item_assignment_settings DROP FOREIGN KEY assignment_settings_navigation_menu_item_assignment_id;
ALTER TABLE section_settings DROP FOREIGN KEY section_settings_section_id;
ALTER TABLE issue_settings DROP FOREIGN KEY issue_settings_issue_id;
ALTER TABLE publication_galley_settings DROP FOREIGN KEY pub_galley_settings_id_fk_v4;
ALTER TABLE journals DROP FOREIGN KEY journals_current_issue_id_foreign;

-- กลุ่มตาราง Publications (ตัวแสบที่สุด)
ALTER TABLE publications DROP FOREIGN KEY publications_url_path;
ALTER TABLE publications DROP FOREIGN KEY publications_doi_id;
ALTER TABLE publications DROP FOREIGN KEY publications_primary_contact_id;
ALTER TABLE publications DROP FOREIGN KEY fk_pub_journal_v34_final;
ALTER TABLE publications DROP FOREIGN KEY pub_section_id_x34;
ALTER TABLE publications DROP FOREIGN KEY pub_submission_id_x34;
ALTER TABLE publications DROP INDEX publications_section_id;


-- ตาราง Journals (ลบคอลัมน์ที่ OJS จะสร้างใหม่เป็น BigInt)
ALTER TABLE journals DROP COLUMN current_issue_id;

-- ตาราง Announcement Types (เปลี่ยนชื่อกลับเพื่อให้ Migration รันได้)
ALTER TABLE announcement_types DROP INDEX announcement_types_context_id;
ALTER TABLE announcement_types DROP INDEX announcement_types_assoc_id;
-- หากเปลี่ยนชื่อไปแล้ว ให้เปลี่ยนกลับเพื่อรอ Migration จัดการใหม่
-- ALTER TABLE announcement_types CHANGE assoc_id context_id BIGINT; 


ALTER TABLE versions DROP COLUMN version_id;
ALTER TABLE review_round_files DROP COLUMN review_round_file_id;
ALTER TABLE review_files DROP COLUMN review_file_id;
ALTER TABLE scheduled_tasks DROP COLUMN scheduled_task_id;
ALTER TABLE review_form_responses DROP COLUMN review_form_response_id;
ALTER TABLE query_participants DROP COLUMN query_participant_id;
ALTER TABLE user_group_stage DROP COLUMN user_group_stage_id;
ALTER TABLE submission_search_object_keywords DROP COLUMN submission_search_object_keyword_id;
ALTER TABLE email_templates_default_data DROP COLUMN email_templates_default_data_id;
ALTER TABLE oai_resumption_tokens DROP COLUMN oai_resumption_token_id;


ALTER TABLE versions DROP INDEX versions_pkey;
ALTER TABLE site_settings DROP INDEX site_settings_pkey;
ALTER TABLE user_settings DROP INDEX user_settings_pkey;
ALTER TABLE notification_settings DROP INDEX notification_settings_pkey;
ALTER TABLE email_templates_default_data DROP INDEX email_templates_default_data_pkey;
ALTER TABLE email_templates_settings DROP INDEX email_settings_pkey;
ALTER TABLE review_form_responses DROP INDEX review_form_responses_pkey;
ALTER TABLE review_files DROP INDEX review_files_pkey;

SET FOREIGN_KEY_CHECKS = 1;
