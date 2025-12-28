/**
 * Chat Header Component
 * 
 * Header of the chatbot sidebar with title and close button
 */
import React from 'react';
import useChatStore from '../store/chatStore';

const ChatHeader = () => {
  const closeSidebar = useChatStore((state) => state.closeSidebar);

  return (
    <header className="homa-chat-header">
      <div className="homa-header-content">
        <div className="homa-header-title">
          <div className="homa-avatar">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="10" fill="#4F46E5"/>
              <path d="M12 8V12L15 15" stroke="white" strokeWidth="2" strokeLinecap="round"/>
            </svg>
          </div>
          <div>
            <h2>همای تابش</h2>
            <span className="homa-status">آنلاین</span>
          </div>
        </div>
        <button
          className="homa-close-button"
          onClick={closeSidebar}
          aria-label="بستن چت"
          title="بستن چت"
        >
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" strokeWidth="2" strokeLinecap="round"/>
          </svg>
        </button>
      </div>
    </header>
  );
};

export default ChatHeader;
