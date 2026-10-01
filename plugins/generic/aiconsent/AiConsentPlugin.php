<?php

namespace APP\plugins\generic\aiconsent;

use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;

class AiConsentPlugin extends GenericPlugin {

    public function register($category, $path,$mainContextId = null) {
        if (parent::register($category, $path,$mainContextId)) {
            if ($this->getEnabled($mainContextId)) {
                Hook::add('TemplateManager::display', [$this, 'injectModalScript']);
            }
            return true;
        }
        return false;
    }

    public function injectModalScript($hookName,$args) {
        $templateMgr =$args[0];
        $request =$this->getRequest();
        $context =$request->getContext();

        if (!$context) {
            return false;
        }

        $script = '
        <script>
        (function() {
            function handleAiConsent() {
                document.addEventListener("click", function(e) {
                    var target = e.target.closest("a, button, .pkpButton, [href]");
                    if (!target) return;

                    var href = target.getAttribute("href") || "";
                    var text = (target.innerText || target.textContent || "").trim().toLowerCase();

                    var isSubmissionBtn = href.includes("/submission") || 
                                          href.includes("/submit") || 
                                          text.includes("new submission") || 
                                          text.includes("ส่งบทความ");

                    if (isSubmissionBtn) {
                        // หากเคยตอบยอมรับใน Session นี้แล้ว จะไม่แสดงซ้ำ
                        if (sessionStorage.getItem("ai_policy_accepted") === "true") {
                            return;
                        }

                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();

                        showAiModal(function() {
                            sessionStorage.setItem("ai_policy_accepted", "true");
                            if (href && href !== "#") {
                                window.location.href = href;
                            } else {
                                target.click();
                            }
                        });
                    }
                }, true);
            }

            function showAiModal(onAccept) {
                if (document.getElementById("ai-policy-modal")) return;

                var modalHtml = `
                    <div id="ai-policy-modal" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.65); z-index: 9999999; display: flex; align-items: center; justify-content: center;">
                        <div style="background: #fff; border-radius: 8px; width: 90%; max-width: 500px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.4); font-family: sans-serif; text-align: left;">
                            <h3 style="margin-top: 0; color: #d9534f; border-bottom: 2px solid #eee; padding-bottom: 10px; font-size: 18px;">
                                ข้อตกลงเรื่องการใช้ AI ในการเขียนบทความ
                            </h3>
                            <p style="font-size: 14px; color: #333; line-height: 1.6; margin: 15px 0;">
                                ท่านรับทราบและยืนยันว่า <strong>การใช้ AI/LLM ในบทความนี้ ไม่ได้ถูกนำมาใช้ในส่วนของการคิดค้น วิจัย หรือสร้างข้อมูลเท็จ</strong> และปฏิบัติตามนโยบายของวารสารอย่างเคร่งครัด
                            </p>
                            <div style="margin-top: 25px; display: flex; gap: 10px; justify-content: flex-end;">
                                <button id="ai-btn-decline" type="button" style="padding: 9px 16px; background: #6c757d; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                                    ไม่ยอมรับ (Decline)
                                </button>
                                <button id="ai-btn-accept" type="button" style="padding: 9px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                                    ยอมรับ (Accept) แล้วดำเนินการต่อ
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                document.body.insertAdjacentHTML("beforeend", modalHtml);

                document.getElementById("ai-btn-accept").onclick = function() {
                    var m = document.getElementById("ai-policy-modal");
                    if (m) m.remove();
                    onAccept();
                };

                document.getElementById("ai-btn-decline").onclick = function() {
                    var m = document.getElementById("ai-policy-modal");
                    if (m) m.remove();
                    alert("ท่านต้องยอมรับนโยบายการใช้ AI ก่อนจึงจะสามารถดำเนินการส่งบทความได้");
                };
            }

            if (document.readyState === "loading") {
                document.addEventListener("DOMContentLoaded", handleAiConsent);
            } else {
                handleAiConsent();
            }
        })();
        </script>
        ';

        $templateMgr->addHeader('aiPolicyModalScript',$script);
        return false;
    }

    public function getDisplayName() {
        return 'AI Policy Consent Plugin';
    }

    public function getDescription() {
        return 'แสดง Pop-up ยืนยันนโยบาย AI ก่อนเข้าสู่ฟอร์มส่งบทความ';
    }
}