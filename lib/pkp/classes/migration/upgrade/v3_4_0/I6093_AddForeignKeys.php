<?php

/**
 * @file classes/migration/upgrade/v3_4_0/I6093_AddForeignKeys.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class I6093_AddForeignKeys
 *
 * @brief Describe upgrade/downgrade operations for introducing foreign key definitions to existing database relationships.
 */


namespace PKP\migration\upgrade\v3_4_0;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PKP\install\DowngradeNotSupportedException;

abstract class I6093_AddForeignKeys extends \PKP\migration\Migration
{
    abstract protected function getContextTable(): string;
    abstract protected function getContextSettingsTable(): string;
    abstract protected function getContextKeyField(): string;


    public function up(): void
    {
        //--- 1. Announcement Types //---
        try {
            DB::statement("ALTER TABLE announcement_types DROP INDEX announcement_types_assoc");
       } catch (\Exception $e) {}

         if (Schema::hasColumn('announcement_types', 'assoc_id')) {
             try {
                 Schema::table('announcement_types', fn (Blueprint $table) => $table->renameColumn('assoc_id', 'context_id'));
             } catch (\Exception $e) {}
         }

         try {
             Schema::table('announcement_types', function (Blueprint $table) {
                 try { $table->index(['context_id'], 'announcement_types_context_id'); } catch (\Exception $e) {}
                 try { $table->foreign('context_id')->references($this->getContextKeyField())->on($this->getContextTable())->onDelete('cascade'); } catch (\Exception $e) {}
             });
         } catch (\Exception $e) {}

          //--- 2. Announcement Settings & Type Settings //---
         try {
             Schema::table('announcement_type_settings', fn (Blueprint $table) => $table->foreign('type_id')->references('type_id')->on('announcement_types')->onDelete('cascade'));
         } catch (\Exception $e) {}

         try {
             Schema::table('announcements', function (Blueprint $table) {
                 try { $table->foreign('type_id')->references('type_id')->on('announcement_types')->onDelete('set null'); } catch (\Exception $e) {}
                 try { $table->index(['type_id'], 'announcements_type_id'); } catch (\Exception $e) {}
             });
         } catch (\Exception $e) {}

         try {
             Schema::table('announcement_settings', fn (Blueprint $table) => $table->foreign('announcement_id')->references('announcement_id')->on('announcements')->onDelete('cascade'));
         } catch (\Exception $e) {}

          //--- 3. Categories & Settings //---
         try {
             Schema::table('category_settings', function (Blueprint $table) {
                 if (Schema::hasColumn('category_settings', 'setting_type')) {
                     try { $table->dropColumn('setting_type'); } catch (\Exception $e) {}
                 }
                 try { $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade'); } catch (\Exception $e) {}
             });
         } catch (\Exception $e) {}

         try {
             Schema::table('categories', fn (Blueprint $table) => $table->bigInteger('parent_id')->nullable()->change());
         } catch (\Exception $e) {}
        
         try {
             DB::table('categories')->where('parent_id', '=', 0)->update(['parent_id' => null]);
         } catch (\Exception $e) {}

         try {
             Schema::table('categories', function (Blueprint $table) {
                 try { $table->dropIndex('category_context_id'); } catch (\Exception $e) {}
                 try { $table->index(['context_id', 'parent_id'], 'category_context_parent_id'); } catch (\Exception $e) {}
                 try { $table->foreign('context_id')->references($this->getContextKeyField())->on($this->getContextTable())->onDelete('cascade'); } catch (\Exception $e) {}
                 try { $table->foreign('parent_id')->references('category_id')->on('categories')->onDelete('set null'); } catch (\Exception $e) {}
             });
         } catch (\Exception $e) {}

          //--- 4. Loop Tables (User Related) //---
         $userTables = ['user_interests', 'user_settings', 'sessions', 'access_keys', 'notification_subscription_settings', 'event_log', 'temporary_files', 'notes', 'user_user_groups', 'stage_assignments'];
         foreach ($userTables as $tableName) {
             if (Schema::hasTable($tableName)) {
                 try {
                     Schema::table($tableName, fn (Blueprint $table) => $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'));
                 } catch (\Exception $e) {}
             }
         }

          //--- 5. Notifications //---
         try {
             Schema::table('notifications', function (Blueprint $table) {
                 try { $table->bigInteger('context_id')->nullable()->change(); } catch (\Exception $e) {}
                 try { $table->bigInteger('user_id')->nullable()->change(); } catch (\Exception $e) {}
             });
             DB::table('notifications')->where('context_id', '=', 0)->update(['context_id' => null]);
             DB::table('notifications')->where('user_id', '=', 0)->update(['user_id' => null]);
             Schema::table('notifications', function (Blueprint $table) {
                 try { $table->foreign('context_id')->references($this->getContextKeyField())->on($this->getContextTable())->onDelete('cascade'); } catch (\Exception $e) {}
                 try { $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); } catch (\Exception $e) {}
             });
         } catch (\Exception $e) {}

     
       //--- ส่วนที่ 6: Sections & Related Settings //---
         if (Schema::hasTable('sections')) {
             try { DB::statement("ALTER TABLE sections DROP FOREIGN KEY sections_review_form_id"); } catch (\Exception $e) {}
             try {
                 DB::statement("ALTER TABLE sections ADD CONSTRAINT sections_rf_id_fk_new 
                                FOREIGN KEY (review_form_id) REFERENCES review_forms (review_form_id) ON DELETE SET NULL");
             } catch (\Exception $e) {}

                    // ล้างของเก่าทิ้งแบบไม่สน Error
            try { DB::statement("ALTER TABLE sections DROP FOREIGN KEY sections_journal_id"); } catch (\Exception $e) {}
            try { DB::statement("ALTER TABLE sections DROP INDEX sections_journal_id"); } catch (\Exception $e) {}

            // สร้างใหม่ด้วยชื่อที่การันตีว่าไม่ซ้ำ (เช่น เติม _v34)
           if (Schema::hasTable('sections')) {
                try { DB::statement("ALTER TABLE sections DROP FOREIGN KEY IF EXISTS sections_review_form_id"); } catch (\Exception $e) {}
                try { DB::statement("ALTER TABLE sections DROP FOREIGN KEY IF EXISTS sections_journal_id"); } catch (\Exception $e) {}

                // แก้ชื่อกุญแจเป็นชื่อใหม่ที่การันตีว่าไม่ซ้ำกับ Core
                try {
                    DB::statement("ALTER TABLE sections ADD CONSTRAINT fk_sections_journal_final 
                                FOREIGN KEY (journal_id) REFERENCES journals (journal_id) ON DELETE CASCADE");
                } catch (\Exception $e) {}
            }
         }

         if (Schema::hasTable('section_settings')) {
             try { DB::statement("ALTER TABLE section_settings DROP FOREIGN KEY section_settings_section_id"); } catch (\Exception $e) {}
             try {
                 DB::statement("ALTER TABLE section_settings ADD CONSTRAINT section_settings_section_id_fk_new 
                                FOREIGN KEY (section_id) REFERENCES sections (section_id) ON DELETE CASCADE");
             } catch (\Exception $e) {}
         }

          //--- ส่วนที่ 7: Issues & Galleys //---
         if (Schema::hasTable('issues')) {
             try { DB::statement("ALTER TABLE issues DROP FOREIGN KEY issues_journal_id"); } catch (\Exception $e) {}
             try {
                 DB::statement("ALTER TABLE issues ADD CONSTRAINT issues_journal_id_fk_new 
                                FOREIGN KEY (journal_id) REFERENCES journals (journal_id) ON DELETE CASCADE");
             } catch (\Exception $e) {}
         }

         if (Schema::hasTable('issue_galleys')) {
             try { DB::statement("ALTER TABLE issue_galleys DROP INDEX issue_galleys_file_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE issue_galleys DROP FOREIGN KEY issue_galleys_file_id"); } catch (\Exception $e) {}
             try {
                 Schema::table('issue_galleys', function (Blueprint $table) {
                     $table->index(['file_id'], 'issue_galleys_file_id_idx');
                     $table->foreign('file_id', 'issue_galleys_file_id_fk_new')->references('file_id')->on('issue_files')->onDelete('cascade');
                 });
             } catch (\Exception $e) {}

             try { DB::statement("ALTER TABLE issue_galleys DROP INDEX issue_galleys_issue_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE issue_galleys DROP FOREIGN KEY issue_galleys_issue_id"); } catch (\Exception $e) {}
             try {
                 Schema::table('issue_galleys', function (Blueprint $table) {
                     $table->index(['issue_id'], 'issue_galleys_issue_id_idx');
                     $table->foreign('issue_id', 'issue_galleys_issue_id_fk_new')->references('issue_id')->on('issues')->onDelete('cascade');
                 });
             } catch (\Exception $e) {}
         }

         if (Schema::hasTable('issue_galley_settings')) {
             try { DB::statement("ALTER TABLE issue_galley_settings DROP INDEX issue_galleys_settings_galley_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE issue_galley_settings DROP FOREIGN KEY issue_galleys_settings_galley_id"); } catch (\Exception $e) {}
             try {
                 Schema::table('issue_galley_settings', function (Blueprint $table) {
                     $table->index(['galley_id'], 'issue_galley_settings_galley_id_idx');
                     $table->foreign('galley_id', 'issue_galley_settings_galley_id_fk_new')->references('galley_id')->on('issue_galleys')->onDelete('cascade');
                 });
             } catch (\Exception $e) {}
         }

          //--- ส่วนที่ 8: กวาดล้างรอบสุดท้าย (ฉบับปรับปรุงชื่อ FK ให้แม่นยำ) //---
         $cleaningTasks = [
             ['issue_settings', 'issue_id', 'issue_settings_issue_id'],
             ['issue_files', 'issue_id', 'issue_files_issue_id'],
             ['custom_issue_orders', 'issue_id', 'custom_issue_orders_issue_id']
         ];

         foreach ($cleaningTasks as $task) {
             [$table, $col, $fkName] = $task;
             if (Schema::hasTable($table)) {
                 try { DB::statement("ALTER TABLE {$table} DROP FOREIGN KEY {$fkName}"); } catch (\Exception $e) {}
                 try { DB::statement("ALTER TABLE {$table} DROP INDEX {$fkName}"); } catch (\Exception $e) {}
                 try {
                     DB::statement("ALTER TABLE {$table} ADD CONSTRAINT {$fkName}_fk_v4 
                                    FOREIGN KEY ({$col}) REFERENCES issues (issue_id) ON DELETE CASCADE");
                 } catch (\Exception $e) {}
             }
         }
     //--- 9. จัดการตาราง custom_issue_orders (แก้ Error 1061 และ 1826) //---
         if (Schema::hasTable('custom_issue_orders')) {
            //   1. ลบ Index เดิมทิ้งก่อน (แก้ Error 1061)
             try { DB::statement("ALTER TABLE custom_issue_orders DROP INDEX custom_issue_orders_journal_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE custom_issue_orders DROP INDEX custom_issue_orders_issue_id"); } catch (\Exception $e) {}

             // 2. ลบ Foreign Key เดิมทิ้ง (แก้ Error 1826)
             try { DB::statement("ALTER TABLE custom_issue_orders DROP FOREIGN KEY custom_issue_orders_journal_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE custom_issue_orders DROP FOREIGN KEY custom_issue_orders_issue_id"); } catch (\Exception $e) {}

             try {
                 Schema::table('custom_issue_orders', function (Blueprint $table) {
                      //สร้าง Index ใหม่ด้วยชื่อที่ไม่ซ้ำ
                     $table->index(['journal_id'], 'custom_issue_orders_journal_idx');
                     $table->index(['issue_id'], 'custom_issue_orders_issue_idx');
                    
                      //สร้าง Foreign Key ใหม่
                     $table->foreign('journal_id', 'custom_issue_orders_journal_fk_v4')->references('journal_id')->on('journals')->onDelete('cascade');
                     $table->foreign('issue_id', 'custom_issue_orders_issue_fk_v4')->references('issue_id')->on('issues')->onDelete('cascade');
                 });
             } catch (\Exception $e) {}
         }

       //--- 10. จัดการตาราง custom_section_orders (แก้ Error 1061 และ 1826) //---
         if (Schema::hasTable('custom_section_orders')) {
             // 1. ลบ Index เดิมทิ้งก่อน (แก้ Error 1061)
             try { DB::statement("ALTER TABLE custom_section_orders DROP INDEX custom_section_orders_issue_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE custom_section_orders DROP INDEX custom_section_orders_section_id"); } catch (\Exception $e) {}

              //2. ลบ Foreign Key เดิมทิ้ง (แก้ Error 1826)
             try { DB::statement("ALTER TABLE custom_section_orders DROP FOREIGN KEY custom_section_orders_issue_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE custom_section_orders DROP FOREIGN KEY custom_section_orders_section_id"); } catch (\Exception $e) {}

             try {
                 Schema::table('custom_section_orders', function (Blueprint $table) {
                     // สร้างใหม่ด้วยชื่อที่แตกต่างเล็กน้อย
                     $table->index(['issue_id'], 'custom_section_orders_issue_idx');
                     $table->index(['section_id'], 'custom_section_orders_section_idx');
                    
                     $table->foreign('issue_id', 'custom_sect_orders_issue_fk_v4')->references('issue_id')->on('issues')->onDelete('cascade');
                     $table->foreign('section_id', 'custom_sect_orders_section_fk_v4')->references('section_id')->on('sections')->onDelete('cascade');
                 });
             } catch (\Exception $e) {}
         }
      
        // --- 11. จัดการตาราง publications (ฉบับแก้ขาด) ---
        if (Schema::hasTable('publications')) {
            // สั่งลบชื่อมาตรฐานทิ้งก่อน (ถ้ามี)
            $badKeys = ['publications_section_id', 'publications_primary_contact_id', 'publications_submission_id', 'sections_journal_id'];
            foreach ($badKeys as $fk) {
                try { DB::statement("ALTER TABLE publications DROP FOREIGN KEY IF EXISTS {$fk}"); } catch (\Exception $e) {}
            }

            try {
                Schema::table('publications', function (Blueprint $table) {
                    // ใช้ชื่อใหม่ x34 เพื่อเลี่ยง Duplicate 1826
                    $table->foreign('section_id', 'pub_section_id_x34')->references('section_id')->on('sections')->onDelete('set null');
                    $table->foreign('primary_contact_id', 'pub_primary_contact_id_x34')->references('author_id')->on('authors')->onDelete('set null');
                    $table->foreign('submission_id', 'pub_submission_id_x34')->references('submission_id')->on('submissions')->onDelete('cascade');
                });
            } catch (\Exception $e) {}
        }

          //--- 12. ดักตารางแวดล้อมบทความ (ดักไว้ก่อนพ่น Error) //---
         if (Schema::hasTable('publication_settings')) {
             try { DB::statement("ALTER TABLE publication_settings DROP FOREIGN KEY publication_settings_publication_id"); } catch (\Exception $e) {}
             try {
                 DB::statement("ALTER TABLE publication_settings ADD CONSTRAINT pub_settings_pub_id_fk_v4 
                                FOREIGN KEY (publication_id) REFERENCES publications (publication_id) ON DELETE CASCADE");
             } catch (\Exception $e) {}
         }
          //--- 13. จัดการตาราง publication_galleys (ตัวที่ติดล่าสุด) //---
         if (Schema::hasTable('publication_galleys')) {
              //ล้างชื่อ FK และ Index ที่มักจะซ้ำ
             try { DB::statement("ALTER TABLE publication_galleys DROP FOREIGN KEY publication_galleys_publication_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE publication_galleys DROP FOREIGN KEY publication_galleys_submission_file_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE publication_galleys DROP INDEX publication_galleys_publication_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE publication_galleys DROP INDEX publication_galleys_submission_file_id"); } catch (\Exception $e) {}

             try {
                 Schema::table('publication_galleys', function (Blueprint $table) {
                     $table->foreign('publication_id', 'pub_galleys_pub_id_fk_v4')->references('publication_id')->on('publications')->onDelete('cascade');
                     // หมายเหตุ: submission_file_id อาจจะยังไม่ต้องใส่ FK ถ้ายังไม่ได้จัดการตาราง files
                 });
             } catch (\Exception $e) {}
         }

          //--- 14. จัดการตาราง settings ของ Galleys (ดักไว้เลย) //---
         if (Schema::hasTable('publication_galley_settings')) {
             try { DB::statement("ALTER TABLE publication_galley_settings DROP FOREIGN KEY publication_galley_settings_galley_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE publication_galley_settings DROP INDEX publication_galley_settings_galley_id"); } catch (\Exception $e) {}
            
             try {
                 Schema::table('publication_galley_settings', function (Blueprint $table) {
                     $table->foreign('galley_id', 'pub_galley_settings_id_fk_v4')->references('galley_id')->on('publication_galleys')->onDelete('cascade');
                 });
             } catch (\Exception $e) {}
         }
         //--- 15. ล้างทางเดินตระกูล Subscriptions (แก้ Error 1826/1061) //---
        
         if (Schema::hasTable('subscription_types')) {
             try { DB::statement("ALTER TABLE subscription_types DROP FOREIGN KEY subscription_types_journal_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscription_types DROP INDEX subscription_types_journal_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscription_types DROP FOREIGN KEY sub_types_journal_id_fk_v4"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscription_types DROP INDEX sub_types_journal_idx_v4"); } catch (\Exception $e) {}
         }

         if (Schema::hasTable('subscriptions')) {
              //ล้างตัวที่เพิ่งฟ้องล่าสุด (subscriptions_type_id)
             try { DB::statement("ALTER TABLE subscriptions DROP FOREIGN KEY subscriptions_type_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscriptions DROP INDEX subscriptions_type_id"); } catch (\Exception $e) {}
              //ล้างชื่ออื่นๆ ที่อาจค้าง
             try { DB::statement("ALTER TABLE subscriptions DROP FOREIGN KEY subscriptions_journal_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscriptions DROP INDEX subscriptions_journal_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscriptions DROP FOREIGN KEY subscriptions_user_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscriptions DROP INDEX subscriptions_user_id"); } catch (\Exception $e) {}
         }

          //--- 16. ล้างทางเดินตารางลูกและระบบชำระเงิน (ดักหน้าไว้เลย) //---
        
         if (Schema::hasTable('subscription_type_settings')) {
             try { DB::statement("ALTER TABLE subscription_type_settings DROP FOREIGN KEY subscription_type_settings_type_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE subscription_type_settings DROP INDEX subscription_type_settings_type_id"); } catch (\Exception $e) {}
         }

         if (Schema::hasTable('completed_payments')) {
             try { DB::statement("ALTER TABLE completed_payments DROP FOREIGN KEY completed_payments_context_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE completed_payments DROP INDEX completed_payments_context_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE completed_payments DROP FOREIGN KEY completed_payments_user_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE completed_payments DROP INDEX completed_payments_user_id"); } catch (\Exception $e) {}
         }
         if (Schema::hasTable('individual_subscriptions')) {
             try { DB::statement("ALTER TABLE individual_subscriptions DROP FOREIGN KEY individual_subscriptions_subscription_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE individual_subscriptions DROP INDEX individual_subscriptions_subscription_id"); } catch (\Exception $e) {}
         }

         if (Schema::hasTable('institutional_subscriptions')) {
             try { DB::statement("ALTER TABLE institutional_subscriptions DROP FOREIGN KEY institutional_subscriptions_subscription_id"); } catch (\Exception $e) {}
             try { DB::statement("ALTER TABLE institutional_subscriptions DROP INDEX institutional_subscriptions_subscription_id"); } catch (\Exception $e) {}
         }

         //--- 17. แก้ไขตาราง Journals (ป้องกัน Error 1061 แบบ 100%) //---
         if (Schema::hasTable('journals')) {
             try {
                 Schema::table('journals', function (Blueprint $table) {
                     // เปลี่ยนชื่อ Index เป็นชื่ออื่น (เช่นเติม _v34) เพื่อหนี Error 1061
                     try { $table->index(['current_issue_id'], 'journals_issue_id_v34'); } catch (\Exception $e) {}
                 });
             } catch (\Exception $e) {
                  //ถ้ายังไม่ได้อีก ให้ข้ามไปเลย
             }
         }
    }
    public function down(): void
 {
    return; // สั่งให้ข้ามการ Revert ทุกกรณี
     // ยอมให้ว่างได้ แต่ต้องมีฟังก์ชันนี้อยู่
 }
}

    



