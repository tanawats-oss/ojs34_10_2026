SET FOREIGN_KEY_CHECKS = 0;

-- =========================================================
-- SAFE DROP FOREIGN KEYS
-- =========================================================

-- publications_submission_id
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publications'
      AND CONSTRAINT_NAME = 'publications_submission_id'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publications DROP FOREIGN KEY publications_submission_id',
    'SELECT "SKIP publications_submission_id"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- pub_primary_contact_id_x34
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publications'
      AND CONSTRAINT_NAME = 'pub_primary_contact_id_x34'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publications DROP FOREIGN KEY pub_primary_contact_id_x34',
    'SELECT "SKIP pub_primary_contact_id_x34"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- pub_section_id_x34
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publications'
      AND CONSTRAINT_NAME = 'pub_section_id_x34'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publications DROP FOREIGN KEY pub_section_id_x34',
    'SELECT "SKIP pub_section_id_x34"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- publications_section_id
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publications'
      AND CONSTRAINT_NAME = 'publications_section_id'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publications DROP FOREIGN KEY publications_section_id',
    'SELECT "SKIP publications_section_id FK"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- publications_primary_contact_id
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publications'
      AND CONSTRAINT_NAME = 'publications_primary_contact_id'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publications DROP FOREIGN KEY publications_primary_contact_id',
    'SELECT "SKIP publications_primary_contact_id FK"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- journals_current_issue_id_foreign
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'journals'
      AND CONSTRAINT_NAME = 'journals_current_issue_id_foreign'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE journals DROP FOREIGN KEY journals_current_issue_id_foreign',
    'SELECT "SKIP journals_current_issue_id_foreign"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- announcement_types_assoc_id_foreign
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'announcement_types'
      AND CONSTRAINT_NAME = 'announcement_types_assoc_id_foreign'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE announcement_types DROP FOREIGN KEY announcement_types_assoc_id_foreign',
    'SELECT "SKIP announcement_types_assoc_id_foreign"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- category_settings_category_id_foreign
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'category_settings'
      AND CONSTRAINT_NAME = 'category_settings_category_id_foreign'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE category_settings DROP FOREIGN KEY category_settings_category_id_foreign',
    'SELECT "SKIP category_settings_category_id_foreign"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- review_assignments_review_round_id_foreign
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_assignments'
      AND CONSTRAINT_NAME = 'review_assignments_review_round_id_foreign'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_assignments DROP FOREIGN KEY review_assignments_review_round_id_foreign',
    'SELECT "SKIP review_assignments_review_round_id_foreign"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- review_files_review_id_foreign
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_files'
      AND CONSTRAINT_NAME = 'review_files_review_id_foreign'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_files DROP FOREIGN KEY review_files_review_id_foreign',
    'SELECT "SKIP review_files_review_id_foreign"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- =========================================================
-- SAFE DROP INDEX
-- =========================================================

-- publications_section_id
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publications'
      AND INDEX_NAME = 'publications_section_id'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publications DROP INDEX publications_section_id',
    'SELECT "SKIP publications_section_id"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- publications_primary_contact_id
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publications'
      AND INDEX_NAME = 'publications_primary_contact_id'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publications DROP INDEX publications_primary_contact_id',
    'SELECT "SKIP publications_primary_contact_id"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- category_settings_unique
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'category_settings'
      AND INDEX_NAME = 'category_settings_unique'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE category_settings DROP INDEX category_settings_unique',
    'SELECT "SKIP category_settings_unique"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- announcement_types_assoc_id
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'announcement_types'
      AND INDEX_NAME = 'announcement_types_assoc_id'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE announcement_types DROP INDEX announcement_types_assoc_id',
    'SELECT "SKIP announcement_types_assoc_id"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- review_assignment_reviewer_round
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_assignments'
      AND INDEX_NAME = 'review_assignment_reviewer_round'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_assignments DROP INDEX review_assignment_reviewer_round',
    'SELECT "SKIP review_assignment_reviewer_round"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- review_form_responses_unique
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_form_responses'
      AND INDEX_NAME = 'review_form_responses_unique'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_form_responses DROP INDEX review_form_responses_unique',
    'SELECT "SKIP review_form_responses_unique"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- review_round_files_unique
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_round_files'
      AND INDEX_NAME = 'review_round_files_unique'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_round_files DROP INDEX review_round_files_unique',
    'SELECT "SKIP review_round_files_unique"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- review_files_unique
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_files'
      AND INDEX_NAME = 'review_files_unique'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_files DROP INDEX review_files_unique',
    'SELECT "SKIP review_files_unique"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- scheduled_tasks_unique
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'scheduled_tasks'
      AND INDEX_NAME = 'scheduled_tasks_unique'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE scheduled_tasks DROP INDEX scheduled_tasks_unique',
    'SELECT "SKIP scheduled_tasks_unique"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- =========================================================
