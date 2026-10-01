SQL CHECK FK TABLE--------------------------------------------------------------------------------------

SHOW CREATE TABLE category_settings;

SQL FIX announcement_types  ---------------------------------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;
-- ลบ Index ชื่อเก่าที่ยังค้างอยู่ (ถ้ามี)
ALTER TABLE announcement_types DROP INDEX  announcement_types_context_id;
-- สร้าง Index ให้ชื่อตรงกับคอลัมน์ assoc_id
ALTER TABLE announcement_types ADD INDEX  announcement_types_assoc_id (assoc_id);
SET FOREIGN_KEY_CHECKS = 1;



SQL FIX COLUMN current_issue_id; ------------------------------------------------------------
-- 1. ปิดเช็ก FK
SET FOREIGN_KEY_CHECKS = 0;
-- 1. ล้างทางเชื่อม (Foreign Key) ที่ล็อกคอลัมน์นี้ไว้ก่อน
ALTER TABLE journals DROP FOREIGN KEY journals_current_issue_id_foreign;
ALTER TABLE journals DROP COLUMN current_issue_id;

-- 3. เปิดเช็ก FK กลับมา
SET FOREIGN_KEY_CHECKS = 1;



SQL FIX COLUMN current -------------------------------------------------------------------------------
-- 1. ปิดเช็ก FK
SET FOREIGN_KEY_CHECKS = 0;

-- 1. สร้างคอลัมน์ current กลับมาหลอกระบบชั่วคราว
-- ใช้ TINYINT(1) และ Default 0 เพื่อให้ Query ที่สั่ง "where current = 1" ทำงานได้ไม่พัง
ALTER TABLE issues ADD COLUMN current TINYINT NOT NULL DEFAULT 0;
-- 3. เปิดเช็ก FK กลับมา
SET FOREIGN_KEY_CHECKS = 1;



SQL FROM DELTE INDEX FK  -----------------------------------------------------------------------------------------
-- 1. ปิดเช็ก FK
SET FOREIGN_KEY_CHECKS = 0;

-- 2. ลบเฉพาะตัวที่ Error ล่าสุดแจ้ง (สมมติว่าเป็นตัว review_form_responses)
ALTER TABLE review_form_responses DROP INDEX review_form_responses_unique;
ALTER TABLE review_round_files DROP INDEX review_round_files_unique;
ALTER TABLE scheduled_tasks DROP INDEX scheduled_tasks_unique;
ALTER TABLE review_files DROP INDEX review_files_unique;
ALTER TABLE announcement_type_settings DROP INDEX announcement_type_settings_unique;
ALTER TABLE announcement_settings DROP INDEX announcement_settings_unique;

--ALTER TABLE category_settings DROP FOREIGN KEY category_settings_category_id_foreign;
--ALTER TABLE category_settings DROP INDEX category_settings_unique;
--ALTER TABLE versions DROP INDEX versions_unique;

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

ALTER TABLE navigation_menu_item_assignment_settings DROP FOREIGN KEY assignment_settings_navigation_menu_item_assignment_id;
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
ALTER TABLE journal_settings DROP INDEX journal_settings_unique;

ALTER TABLE section_settings DROP FOREIGN KEY section_settings_section_id;
ALTER TABLE section_settings DROP INDEX section_settings_unique;


ALTER TABLE issue_settings DROP FOREIGN KEY issue_settings_issue_id;
ALTER TABLE issue_settings DROP INDEX issue_settings_unique;
ALTER TABLE issue_galley_settings DROP INDEX issue_galley_settings_unique;
ALTER TABLE custom_issue_orders DROP INDEX custom_issue_orders_unique;
ALTER TABLE custom_section_orders DROP INDEX custom_section_orders_unique;

ALTER TABLE publication_galley_settings DROP FOREIGN KEY pub_galley_settings_id_fk_v4;
ALTER TABLE publication_galley_settings DROP INDEX publication_galley_settings_unique;
ALTER TABLE subscription_type_settings DROP INDEX subscription_type_settings_unique;

ALTER TABLE publications DROP FOREIGN KEY publications_url_path;
ALTER TABLE publications DROP FOREIGN KEY publications_doi_id;
ALTER TABLE publications DROP FOREIGN KEY publications_primary_contact_id;
ALTER TABLE publications DROP FOREIGN KEY fk_pub_journal_v34_final;
ALTER TABLE publications DROP FOREIGN KEY pub_section_id_x34;
ALTER TABLE publications DROP FOREIGN KEY pub_submission_id_x34;
 
 ALTER TABLE publications DROP INDEX publications_section_id;

-- ลบ Index ชื่อเก่าที่ยังค้างอยู่ (ถ้ามี)
ALTER TABLE announcement_types DROP INDEX  announcement_types_context_id;
-- สร้าง Index ให้ชื่อตรงกับคอลัมน์ assoc_id
ALTER TABLE announcement_types ADD INDEX  announcement_types_assoc_id (assoc_id);

