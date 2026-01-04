/**
 * Soltek Chat Widget
 * AI-powered customer support chat
 */

(function() {
    'use strict';

    const CHAT_CONFIG = {
        botName: 'Soltek AI Assistant',
        welcomeMessage: 'Ciao! Sono il tuo assistente Soltek. Come posso aiutarti con la tua tecnologia oggi?',
        placeholder: 'Scrivi qui...',
        sendLabel: 'Invia',
        thinkingMessage: 'Soltek sta pensando...',
        errorMessage: 'Spiacente, il mio assistente AI è momentaneamente offline. Chiamaci allo 0935 686694 per assistenza immediata!',
        phone: '0935 686694'
    };

    let chatOpen = false;
    let messages = [];
    let isLoading = false;

    document.addEventListener('DOMContentLoaded', function() {
        initChatWidget();
    });

    function initChatWidget() {
        const toggle = document.getElementById('chat-toggle');
        const widget = document.getElementById('chat-widget');

        if (!toggle || !widget) return;

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
        const container = document.getElementById('chat-window');
        if (!container) return;

        if (!chatOpen) {
            container.style.display = 'none';
            container.innerHTML = '';
            return;
        }

        container.style.display = 'block';
        container.style.cssText = `
            position: fixed;
            bottom: 6rem;
            right: 1.5rem;
            z-index: 100;
            width: 360px;
            max-width: calc(100vw - 2rem);
            max-height: 500px;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        `;

        container.innerHTML = `
            <div style="background: #2563eb; padding: 1rem; color: white; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                    <span style="font-weight: 700;">${CHAT_CONFIG.botName}</span>
                </div>
                <button id="chat-close" style="background: none; border: none; color: white; cursor: pointer; padding: 0.25rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
            <div id="chat-messages" style="flex: 1; padding: 1rem; overflow-y: auto; background: #f9fafb; min-height: 300px;">
                ${renderMessages()}
            </div>
            <div style="padding: 1rem; background: white; border-top: 1px solid #e5e7eb; display: flex; gap: 0.5rem;">
                <input type="text" id="chat-input" placeholder="${CHAT_CONFIG.placeholder}" style="flex: 1; padding: 0.75rem 1rem; border: none; background: #f3f4f6; border-radius: 9999px; font-size: 0.875rem; outline: none;">
                <button id="chat-send" style="background: #2563eb; color: white; border: none; padding: 0.75rem; border-radius: 9999px; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </button>
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
            if (e.key === 'Enter') sendMessage();
        });

        // Scroll to bottom
        const messagesContainer = document.getElementById('chat-messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function renderMessages() {
        let html = '';

        messages.forEach(function(msg) {
            const isUser = msg.role === 'user';
            html += `
                <div style="display: flex; ${isUser ? 'justify-content: flex-end' : 'justify-content: flex-start'}; margin-bottom: 1rem;">
                    <div style="max-width: 80%; padding: 0.75rem 1rem; border-radius: 1rem; font-size: 0.875rem; ${isUser
                        ? 'background: #2563eb; color: white; border-bottom-right-radius: 0.25rem;'
                        : 'background: white; color: #1f2937; border: 1px solid #e5e7eb; border-bottom-left-radius: 0.25rem;'
                    }">
                        ${msg.text}
                    </div>
                </div>
            `;
        });

        if (isLoading) {
            html += `
                <div style="display: flex; justify-content: flex-start; margin-bottom: 1rem;">
                    <div style="max-width: 80%; padding: 0.75rem 1rem; border-radius: 1rem; font-size: 0.875rem; background: white; color: #6b7280; border: 1px solid #e5e7eb; border-bottom-left-radius: 0.25rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 1s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                        ${CHAT_CONFIG.thinkingMessage}
                    </div>
                </div>
                <style>@keyframes spin { to { transform: rotate(360deg); } }</style>
            `;
        }

        return html;
    }

    function sendMessage() {
        const input = document.getElementById('chat-input');
        const text = input.value.trim();

        if (!text || isLoading) return;

        // Add user message
        messages.push({ role: 'user', text: text });
        input.value = '';
        isLoading = true;
        renderChat();

        // Send to server (AJAX)
        if (typeof soltekData !== 'undefined') {
            const formData = new FormData();
            formData.append('action', 'soltek_chat');
            formData.append('nonce', soltekData.nonce);
            formData.append('message', text);

            fetch(soltekData.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                isLoading = false;
                messages.push({
                    role: 'bot',
                    text: data.message || CHAT_CONFIG.errorMessage
                });
                renderChat();
            })
            .catch(function() {
                isLoading = false;
                messages.push({
                    role: 'bot',
                    text: CHAT_CONFIG.errorMessage
                });
                renderChat();
            });
        } else {
            // Fallback response
            setTimeout(function() {
                isLoading = false;
                messages.push({
                    role: 'bot',
                    text: `Grazie per il messaggio! Per assistenza immediata, chiamaci allo ${CHAT_CONFIG.phone} o vieni a trovarci in negozio.`
                });
                renderChat();
            }, 1000);
        }
    }

})();
