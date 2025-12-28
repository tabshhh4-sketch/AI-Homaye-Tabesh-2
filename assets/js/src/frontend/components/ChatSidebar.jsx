/**
 * Chat Sidebar Component
 * 
 * The main sidebar that contains the chat interface
 */
import React, { useEffect, useRef } from 'react';
import useChatStore from '../store/chatStore';
import ChatHeader from './ChatHeader';
import ChatMessages from './ChatMessages';
import ChatInput from './ChatInput';

const ChatSidebar = () => {
  const { isOpen } = useChatStore();
  const sidebarRef = useRef(null);

  useEffect(() => {
    // Add/remove class to body to squeeze the viewport
    if (isOpen) {
      document.body.classList.add('homa-sidebar-active');
    } else {
      document.body.classList.remove('homa-sidebar-active');
    }

    return () => {
      document.body.classList.remove('homa-sidebar-active');
    };
  }, [isOpen]);

  return (
    <aside
      ref={sidebarRef}
      className={`homa-chat-sidebar ${isOpen ? 'open' : ''}`}
      aria-hidden={!isOpen}
    >
      <div className="homa-sidebar-content">
        <ChatHeader />
        <ChatMessages />
        <ChatInput />
      </div>
    </aside>
  );
};

export default ChatSidebar;