-- 1. จัดการตาราง journals (ต้องไม่มีคอลัมน์ current_issue_id เพื่อให้มันสร้างใหม่ได้)
ALTER TABLE journals DROP FOREIGN KEY  journals_current_issue_id_foreign;
ALTER TABLE journals DROP COLUMN  current_issue_id;
-- 3. จัดการตาราง announcement_types (ด่านก่อนหน้าที่คุณแก้ไว้แล้ว)
-- เช็คให้แน่ใจว่าชื่อเป็น assoc_id และไม่มี Index ซ้ำ
ALTER TABLE announcement_types CHANGE context_id assoc_id BIGINT;
ALTER TABLE announcement_types DROP INDEX  announcement_types_context_id;





-- 3. เปิดเช็ก FK กลับมา
SET FOREIGN_KEY_CHECKS = 1;



-----------------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;

-- ลบ Index ที่มันบ่นว่า Duplicate ออก เพื่อให้ Script สั่งสร้างใหม่ (Add) ได้สำเร็จ
ALTER TABLE category_settings DROP INDEX category_settings_unique;

SET FOREIGN_KEY_CHECKS = 1;
------------------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- 1. เคลียร์ตัวที่ Error ล่าสุดฟ้อง (Duplicate FK ใน publications)
ALTER TABLE publications DROP FOREIGN KEY  publications_section_id;
-- แถม: ลบ Index ที่ชื่อเดียวกันออกด้วยเพื่อความชัวร์
ALTER TABLE publications DROP INDEX  publications_section_id;

-- 2. เคลียร์ตัวที่ติดล็อกตอน Downgrade (category_settings)
-- สาเหตุที่มัน DROP INDEX ไม่ได้ เพราะมี FK ล็อกอยู่ ต้องเอา FK ออกก่อนครับ
ALTER TABLE category_settings DROP FOREIGN KEY  category_settings_category_id_foreign;
ALTER TABLE category_settings DROP INDEX  category_settings_unique;

-- 3. เคลียร์เผื่อตารางอื่นๆ ที่ชอบมีปัญหาในด่าน AddForeignKeys
ALTER TABLE submission_files DROP FOREIGN KEY  submission_files_submission_id_foreign;
ALTER TABLE navigation_menu_item_assignment_settings DROP FOREIGN KEY  assignment_settings_navigation_menu_item_assignment_id;

SET FOREIGN_KEY_CHECKS = 1;

--------------------------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;

-- 1. แก้ปัญหา Unknown column 'i.current'
-- สร้างคอลัมน์ current กลับมาให้มันเห็น (ถ้ามีอยู่แล้วมันจะข้ามไปเอง)
ALTER TABLE issues ADD COLUMN  current TINYINT NOT NULL DEFAULT 0;

-- 2. แถม: เคลียร์ตาราง journals (ตัดโซ่ FK และลบคอลัมน์เจ้าปัญหา)
ALTER TABLE journals DROP FOREIGN KEY  journals_current_issue_id_foreign;
ALTER TABLE journals DROP COLUMN  current_issue_id;

-- 3. แถม: เคลียร์ตาราง announcement_types (กันเหนียวเรื่อง assoc_id)
ALTER TABLE announcement_types ADD COLUMN  assoc_id BIGINT;
UPDATE announcement_types SET assoc_id = context_id WHERE assoc_id IS NULL OR assoc_id = 0;

SET FOREIGN_KEY_CHECKS = 1;




CMD UP------------------------------------------------------------------------------------

sudo systemctl daemon-reload
sudo systemctl restart apache2


rm -rf /var/www/html/ojs/cache/*.php
rm -rf /var/www/html/ojs/cache/*.dat
rm -rf /var/www/html/ojs/cache/t_compile/*.php
rm -rf /var/www/html/ojs/cache/opcache/*
php /var/www/html/ojs/tools/upgrade.php upgrade
sudo -u www-data php /var/www/html/ojs/tools/upgrade.php upgrade


sudo rm -f /var/www/html/ojs/cache/*.php
sudo rm -f /var/www/html/ojs/cache/*.dat
sudo rm -rf /var/www/html/ojs/cache/t_compile/*.php
sudo rm -rf /var/www/html/ojs/cache/opcache/*
sudo -u www-data php /var/www/html/ojs/tools/upgrade.php upgrade

CMD find ---------------------------------------------------------------------------------
grep -rn "at.assoc_id" .

OTHER ----------------------------------------------------------
nano cleanup.sql

mysql -u user -p -f db < cleanup.sql


sudo rm -rf /var/www/html/ojs/cache/*.{php,dat}
sudo rm -rf /var/www/html/ojs/cache/t_compile/*.php
sudo systemctl restart apache2
sudo -u www-data php /var/www/html/ojs/tools/upgrade.php upgrade



sudo rm -rf /var/www/html/ojs/cache/*.php
sudo rm -rf /var/www/html/ojs/cache/*.dat
sudo rm -rf /var/www/html/ojs/cache/t_compile/*.php
sudo rm -rf /var/www/html/ojs/cache/_db/*.php
sudo -u www-data php /var/www/html/ojs/tools/upgrade.php upgrade