-- SAFE DROP COLUMN
-- =========================================================

-- journals.current_issue_id
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'journals'
      AND COLUMN_NAME = 'current_issue_id'
);
SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE journals DROP COLUMN current_issue_id',
    'SELECT "SKIP journals.current_issue_id"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX announcement_type_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'announcement_type_settings'
      AND INDEX_NAME = 'announcement_type_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE announcement_type_settings DROP INDEX announcement_type_settings_unique',
    'SELECT "SKIP announcement_type_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX announcement_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'announcement_settings'
      AND INDEX_NAME = 'announcement_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE announcement_settings DROP INDEX announcement_settings_unique',
    'SELECT "SKIP announcement_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX versions_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'versions'
      AND INDEX_NAME = 'versions_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE versions DROP INDEX versions_unique',
    'SELECT "SKIP versions_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX site_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'site_settings'
      AND INDEX_NAME = 'site_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE site_settings DROP INDEX site_settings_unique',
    'SELECT "SKIP site_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX user_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_settings'
      AND INDEX_NAME = 'user_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE user_settings DROP INDEX user_settings_unique',
    'SELECT "SKIP user_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX notification_settings_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'notification_settings'
      AND INDEX_NAME = 'notification_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE notification_settings DROP INDEX notification_settings_unique',
    'SELECT "SKIP notification_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX email_templates_default_data_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'email_templates_default_data'
      AND INDEX_NAME = 'email_templates_default_data_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE email_templates_default_data DROP INDEX email_templates_default_data_unique',
    'SELECT "SKIP email_templates_default_data_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX review_form_responses_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_form_responses'
      AND INDEX_NAME = 'review_form_responses_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_form_responses DROP INDEX review_form_responses_unique',
    'SELECT "SKIP review_form_responses_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX email_templates_settings_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'email_templates_settings'
      AND INDEX_NAME = 'email_templates_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE email_templates_settings DROP INDEX email_templates_settings_unique',
    'SELECT "SKIP email_templates_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX oai_resumption_tokens_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'oai_resumption_tokens'
      AND INDEX_NAME = 'oai_resumption_tokens_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE oai_resumption_tokens DROP INDEX oai_resumption_tokens_unique',
    'SELECT "SKIP oai_resumption_tokens_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX plugin_settings_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'plugin_settings'
      AND INDEX_NAME = 'plugin_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE plugin_settings DROP INDEX plugin_settings_unique',
    'SELECT "SKIP plugin_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX genre_settings_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'genre_settings'
      AND INDEX_NAME = 'genre_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE genre_settings DROP INDEX genre_settings_unique',
    'SELECT "SKIP genre_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX library_file_settings_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'library_file_settings'
      AND INDEX_NAME = 'library_file_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE library_file_settings DROP INDEX library_file_settings_unique',
    'SELECT "SKIP library_file_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX event_log_settings_unique
-- =========================================================



SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'event_log_settings'
      AND INDEX_NAME = 'event_log_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE event_log_settings DROP INDEX event_log_settings_unique',
    'SELECT "SKIP event_log_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX citation_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'citation_settings'
      AND INDEX_NAME = 'citation_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE citation_settings DROP INDEX citation_settings_unique',
    'SELECT "SKIP citation_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX filter_settings_unique
-- =========================================================


SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'filter_settings'
      AND INDEX_NAME = 'filter_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE filter_settings DROP INDEX filter_settings_unique',
    'SELECT "SKIP filter_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- =========================================================
