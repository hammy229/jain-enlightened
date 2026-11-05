import { View, Text, StyleSheet } from 'react-native';
import React, { useState } from 'react';
import CustomTabBar from '../components/CustomBottomTab';
import { globalStyles } from '../assets/styles/globalStyles';
import ChatbotButtonModal from '../components/modal/ChatBotModal';

const LayoutWrapper = ({ children }) => {
  const [bottomTabHeight, setBottomTabHeight] = useState(100);
  return (
    <>
      <ChatbotButtonModal bottomTabHeight={bottomTabHeight} />
      <View style={[styles.container, globalStyles.bgWhite]}>
        {children}
        <CustomTabBar setBottomTabHeight={setBottomTabHeight} />
      </View>
    </>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});

export default LayoutWrapper;
