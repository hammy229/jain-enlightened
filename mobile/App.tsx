import React, { useEffect, useState } from 'react';
import SplashScreen from './src/screens/SplashScreen';
import { createStackNavigator } from '@react-navigation/stack';
import MainNavigator from './src/navigation/MainNavigator';
import { NavigationContainer, useNavigation } from '@react-navigation/native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchBaseUrl } from './src/api/api';
import { Text } from 'react-native';
import NetInfo from '@react-native-community/netinfo';
import NoInternetScreeen from './src/screens/NoInternetScreeen';

const Stack = createStackNavigator();

const App = () => {
  const [isBaseUrlFetched, setIsBaseUrlFetched] = useState(false);
  const [isAnimationDone, setIsAnimationDone] = useState(false);
  const [isConnected, setIsConnected] = useState(true);

  (Text as any).defaultProps = {
    ...(Text as any).defaultProps,
    allowFontScaling: false,
  };

  const storeBaseUrl = async (url: string) => {
    try {
      await AsyncStorage.setItem('baseUrl', url);
    } catch (error) {
      console.log('Error storing baseUrl: ', error);
    }
  };

  useEffect(() => {
    const fetchAndStoreBaseUrl = async () => {
      try {
        const response = await fetchBaseUrl();
        if (response) {
          await storeBaseUrl(response);
        }
      } catch (error) {
        console.log('Error fetching baseUrl: ', error);
      } finally {
        setIsBaseUrlFetched(true);
      }
    };

    fetchAndStoreBaseUrl();
  }, []);

  useEffect(() => {
    const unsubscribe = NetInfo.addEventListener((state) => {
      setIsConnected(state.isConnected);
    });

    return () => {
      unsubscribe();
    };
  }, [isConnected]);

  if (!isConnected) {
    return <NoInternetScreeen />;
  }

  if (!isBaseUrlFetched || !isAnimationDone) {
    return <SplashScreen onAnimationEnd={() => setIsAnimationDone(true)} />;
  }

  return (
    <NavigationContainer>
      <Stack.Navigator screenOptions={{ headerShown: false }}>
        <Stack.Screen name="Main" component={MainNavigator} />
      </Stack.Navigator>
    </NavigationContainer>
  );
};

export default App;
