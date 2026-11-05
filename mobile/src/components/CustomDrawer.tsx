import {
  View,
  Text,
  StyleSheet,
  StatusBar,
  Image,
  Pressable,
} from 'react-native';
import React, { useEffect, useState } from 'react';
import {
  DrawerContentComponentProps,
  DrawerContentScrollView,
} from '@react-navigation/drawer';
import LinearGradient from 'react-native-linear-gradient';
import CustomDrawerItem from './CustomDrawerItem';
import {
  Blog,
  Book,
  Contact,
  Facebook,
  Gallery,
  Handshake,
  Heart,
  Home,
  Instagram,
  Linkedin,
  PageSearch,
  Play,
  Privacy,
  Profile,
  Terms,
  Youtube,
} from '../assets/images';
import { useActiveRoute } from '../context/ActiveRouteContext';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchContactUsDetails } from '../api/api';
import { handleLink } from '../utils';
import DeviceInfo from 'react-native-device-info';

const CustomDrawer: React.FC<DrawerContentComponentProps> = (props) => {
  const { setActiveRoute } = useActiveRoute();
  const activeRoute = props.state.routeNames[props.state.index];
  const [socialLinks, setSocialLinks] = useState();
  const [version, setVersion] = useState('');

  useEffect(() => {
    const fetchVersion = async () => {
      const appVersion = DeviceInfo.getVersion();
      setVersion(appVersion);
    };

    fetchVersion();
  }, []);

  useEffect(() => {
    const getSocialLinks = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');

        if (url) {
          const response = await fetchContactUsDetails(url);
          setSocialLinks(response);
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log('Error fetching social links ', error);
      } finally {
        // setLoading(false);
      }
    };

    getSocialLinks();
  }, []);

  useEffect(() => {
    setActiveRoute(activeRoute);
  }, [activeRoute, setActiveRoute]);

  return (
    <LinearGradient
      colors={['#004A5E', '#003846', '#002731']}
      locations={[0, 0.425, 1]}
      style={{ flex: 1 }}>
      <StatusBar translucent backgroundColor="transparent" />
      <DrawerContentScrollView {...props} style={[styles.container]}>
        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'flex-end',
            paddingHorizontal: 20,
          }}></View>
        <View style={styles.drawerItems}>
          <CustomDrawerItem
            label="Home"
            route="Home"
            icon={Home}
            isActive={activeRoute === 'Home'}
          />
          <CustomDrawerItem
            label="About Us"
            route="About"
            icon={Profile}
            isActive={activeRoute === 'About'}
          />
          <CustomDrawerItem
            label="Lessons"
            route="LessonStack"
            icon={Book}
            isActive={activeRoute === 'LessonStack'}
          />
          <CustomDrawerItem
            label="Podcasts"
            route="Podcast"
            icon={Play}
            isActive={activeRoute === 'Podcast'}
          />
          <CustomDrawerItem
            label="Impact"
            route="Impact"
            icon={Heart}
            isActive={activeRoute === 'Impact'}
          />
          <CustomDrawerItem
            label="Research"
            route="Research"
            icon={PageSearch}
            isActive={activeRoute === 'Research'}
          />
          <CustomDrawerItem
            label="Gallery"
            route="Gallery"
            icon={Gallery}
            isActive={activeRoute === 'Gallery'}
          />
          <CustomDrawerItem
            label="Blogs"
            route="BlogStack"
            icon={Blog}
            isActive={activeRoute === 'BlogStack'}
          />
          {/* <CustomDrawerItem
            label="Help Us Grow"
            route="HelpUsGrow"
            icon={Handshake}
            isActive={activeRoute === 'HelpUsGrow'}
          /> */}
          <CustomDrawerItem
            label="Contact Us"
            route="Contact"
            icon={Contact}
            isActive={activeRoute === 'Contact'}
          />
          <CustomDrawerItem
            label="Terms & Conditions"
            route="Terms"
            icon={Terms}
            isActive={activeRoute === 'Terms'}
          />
          <CustomDrawerItem
            label="Privacy Policy"
            route="Privacy"
            icon={Privacy}
            isActive={activeRoute === 'Privacy'}
          />
        </View>
        <View style={styles.followUsContainer}>
          <LinearGradient
            colors={['rgba(255, 255, 255, 0.22)', 'rgba(255, 255, 255, 0)']}
            start={{ x: 0, y: 0.5 }}
            end={{ x: 1, y: 0.5 }}
            style={styles.gradientLines}
          />
          <View style={styles.followUsContainerFlex}>
            <Text style={styles.followUsText}>Follow Us On</Text>
            <View style={styles.socialContainer}>
              {socialLinks?.instagram_url && (
                <Pressable
                  onPress={() => handleLink(socialLinks?.instagram_url)}>
                  <Image source={Instagram} style={styles.socialIcons} />
                </Pressable>
              )}
              {socialLinks?.facebook_url && (
                <Pressable
                  onPress={() => handleLink(socialLinks?.facebook_url)}>
                  <Image source={Facebook} style={styles.socialIcons} />
                </Pressable>
              )}
              {socialLinks?.linkedin_url && (
                <Pressable
                  onPress={() => handleLink(socialLinks?.linkedin_url)}>
                  <Image source={Linkedin} style={styles.socialIcons} />
                </Pressable>
              )}
              {socialLinks?.youtube_url && (
                <Pressable onPress={() => handleLink(socialLinks?.youtube_url)}>
                  <Image source={Youtube} style={styles.socialIcons} />
                </Pressable>
              )}
            </View>
          </View>
          <LinearGradient
            colors={['rgba(255, 255, 255, 0.22)', 'rgba(255, 255, 255, 0)']}
            start={{ x: 0, y: 0.5 }}
            end={{ x: 1, y: 0.5 }}
            style={styles.gradientLines}
          />
        </View>
        <View style={styles.versionTextContainer}>
          <Text style={styles.versionText}>App Version - {version}</Text>
        </View>
      </DrawerContentScrollView>
    </LinearGradient>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  header: {
    padding: 20,
    backgroundColor: '#00f',
    alignItems: 'center',
  },
  headerText: {
    fontSize: 24,
    color: '#fff',
  },
  drawerItems: {
    marginTop: 20,
  },
  drawerItemLabel: {
    fontSize: 16,
    color: '#fff',
  },
  gradientLines: {
    height: 1,
    width: '100%',
  },
  followUsContainer: {
    marginTop: 25,
    marginBottom: 10,
  },
  followUsContainerFlex: {
    marginHorizontal: 20,
    flexDirection: 'row',
    paddingVertical: 15,
    gap: 25,
    alignItems: 'center',
  },
  followUsText: {
    fontSize: 14,
    color: '#fff',
  },
  socialIcons: {
    height: 22,
    width: 22,
    objectFit: 'contain',
  },
  socialContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
  },
  versionTextContainer: {
    paddingHorizontal: 20,
    marginBottom: 40,
  },
  versionText: {
    fontSize: 12,
    marginVertical: 10,
    color: '#fff',
  },
});

export default CustomDrawer;
