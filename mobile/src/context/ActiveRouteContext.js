import React, { createContext, useContext, useState } from 'react';

// Create a context for the active route
const ActiveRouteContext = createContext();

// Create a provider component
export const ActiveRouteProvider = ({ children }) => {
  const [activeRoute, setActiveRoute] = useState('');

  return (
    <ActiveRouteContext.Provider value={{ activeRoute, setActiveRoute }}>
      {children}
    </ActiveRouteContext.Provider>
  );
};

// Create a custom hook to use the active route context
export const useActiveRoute = () => {
  return useContext(ActiveRouteContext);
};
