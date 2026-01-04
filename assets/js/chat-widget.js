/**
 * Soltek Chat Widget - n8n Integration
 * AI-powered customer support chat via n8n workflow
 */

(function() {
    'use strict';

    // ⚠️ CONFIGURA QUI IL TUO WEBHOOK n8n
    const N8N_WEBHOOK_URL = 'https://TUO-N8N.com/webhook/soltek-chat';

    const CHAT_CONFIG = {
        botName: 'Soltek AI Assistant',
        welcomeMessage: 'Ciao! Sono l\'assistente virtuale di Soltek. Come posso aiutarti oggi? 😊',
        placeholder: 'Scrivi la tua domanda...',
        thinkingMessage: 'Sto cercando le informazioni...',
        errorMessage: 'Mi scuso, ho avuto un problema tecnico. Chiamaci allo 0935 686694 per assistenza immediata!',
        phone: '0935 686694'
    };

    let chatOpen = false;
    let messages = [];
    let isLoading = false;
    let sessionId = 'session-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

    document.addEventListener('DOMContentLoaded', function() {
        initChatWidget();
    });

    function initChatWidget() {
        const toggle = document.getElementById('chat-toggle');
        if (!toggle) return;

        // Add initial message
        messages.push({
            role: 'bot',
            text: CHAT_CONFIG.welcomeMessage
        });

        toggle.addEventListener('click', function() {
            chatOpen = !chatOpen;
            renderChat();
        });
    }

    function renderChat() {
        let container = document.getElementById('chat-window');

        if (!container) {
            container = document.createElement('div');
            container.id = 'chat-window';
            document.body.appendChild(container);
        }

        if (!chatOpen) {
            container.style.display = 'none';
            return;
        }

        container.style.cssText = `
            position: fixed;
            bottom: 6rem;
            right: 1.5rem;
            z-index: 100;
            width: 380px;
            max-width: calc(100vw - 2rem);
            max-height: 520px;
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            animation: slideUp 0.3s ease-out;
        `;

        container.innerHTML = `
            <style>
                @keyframes slideUp {
                    from { transform: translateY(20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
                @keyframes pulse {
                    0%, 100% { opacity: 1; }
                    50% { opacity: 0.5; }
                }
                .chat-msg-enter {
                    animation: slideUp 0.2s ease-out;
                }
                #chat-messages::-webkit-scrollbar {
                    width: 6px;
                }
                #chat-messages::-webkit-scrollbar-thumb {
                    background: #cbd5e1;
                    border-radius: 3px;
                }
                #chat-input:focus {
                    box-shadow: 0 0 0 2px #3b82f6;
                }
            </style>

            <!-- Header -->
            <div style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 1rem 1.25rem; color: white; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 1rem;">${CHAT_CONFIG.botName}</div>
                        <div style="font-size: 0.75rem; opacity: 0.8;">Online • Risponde subito</div>
                    </div>
                </div>
                <button id="chat-close" style="background: rgba(255,255,255,0.1); border: none; color: white; cursor: pointer; padding: 0.5rem; border-radius: 50%; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>

            <!-- Messages -->
            <div id="chat-messages" style="flex: 1; padding: 1.25rem; overflow-y: auto; background: #f8fafc; min-height: 320px; scroll-behavior: smooth;">
                ${renderMessages()}
            </div>

            <!-- Quick Actions -->
            <div id="quick-actions" style="padding: 0.5rem 1rem; background: white; border-top: 1px solid #f1f5f9; display: flex; gap: 0.5rem; flex-wrap: wrap; ${messages.length > 1 ? 'display: none;' : ''}">
                <button class="quick-btn" data-msg="Quali prodotti avete?" style="padding: 0.4rem 0.75rem; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 999px; font-size: 0.75rem; cursor: pointer; transition: all 0.2s;">🛒 Prodotti</button>
                <button class="quick-btn" data-msg="Quali servizi offrite?" style="padding: 0.4rem 0.75rem; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 999px; font-size: 0.75rem; cursor: pointer; transition: all 0.2s;">🔧 Servizi</button>
                <button class="quick-btn" data-msg="Quali sono i vostri orari?" style="padding: 0.4rem 0.75rem; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 999px; font-size: 0.75rem; cursor: pointer; transition: all 0.2s;">🕐 Orari</button>
                <button class="quick-btn" data-msg="Dove vi trovate?" style="padding: 0.4rem 0.75rem; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 999px; font-size: 0.75rem; cursor: pointer; transition: all 0.2s;">📍 Dove</button>
            </div>

            <!-- Input -->
            <div style="padding: 1rem; background: white; border-top: 1px solid #e5e7eb; display: flex; gap: 0.75rem; align-items: center;">
                <input type="text" id="chat-input" placeholder="${CHAT_CONFIG.placeholder}" style="flex: 1; padding: 0.875rem 1.25rem; border: 1px solid #e5e7eb; background: #f8fafc; border-radius: 999px; font-size: 0.9rem; outline: none; transition: all 0.2s;">
                <button id="chat-send" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 0.875rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(37,99,235,0.4)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </button>
            </div>

            <!-- Footer -->
            <div style="padding: 0.5rem; background: #f8fafc; text-align: center; font-size: 0.7rem; color: #94a3b8;">
                Powered by Soltek AI • <a href="tel:0935686694" style="color: #3b82f6; text-decoration: none;">📞 0935 686694</a>
            </div>
        `;

        // Event listeners
        document.getElementById('chat-close').addEventListener('click', function() {
            chatOpen = false;
            renderChat();
        });

        const input = document.getElementById('chat-input');
        const sendBtn = document.getElementById('chat-send');

        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Quick action buttons
        document.querySelectorAll('.quick-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const msg = this.getAttribute('data-msg');
                document.getElementById('chat-input').value = msg;
                sendMessage();
            });
        });

        // Focus input and scroll to bottom
        setTimeout(() => {
            input.focus();
            const messagesContainer = document.getElementById('chat-messages');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 100);
    }

    function renderMessages() {
        let html = '';

        messages.forEach(function(msg, index) {
            const isUser = msg.role === 'user';
            const isLast = index === messages.length - 1;

            html += `
                <div class="${isLast ? 'chat-msg-enter' : ''}" style="display: flex; ${isUser ? 'justify-content: flex-end' : 'justify-content: flex-start'}; margin-bottom: 1rem;">
                    ${!isUser ? '<div style="width: 32px; height: 32px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 0.5rem; flex-shrink: 0;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/></svg></div>' : ''}
                    <div style="max-width: 75%; padding: 0.875rem 1.125rem; border-radius: 1.25rem; font-size: 0.9rem; line-height: 1.5; ${isUser
                        ? 'background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border-bottom-right-radius: 0.25rem;'
                        : 'background: white; color: #1f2937; border: 1px solid #e5e7eb; border-bottom-left-radius: 0.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);'
                    }">
                        ${formatMessage(msg.text)}
                    </div>
                </div>
            `;
        });

        if (isLoading) {
            html += `
                <div class="chat-msg-enter" style="display: flex; justify-content: flex-start; margin-bottom: 1rem;">
                    <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 0.5rem; flex-shrink: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/></svg>
                    </div>
                    <div style="max-width: 75%; padding: 0.875rem 1.125rem; border-radius: 1.25rem; font-size: 0.9rem; background: white; color: #64748b; border: 1px solid #e5e7eb; border-bottom-left-radius: 0.25rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="animation: spin 1s linear infinite; width: 16px; height: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                        ${CHAT_CONFIG.thinkingMessage}
                    </div>
                </div>
            `;
        }

        return html;
    }

    function formatMessage(text) {
        // Convert URLs to links
        text = text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" style="color: inherit; text-decoration: underline;">$1</a>');
        // Convert phone numbers
        text = text.replace(/(\d{4}\s?\d{6})/g, '<a href="tel:$1" style="color: inherit; text-decoration: underline;">$1</a>');
        // Convert newlines
        text = text.replace(/\n/g, '<br>');
        return text;
    }

    function sendMessage() {
        const input = document.getElementById('chat-input');
        const text = input.value.trim();

        if (!text || isLoading) return;

        // Hide quick actions after first message
        const quickActions = document.getElementById('quick-actions');
        if (quickActions) quickActions.style.display = 'none';

        // Add user message
        messages.push({ role: 'user', text: text });
        input.value = '';
        isLoading = true;
        renderChat();

        // Send to n8n webhook
        fetch(N8N_WEBHOOK_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                message: text,
                sessionId: sessionId,
                timestamp: new Date().toISOString(),
                url: window.location.href
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            isLoading = false;
            messages.push({
                role: 'bot',
                text: data.message || CHAT_CONFIG.errorMessage
            });
            renderChat();
        })
        .catch(function(error) {
            console.error('Chat error:', error);
            isLoading = false;
            messages.push({
                role: 'bot',
                text: CHAT_CONFIG.errorMessage
            });
            renderChat();
        });
    }

})();
