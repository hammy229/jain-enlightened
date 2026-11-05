import {
  View,
  Text,
  StyleSheet,
  Image,
  TouchableOpacity,
  StatusBar,
} from 'react-native';
import React, { useState } from 'react';
import { colors } from '../assets/styles/colors';
import { fonts } from '../assets/fonts';
import NetInfo from '@react-native-community/netinfo';
import { NoInternet } from '../assets/images';

const NoInternetScreen = ({}) => {
  const [checking, setChecking] = useState(false);

  // Function to create a delay
  const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

  const onRetry = async () => {
    setChecking(true);

    // Add delay before checking network status
    await delay(3000); // Delay of 2 seconds (2000 ms)

    try {
      const state = await NetInfo.fetch();
      console.log('Network state fetched:', state);
      setChecking(state.isConnected);
    } catch (error) {
      console.log('Error fetching network state:', error);
      setChecking(false);
    }
  };

  return (
    <View style={styles.container}>
      <StatusBar backgroundColor={'#FFF'} barStyle={'dark-content'} />
      <Image style={styles.image} source={NoInternet} />
      <TouchableOpacity style={styles.btnBox} onPress={() => onRetry()}>
        {checking ? (
          <Text style={styles.text}>Checking...</Text>
        ) : (
          <Text style={styles.text}>Retry</Text>
        )}
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: colors.white,
    justifyContent: 'center',
    alignItems: 'center',
  },
  image: {
    height: 230,
    width: 230,
    objectFit: 'contain',
  },
  btnBox: {
    marginTop: 8,
    borderRadius: 4,
    backgroundColor: '#E5A230',
    paddingVertical: 10,
    paddingHorizontal: 32,
  },
  text: {
    fontSize: 16,
    fontFamily: fonts.JakartaMedium,
    color: colors.white,
  },
});

export default NoInternetScreen;