-- DROP INDEX navigation_menu_item_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'navigation_menu_item_settings'
      AND INDEX_NAME = 'navigation_menu_item_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE navigation_menu_item_settings DROP INDEX navigation_menu_item_settings_unique',
    'SELECT "SKIP navigation_menu_item_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX navigation_menu_item_assignment_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'navigation_menu_item_assignment_settings'
      AND INDEX_NAME = 'navigation_menu_item_assignment_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE navigation_menu_item_assignment_settings DROP INDEX navigation_menu_item_assignment_settings_unique',
    'SELECT "SKIP navigation_menu_item_assignment_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX review_form_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_form_settings'
      AND INDEX_NAME = 'review_form_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_form_settings DROP INDEX review_form_settings_unique',
    'SELECT "SKIP review_form_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- DROP INDEX review_form_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_form_element_settings'
      AND INDEX_NAME = 'review_form_element_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_form_element_settings DROP INDEX review_form_element_settings_unique',
    'SELECT "SKIP review_form_element_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX user_group_settings
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_group_settings'
      AND INDEX_NAME = 'user_group_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE user_group_settings DROP INDEX user_group_settings_unique',
    'SELECT "SKIP user_group_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX user_user_groups
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_user_groups'
      AND INDEX_NAME = 'user_user_groups_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE user_user_groups DROP INDEX user_user_groups_unique',
    'SELECT "SKIP user_user_groups_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX user_group_stage
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_group_stage'
      AND INDEX_NAME = 'user_group_stage_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE user_group_stage DROP INDEX user_group_stage_unique',
    'SELECT "SKIP user_group_stage_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX submission_file_settings
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'submission_file_settings'
      AND INDEX_NAME = 'submission_file_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE submission_file_settings DROP INDEX submission_file_settings_unique',
    'SELECT "SKIP submission_file_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX submission_settings
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'submission_settings'
      AND INDEX_NAME = 'submission_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE submission_settings DROP INDEX submission_settings_unique',
    'SELECT "SKIP submission_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX publication_settings
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'publication_settings'
      AND INDEX_NAME = 'publication_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE publication_settings DROP INDEX publication_settings_unique',
    'SELECT "SKIP publication_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX author_settings
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'author_settings'
      AND INDEX_NAME = 'author_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE author_settings DROP INDEX author_settings_unique',
    'SELECT "SKIP author_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX subeditor_submission_group
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'subeditor_submission_group'
      AND INDEX_NAME = 'section_editors_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE subeditor_submission_group DROP INDEX section_editors_unique',
    'SELECT "SKIP section_editors_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX query_participants
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'query_participants'
      AND INDEX_NAME = 'query_participants_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE query_participants DROP INDEX query_participants_unique',
    'SELECT "SKIP query_participants_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX submission_search_object_keywords
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'submission_search_object_keywords'
      AND INDEX_NAME = 'submission_search_object_keywords_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE submission_search_object_keywords DROP INDEX submission_search_object_keywords_unique',
    'SELECT "SKIP submission_search_object_keywords_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX data_object_tombstone_settings
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'data_object_tombstone_settings'
      AND INDEX_NAME = 'data_object_tombstone_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE data_object_tombstone_settings DROP INDEX data_object_tombstone_settings_unique',
    'SELECT "SKIP data_object_tombstone_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX journal_settings
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'journal_settings'
      AND INDEX_NAME = 'journal_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE journal_settings DROP INDEX journal_settings_unique',
    'SELECT "SKIP journal_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP FK: section_settings_section_id_fk_new
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'section_settings'
      AND CONSTRAINT_NAME = 'section_settings_section_id_fk_new'
      AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE section_settings DROP FOREIGN KEY section_settings_section_id_fk_new',
    'SELECT "SKIP FK section_settings_section_id_fk_new"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP INDEX: section_settings_unique
-- =========================================================

SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'section_settings'
      AND INDEX_NAME = 'section_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE section_settings DROP INDEX section_settings_unique',
    'SELECT "SKIP section_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_form_settings'
      AND INDEX_NAME = 'review_form_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_form_settings DROP INDEX review_form_settings_unique',
    'SELECT "SKIP review_form_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_form_element_settings'
      AND INDEX_NAME = 'review_form_element_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE review_form_element_settings DROP INDEX review_form_element_settings_unique',
    'SELECT "SKIP review_form_element_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- FIX DUPLICATE: issue_settings_unique (SAFE VERSION)
-- =========================================================

-- =========================================================
-- FIX DUPLICATE: issue_settings_fk_idx (SAFE)
-- =========================================================

SET @cnt := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'issue_settings'
      AND INDEX_NAME = 'issue_settings_fk_idx'
);

SET @sql := IF(
    @cnt > 0,
    'SELECT "SKIP issue_settings_fk_idx EXISTS"',
    'ALTER TABLE issue_settings 
     ADD INDEX issue_settings_fk_idx (issue_id)'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- ISSUE SETTINGS SAFE FIX (NO DUPLICATE / NO SELF CONFLICT)
-- =========================================================

-- 1. สร้าง FK index ถ้ายังไม่มี
SET @cnt_fk := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'issue_settings'
      AND INDEX_NAME = 'issue_settings_fk_idx'
);

