/**
 * Main Chatbot Application Component
 * 
 * Renders the floating icon and the sidebar with chat interface
 */
import React from 'react';
import FloatingIcon from './components/FloatingIcon';
import ChatSidebar from './components/ChatSidebar';
import useChatStore from './store/chatStore';

const ChatbotApp = () => {
  const isOpen = useChatStore((state) => state.isOpen);

  return (
    <>
      <FloatingIcon />
      <ChatSidebar />
      {/* Overlay to squeeze the main content when sidebar is open */}
      <div 
        className={`homa-viewport-orchestrator ${isOpen ? 'sidebar-open' : ''}`}
        data-sidebar-state={isOpen ? 'open' : 'closed'}
      />
    </>
  );
};

export default ChatbotApp;
