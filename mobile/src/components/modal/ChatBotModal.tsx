import React, { useState, useRef } from 'react';
import {
  Modal,
  View,
  Button,
  StyleSheet,
  Pressable,
  Image,
  Text,
  Platform,
} from 'react-native';
import { WebView } from 'react-native-webview';
import { colors } from '../../assets/styles/colors';
import { Close, CloseBtn, Logo } from '../../assets/images';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import { globalStyles } from '../../assets/styles/globalStyles';

const ChatbotButtonModal = ({ bottomTabHeight }) => {
  const insets = useSafeAreaInsets();
  const [modalVisible, setModalVisible] = useState(false);
  const buttonSize = 80; // Size of the button

  return (
    <View
      style={[
        styles.container,
        globalStyles.cardShadow,
        {
          right: insets.right + 80,
          bottom:
            Platform.OS == 'android'
              ? insets.bottom + bottomTabHeight + 80
              : insets.bottom + bottomTabHeight + 60,
        },
      ]}>
      <Modal
        animationType="slide"
        transparent={false}
        visible={modalVisible}
        onRequestClose={() => setModalVisible(false)}>
        <View
          style={[
            styles.modalContainer,
            {
              marginTop: Platform.OS == 'ios' ? insets.top : 0,
              backgroundColor: 'red',
              position: 'relative',
            },
          ]}>
          <Pressable
            title="Close Chatbot"
            style={{
              backgroundColor: 'white',
              position: 'absolute',
              top: 0,
              right: insets.right,
              zIndex: 10000,
              height: 60,
              width: 50,
              justifyContent: 'center',
              alignItems: 'center',
            }}
            onPress={() => setModalVisible(false)}>
            <Image
              source={CloseBtn}
              style={{ height: 25, width: 25, objectFit: 'contain' }}
            />
          </Pressable>
          <WebView
            source={{
              uri: 'https://app.fastbots.ai/embed/YOUR_FASTBOTS_BOT_ID',
            }}
            style={styles.webView}
          />
        </View>
      </Modal>

      {/* Movable Chatbot Button */}
      <View style={[styles.draggableContainer]}>
        <Pressable onPress={() => setModalVisible(true)}>
          <Image
            source={Logo}
            style={{ height: 50, width: 50, objectFit: 'contain' }}
          />
        </Pressable>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    position: 'absolute',
    zIndex: 10,
  },
  modalContainer: {
    flex: 1,
    // marginTop: 50,
  },
  webView: {
    width: '100%',
    height: '100%',
  },
  draggableContainer: {
    position: 'absolute',
    width: 70,
    height: 70,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: colors.white,
    borderRadius: 40,
    elevation: 10,
  },
});

export default ChatbotButtonModal;
