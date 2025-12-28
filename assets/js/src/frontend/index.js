/**
 * Frontend Chatbot Entry Point
 * 
 * Initializes the Homa chatbot on the frontend of the WordPress site
 */
import { createElement } from 'react';
import { createRoot } from 'react-dom/client';
import ChatbotApp from './ChatbotApp';
import './styles.css';

// Initialize chatbot when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeChatbot);
} else {
  initializeChatbot();
}

function initializeChatbot() {
  // Create container for the chatbot if it doesn't exist
  let chatbotContainer = document.getElementById('homa-chatbot-root');
  
  if (!chatbotContainer) {
    chatbotContainer = document.createElement('div');
    chatbotContainer.id = 'homa-chatbot-root';
    document.body.appendChild(chatbotContainer);
  }

  // Render the chatbot app
  const root = createRoot(chatbotContainer);
  root.render(createElement(ChatbotApp));
}
