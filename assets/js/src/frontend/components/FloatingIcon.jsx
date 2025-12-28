/**
 * Floating Icon Component
 * 
 * A persistent floating button that opens the chatbot sidebar
 */
import React from 'react';
import useChatStore from '../store/chatStore';

const FloatingIcon = () => {
  const { isOpen, toggleSidebar } = useChatStore();

  return (
    <button
      className={`homa-floating-icon ${isOpen ? 'hidden' : ''}`}
      onClick={toggleSidebar}
      aria-label="باز کردن چت هما"
      title="باز کردن چت هما"
    >
      <svg 
        className="homa-icon-chat" 
        width="24" 
        height="24" 
        viewBox="0 0 24 24" 
        fill="none" 
        xmlns="http://www.w3.org/2000/svg"
      >
        <path 
          d="M12 2C6.48 2 2 6.48 2 12C2 13.93 2.6 15.72 3.62 17.19L2.05 21.95C1.97 22.22 2.05 22.51 2.26 22.7C2.39 22.83 2.57 22.9 2.75 22.9C2.83 22.9 2.91 22.89 2.99 22.86L7.81 21.38C9.25 22.35 10.99 22.95 12.89 22.99C18.41 22.99 22.89 18.51 22.89 12.99C22.89 6.48 18.41 2 12.89 2H12Z" 
          fill="currentColor"
        />
        <path 
          d="M8 11H16V13H8V11Z" 
          fill="white"
        />
        <path 
          d="M8 15H13V17H8V15Z" 
          fill="white"
        />
        <path 
          d="M8 7H16V9H8V7Z" 
          fill="white"
        />
      </svg>
      <span className="homa-icon-pulse"></span>
    </button>
  );
};

export default FloatingIcon;
