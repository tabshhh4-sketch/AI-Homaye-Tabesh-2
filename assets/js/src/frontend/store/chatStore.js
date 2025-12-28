/**
 * Chatbot State Management using Zustand
 * 
 * Manages the state of the chatbot sidebar, messages, and UI state
 */
import { create } from 'zustand';

const useChatStore = create((set) => ({
  // Sidebar state
  isOpen: false,
  toggleSidebar: () => set((state) => ({ isOpen: !state.isOpen })),
  openSidebar: () => set({ isOpen: true }),
  closeSidebar: () => set({ isOpen: false }),

  // Messages
  messages: [],
  addMessage: (message) => set((state) => ({
    messages: [...state.messages, { ...message, id: Date.now() }]
  })),
  clearMessages: () => set({ messages: [] }),

  // Input state
  inputValue: '',
  setInputValue: (value) => set({ inputValue: value }),

  // Loading state
  isLoading: false,
  setIsLoading: (loading) => set({ isLoading: loading }),
}));

export default useChatStore;
