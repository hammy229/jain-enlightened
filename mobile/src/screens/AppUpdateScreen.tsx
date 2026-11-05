import React, { useState, useEffect } from 'react';
import {
  View,
  StyleSheet,
  StatusBar,
  ImageBackground,
  Modal,
  TouchableOpacity,
  Text,
  Linking,
  Platform,
  Alert,
} from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import Loader from '../components/Loader';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchStoreLinks } from '../api/api';

const ForceUpdate = ({ isUpdateRequired }) => {
  const [updateModal, setUpdateModal] = useState(isUpdateRequired);
  const [storeLinks, setStoreLinks] = useState({});

  useEffect(() => {
    const getStoreLinks = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');

        if (url) {
          const response = await fetchStoreLinks(url);
          setStoreLinks(response);
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log('Error fetching store links: ', error);
      }
    };

    getStoreLinks();
  }, []);

  useEffect(() => {
    setUpdateModal(isUpdateRequired);
  }, [isUpdateRequired]);

  return (
    <View style={styles.parentViewStyle}>
      <Modal animationType="slide" transparent={true} visible={updateModal}>
        <View style={[styles.modalView]}>
          <Text style={{ fontSize: 20, fontWeight: 'bold' }}>Dear User</Text>
          <Text style={{ textAlign: 'center', color: '#6C6C6C', fontSize: 16 }}>
            For more features and a better{'\n'}user experience, please upgrade
            this app!
          </Text>
          <TouchableOpacity
            onPress={() => {
              const url =
                Platform.OS === 'android'
                  ? storeLinks?.play_link
                  : storeLinks?.app_link;

              Linking.openURL(url).catch((err) => {
                console.error('An error occurred', err);
                Alert.alert('Error', 'Unable to open the store link.');
              });
            }}
            style={styles.updateButton}>
            <Text style={styles.updateButtonText}>UPDATE</Text>
          </TouchableOpacity>
        </View>
      </Modal>
      <StatusBar
        barStyle="dark-content"
        backgroundColor="transparent"
        translucent={true}
      />
      <ImageBackground
        source={require('../assets/images/update.png')}
        style={{ height: '100%', width: '100%' }}>
        <StatusBar translucent={true} />
        <SafeAreaView />
      </ImageBackground>
    </View>
  );
};

const styles = StyleSheet.create({
  parentViewStyle: {
    flex: 1,
    height: '100%',
    width: '100%',
    justifyContent: 'flex-end',
    alignItems: 'baseline',
    position: 'relative',
  },
  modalView: {
    position: 'absolute',
    left: 0,
    right: 0,
    bottom: 0,
    backgroundColor: 'white',
    borderRadius: 20,
    borderBottomRightRadius: 0,
    borderBottomLeftRadius: 0,
    padding: 35,
    alignItems: 'center',
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 4,
    elevation: 5,
    gap: 20,
  },
  updateButton: {
    backgroundColor: '#4589ec',
    paddingVertical: 10,
    paddingHorizontal: 50,
    borderRadius: 12,
    marginBottom: 20,
  },
  updateButtonText: {
    fontWeight: '800',
    color: '#fff',
  },
});

export default ForceUpdate;
