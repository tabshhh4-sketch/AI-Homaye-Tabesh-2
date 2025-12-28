/**
 * Chat Input Component
 * 
 * Text input area for sending messages to the chatbot
 */
import React, { useState, useRef } from 'react';
import useChatStore from '../store/chatStore';

const ChatInput = () => {
  const { inputValue, setInputValue, addMessage, isLoading, setIsLoading } = useChatStore();
  const textareaRef = useRef(null);

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    if (!inputValue.trim() || isLoading) return;

    const userMessage = {
      role: 'user',
      content: inputValue.trim(),
      timestamp: Date.now()
    };

    // Add user message
    addMessage(userMessage);
    setInputValue('');
    setIsLoading(true);

    // Simulate AI response (will be replaced with actual API call)
    setTimeout(() => {
      const assistantMessage = {
        role: 'assistant',
        content: 'سلام! من دستیار هوشمند هما هستم. در حال حاضر در حال توسعه هستم و به زودی قادر به پاسخگویی کامل خواهم بود.',
        timestamp: Date.now()
      };
      addMessage(assistantMessage);
      setIsLoading(false);
    }, 1000);
  };

  const handleKeyDown = (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      handleSubmit(e);
    }
  };

  const handleChange = (e) => {
    setInputValue(e.target.value);
    
    // Auto-resize textarea
    if (textareaRef.current) {
      textareaRef.current.style.height = 'auto';
      textareaRef.current.style.height = Math.min(textareaRef.current.scrollHeight, 150) + 'px';
    }
  };

  return (
    <form className="homa-chat-input" onSubmit={handleSubmit}>
      <div className="homa-input-wrapper">
        <textarea
          ref={textareaRef}
          value={inputValue}
          onChange={handleChange}
          onKeyDown={handleKeyDown}
          placeholder="پیام خود را بنویسید..."
          rows="1"
          disabled={isLoading}
          className="homa-textarea"
        />
        <button
          type="submit"
          disabled={!inputValue.trim() || isLoading}
          className="homa-send-button"
          aria-label="ارسال پیام"
          title="ارسال پیام"
        >
          {isLoading ? (
            <svg className="homa-spinner" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" opacity="0.25"/>
              <path d="M12 2C6.48 2 2 6.48 2 12" stroke="currentColor" strokeWidth="4" strokeLinecap="round"/>
            </svg>
          ) : (
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M22 2L11 13M22 2L15 22L11 13M22 2L2 9L11 13" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
            </svg>
          )}
        </button>
      </div>
    </form>
  );
};

export default ChatInput;
