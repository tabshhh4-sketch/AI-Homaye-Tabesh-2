import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './App';
import './styles.css';

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
  const rootElement = document.getElementById('homaye-tabesh-root');
  
  if (rootElement) {
    const root = createRoot(rootElement);
    const page = rootElement.getAttribute('data-page');
    
    root.render(<App page={page} />);
  }
});
