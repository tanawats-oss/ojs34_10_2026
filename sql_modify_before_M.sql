USE ojs_new;

-- 1. เคลียร์ข้อมูลเจ้าปัญหา
 DELETE FROM journal_settings WHERE setting_name = 'submissionChecklist';

-- 2. เติมข้อมูล Contact (ใช้ค่าที่คุณเตรียมมา)
 INSERT INTO journal_settings (journal_id, locale, setting_name, setting_value) VALUES 
 (19, 'en', 'contactName', 'Administrator'), (19, 'en', 'contactEmail', 'admin@example.com'),
 (50, 'en', 'contactName', 'Administrator'), (50, 'en', 'contactEmail', 'admin@example.com'),
 (8, 'en', 'contactName', 'Administrator'), (8, 'en', 'contactEmail', 'admin@example.com'),
 (15, 'en', 'contactName', 'Administrator'), (15, 'en', 'contactEmail', 'admin@example.com')
 ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

-- 3. อุดรูรั่วตาราง journals (ป้องกัน Contact Email ว่าง)
 UPDATE journals SET contact_email = 'admin@example.com' WHERE contact_email IS NULL OR contact_email = '';

-- 4. สร้างคอลัมน์และ Index หลอก (กันเหนียวถ้าตัวเดิมไม่มี)
 ALTER TABLE event_log ADD COLUMN  user_id BIGINT;
 CREATE INDEX  event_log_user_id ON event_log (user_id);

-- 5. เตรียมโครงสร้างรองรับ Pre-flight check (สำคัญมาก)
 ALTER TABLE issue_settings ADD COLUMN  setting_type VARCHAR(6);
 ALTER TABLE journal_settings ADD COLUMN  setting_type VARCHAR(6);
 ALTER TABLE section_settings ADD COLUMN  setting_type VARCHAR(6);
 ALTER TABLE announcement_types ADD COLUMN  assoc_id BIGINT;

USE ojs_new;
-- สร้าง Index กลับคืนไปเพื่อให้ตัว Upgrade สั่ง DROP ได้สำเร็จ
CREATE INDEX event_log_user_id ON event_log (user_id);

-- 6. ปรับจูน Performance
SET GLOBAL innodb_buffer_pool_size = 4294967296; 
SET GLOBAL innodb_flush_log_at_trx_commit = 2;
SET FOREIGN_KEY_CHECKS = 0;