SET @sql := IF(
    @cnt_fk = 0,
    'ALTER TABLE issue_settings ADD INDEX issue_settings_fk_idx (issue_id)',
    'SELECT "SKIP issue_settings_fk_idx EXISTS"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- 2. ตรวจ unique index
SET @cnt_uq := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'issue_settings'
      AND INDEX_NAME = 'issue_settings_unique'
);

-- 3. drop unique (safe หลังมี FK index แล้ว)
SET @sql := IF(
    @cnt_uq > 0,
    'ALTER TABLE issue_settings DROP INDEX issue_settings_unique',
    'SELECT "SKIP issue_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


-- =========================================================
-- ISSUE GALLEY SETTINGS SAFE FIX
-- =========================================================

SET @cnt := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'issue_galley_settings'
      AND INDEX_NAME = 'issue_galley_settings_unique'
);

SET @sql := IF(
    @cnt > 0,
    'SELECT "SKIP issue_galley_settings_unique EXISTS"',
    'ALTER TABLE issue_galley_settings 
     ADD UNIQUE issue_galley_settings_unique (galley_id, locale, setting_name)'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- FIX DUPLICATE: issue_galley_settings_unique (SAFE)
-- =========================================================

-- 1. เช็คว่า index มีอยู่แล้วหรือไม่
SET @cnt := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'issue_galley_settings'
      AND INDEX_NAME = 'issue_galley_settings_unique'
);

-- 2. ถ้ามีอยู่แล้ว → ข้าม
SET @sql := IF(
    @cnt > 0,
    'SELECT "SKIP issue_galley_settings_unique EXISTS"',
    'ALTER TABLE issue_galley_settings 
     ADD UNIQUE issue_galley_settings_unique (galley_id, locale, setting_name)'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- FIX UPGRADE ERROR: review_form_responses_unique (DUPLICATE INDEX SAFE FIX)
-- =========================================================

-- ตรวจว่ามี index อยู่แล้วหรือไม่
SET @cnt := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_form_responses'
      AND INDEX_NAME = 'review_form_responses_unique'
);

-- ถ้ามีอยู่แล้วให้ drop ก่อน (ป้องกัน duplicate key error)
SET @sql := IF(
    @cnt > 0,
    'ALTER TABLE review_form_responses DROP INDEX review_form_responses_unique',
    'SELECT "SKIP DROP review_form_responses_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- FIX UPGRADE ERROR: issue_galley_settings_unique (DUPLICATE INDEX SAFE FIX)
-- =========================================================

-- ตรวจสอบ index
SET @cnt := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'issue_galley_settings'
      AND INDEX_NAME = 'issue_galley_settings_unique'
);

-- ถ้ามีอยู่แล้วให้ drop ก่อนกัน duplicate error
SET @sql := IF(
    @cnt > 0,
    'ALTER TABLE issue_galley_settings DROP INDEX issue_galley_settings_unique',
    'SELECT "SKIP DROP issue_galley_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- FIX UPGRADE ERROR: custom_issue_orders_unique (DUPLICATE INDEX SAFE FIX)
-- =========================================================

-- ตรวจสอบ index
SET @cnt := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'custom_issue_orders'
      AND INDEX_NAME = 'custom_issue_orders_unique'
);

