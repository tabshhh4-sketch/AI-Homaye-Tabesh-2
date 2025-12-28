/**
 * Chat Messages Component
 * 
 * Displays the list of chat messages
 */
import React, { useEffect, useRef } from 'react';
import useChatStore from '../store/chatStore';

const ChatMessages = () => {
  const messages = useChatStore((state) => state.messages);
  const messagesEndRef = useRef(null);

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' });
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  return (
    <div className="homa-chat-messages">
      {messages.length === 0 ? (
        <div className="homa-welcome-message">
          <div className="homa-welcome-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="10" stroke="#4F46E5" strokeWidth="2"/>
              <path d="M8 12L10 14L16 8" stroke="#4F46E5" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
            </svg>
          </div>
          <h3>به همای تابش خوش آمدید</h3>
          <p>من دستیار هوشمند شما هستم. چطور می‌تونم کمکتون کنم؟</p>
        </div>
      ) : (
        <div className="homa-messages-list">
          {messages.map((message) => (
            <div
              key={message.id}
              className={`homa-message ${message.role === 'user' ? 'user' : 'assistant'}`}
            >
              <div className="homa-message-content">
                <div className="homa-message-text">{message.content}</div>
                {message.timestamp && (
                  <div className="homa-message-time">
                    {new Date(message.timestamp).toLocaleTimeString('fa-IR', {
                      hour: '2-digit',
                      minute: '2-digit'
                    })}
                  </div>
                )}
              </div>
            </div>
          ))}
          <div ref={messagesEndRef} />
        </div>
      )}
    </div>
  );
};

export default ChatMessages;
