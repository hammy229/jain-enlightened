import React, { useEffect, useState } from 'react';
import DrawerNavigator from './DrawerNavigator';
import { ActiveRouteProvider } from '../context/ActiveRouteContext';
import DeviceInfo from 'react-native-device-info';
import { fetchAppVersion } from '../api/api';
import AsyncStorage from '@react-native-async-storage/async-storage';
import ForceUpdate from '../screens/AppUpdateScreen';

const MainNavigator: React.FC = () => {
  const [shouldUpdate, setShouldUpdate] = useState(false);

  const compareVersions = (currentVersion, latestVersion) => {
    const currentParts = currentVersion.split('.').map(Number);
    const latestParts = latestVersion.split('.').map(Number);

    for (let i = 0; i < latestParts.length; i++) {
      if (currentParts[i] < latestParts[i]) {
        return true; // Current version is less than latest version
      } else if (currentParts[i] > latestParts[i]) {
        return false; // Current version is greater than or equal to latest version
      }
    }
    return false; // Versions are equal
  };

  useEffect(() => {
    const checkForUpdate = async () => {
      const currentVersion = DeviceInfo.getVersion();
      const isAndroid = DeviceInfo.getSystemName() === 'Android';

      try {
        const url = await AsyncStorage.getItem('baseUrl');
        if (url) {
          const response = await fetchAppVersion(url);

          const latestVersion = isAndroid
            ? response.latest_version_android
            : response.latest_version_ios;

          // Compare versions
          if (compareVersions(currentVersion, latestVersion)) {
            setShouldUpdate(true); // Show update screen only if current version is less than latest version
          }
        }
      } catch (error) {
        console.error('Error fetching app version:', error);
      }
    };

    checkForUpdate();
  }, []);

  if (shouldUpdate) {
    return <ForceUpdate />;
  }

  return (
    <ActiveRouteProvider>
      <DrawerNavigator />
    </ActiveRouteProvider>
  );
};

export default MainNavigator;