-- ถ้ามีอยู่แล้วให้ drop ก่อนกัน duplicate error
SET @sql := IF(
    @cnt > 0,
    'ALTER TABLE custom_issue_orders DROP INDEX custom_issue_orders_unique',
    'SELECT "SKIP DROP custom_issue_orders_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- FIX UPGRADE ERROR: custom_section_orders_unique (DUPLICATE INDEX SAFE FIX)
-- =========================================================

-- ตรวจสอบ index
SET @cnt := (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'custom_section_orders'
      AND INDEX_NAME = 'custom_section_orders_unique'
);

-- ถ้ามีอยู่แล้วให้ drop ก่อนกัน duplicate error
SET @sql := IF(
    @cnt > 0,
    'ALTER TABLE custom_section_orders DROP INDEX custom_section_orders_unique',
    'SELECT "SKIP DROP custom_section_orders_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- 1. DROP FOREIGN KEY ดอกที่ 1: pub_galley_settings_id_fk_v4
-- =========================================================
SET @cnt_fk1 = (
    SELECT COUNT(*) FROM information_schema.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'publication_galley_settings'
    AND CONSTRAINT_NAME = 'pub_galley_settings_id_fk_v4'
);

SET @sql_fk1 = IF(@cnt_fk1 > 0, 
    'ALTER TABLE publication_galley_settings DROP FOREIGN KEY pub_galley_settings_id_fk_v4', 
    'SELECT "SKIP FK pub_galley_settings_id_fk_v4"');

PREPARE stmt_fk1 FROM @sql_fk1; EXECUTE stmt_fk1; DEALLOCATE PREPARE stmt_fk1;

-- =========================================================
-- 2. DROP FOREIGN KEY ดอกที่ 2: publication_galley_settings_galley_id
-- =========================================================
SET @cnt_fk2 = (
    SELECT COUNT(*) FROM information_schema.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'publication_galley_settings'
    AND CONSTRAINT_NAME = 'publication_galley_settings_galley_id'
);

SET @sql_fk2 = IF(@cnt_fk2 > 0, 
    'ALTER TABLE publication_galley_settings DROP FOREIGN KEY publication_galley_settings_galley_id', 
    'SELECT "SKIP FK publication_galley_settings_galley_id"');

PREPARE stmt_fk2 FROM @sql_fk2; EXECUTE stmt_fk2; DEALLOCATE PREPARE stmt_fk2;

-- =========================================================
-- 3. DROP INDEX (บรรทัดเดิมของคุณ - ตอนนี้จะลบผ่านฉลุยแล้วครับ)
-- =========================================================
SET @cnt = (
    SELECT COUNT(*) FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'publication_galley_settings'
    AND INDEX_NAME = 'publication_galley_settings_unique'
);

SET @sql = IF(@cnt > 0, 
    'ALTER TABLE publication_galley_settings DROP INDEX publication_galley_settings_unique', 
    'SELECT "SKIP publication_galley_settings_unique"');

PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- =========================================================
-- 1. DROP FOREIGN KEY (ปลดล็อกกุญแจที่ล็อกบานพับไว้ก่อน)
-- =========================================================
SET @cnt_fk = (
    SELECT COUNT(*)
    FROM information_schema.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'subscription_type_settings'
      AND CONSTRAINT_NAME = 'subscription_type_settings_type_id'
);

SET @sql_fk = IF(
    @cnt_fk > 0,
    'ALTER TABLE subscription_type_settings DROP FOREIGN KEY subscription_type_settings_type_id',
    'SELECT "SKIP FK subscription_type_settings_type_id"'
);

PREPARE stmt_fk FROM @sql_fk;
EXECUTE stmt_fk;
DEALLOCATE PREPARE stmt_fk;

-- =========================================================
-- 2. DROP INDEX (บรรทัด 1438 เดิมของคุณ - รันต่อได้เลย)
-- =========================================================
SET @cnt = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'subscription_type_settings'
      AND INDEX_NAME = 'subscription_type_settings_unique'
);

SET @sql = IF(
    @cnt > 0,
    'ALTER TABLE subscription_type_settings DROP INDEX subscription_type_settings_unique',
    'SELECT "SKIP subscription_type_settings_unique"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================
-- DROP FOREIGN KEY review_assignments_submission_id_foreign
-- ป้องกัน Error 1826: Duplicate foreign key constraint name
-- =========================================================

SET @cnt_fk = (
    SELECT COUNT(*)
    FROM information_schema.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_assignments'
      AND CONSTRAINT_NAME = 'review_assignments_submission_id_foreign'
);

SET @sql_fk = IF(
    @cnt_fk > 0,
    'ALTER TABLE review_assignments DROP FOREIGN KEY review_assignments_submission_id_foreign',
    'SELECT "SKIP FK review_assignments_submission_id_foreign"'
);

PREPARE stmt FROM @sql_fk;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =========================================================
-- แถม: ตรวจสอบและลบ INDEX ที่ชื่อซ้ำกันด้วย (ป้องกันด่านถัดไป)
-- =========================================================

SET @cnt_idx = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'review_assignments'
      AND INDEX_NAME = 'review_assignments_submission_id'
);

SET @sql_idx = IF(
    @cnt_idx > 0,
    'ALTER TABLE review_assignments DROP INDEX review_assignments_submission_id',
    'SELECT "SKIP INDEX review_assignments_submission_id"'
);

PREPARE stmt_idx FROM @sql_idx;
EXECUTE stmt_idx;
DEALLOCATE PREPARE stmt_idx;

-- =========================================================
-- END OF FK INDEX
-- =========================================================
SET FOREIGN_KEY_CHECKS = 1;