// CustomTabBar.js
import React, { act } from 'react';
import { View, TouchableOpacity, Text, StyleSheet, Image } from 'react-native';
import { Book, Home, PageSearch, Play } from '../assets/images';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import { useNavigation } from '@react-navigation/native';
import { useActiveRoute } from '../context/ActiveRouteContext';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';

const CustomTabBar = ({ setBottomTabHeight }) => {
  const { activeRoute } = useActiveRoute();

  const navigation = useNavigation();
  const insets = useSafeAreaInsets();

  return (
    <View
      style={[styles.tabBar, styles.cardShadow]}
      onLayout={(e) => setBottomTabHeight(e.nativeEvent.layout.height)}>
      <TouchableOpacity
        onPress={() => navigation.navigate('Home')}
        style={[
          styles.tab,
          { paddingBottom: insets.bottom },
          { borderTopWidth: activeRoute === 'Home' ? 3 : 0 },
          { borderTopColor: activeRoute === 'Home' && '#0D677D' },
        ]}>
        <Image
          source={Home}
          style={{
            height: 25,
            width: 21,
            objectFit: 'contain',
            tintColor: activeRoute === 'Home' ? '#0D677D' : '#8A8A8A',
          }}
        />
        <Text
          style={{
            fontSize: 11,
            fontFamily: fonts.OpenSansSemiBold,
            color: activeRoute === 'Home' ? '#0D677D' : '#8A8A8A',
          }}>
          Home
        </Text>
      </TouchableOpacity>
      <TouchableOpacity
        onPress={() => navigation.navigate('LessonStack')}
        style={[
          styles.tab,
          { paddingBottom: insets.bottom },
          { borderTopWidth: activeRoute === 'LessonStack' ? 3 : 0 },
          { borderTopColor: activeRoute === 'LessonStack' && '#0D677D' },
        ]}>
        <Image
          source={Book}
          style={{
            height: 25,
            width: 21,
            objectFit: 'contain',
            tintColor: activeRoute === 'LessonStack' ? '#0D677D' : '#8A8A8A',
          }}
        />
        <Text
          style={{
            fontSize: 11,
            fontFamily: fonts.OpenSansSemiBold,
            color: activeRoute === 'LessonStack' ? '#0D677D' : '#8A8A8A',
          }}>
          Lessons
        </Text>
      </TouchableOpacity>
      <TouchableOpacity
        onPress={() => {
          navigation.navigate('Podcast');
        }}
        style={[
          styles.tab,
          { paddingBottom: insets.bottom },
          { borderTopWidth: activeRoute === 'Podcast' ? 3 : 0 },
          { borderTopColor: activeRoute === 'Podcast' && '#0D677D' },
        ]}>
        <Image
          source={Play}
          style={{
            height: 25,
            width: 21,
            objectFit: 'contain',
            tintColor: activeRoute === 'Podcast' ? '#0D677D' : '#8A8A8A',
          }}
        />
        <Text
          style={{
            fontSize: 11,
            fontFamily: fonts.OpenSansSemiBold,
            color: activeRoute === 'Podcast' ? '#0D677D' : '#8A8A8A',
          }}>
          Podcast
        </Text>
      </TouchableOpacity>
      <TouchableOpacity
        onPress={() => navigation.navigate('Research')}
        style={[
          styles.tab,
          { paddingBottom: insets.bottom },
          { borderTopWidth: activeRoute === 'Research' ? 3 : 0 },
          { borderTopColor: activeRoute === 'Research' && '#0D677D' },
        ]}>
        <Image
          source={PageSearch}
          style={{
            height: 25,
            width: 21,
            objectFit: 'contain',
            tintColor: activeRoute === 'Research' ? '#0D677D' : '#8A8A8A',
          }}
        />
        <Text
          style={{
            fontSize: 11,
            fontFamily: fonts.OpenSansSemiBold,
            color: activeRoute === 'Research' ? '#0D677D' : '#8A8A8A',
          }}>
          Research
        </Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  tabBar: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center',
    backgroundColor: '#fff',
    height: 90,
    borderTopColor: '#EBEBEB',
    borderTopWidth: 0.5,
  },
  cardShadow: {
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 12,
    },
    shadowOpacity: 0.58,
    shadowRadius: 16.0,

    elevation: 24,
  },
  tab: {
    flex: 1,
    height: '100%',
    alignItems: 'center',
    borderTopWidth: 2,
    paddingTop: 10,
    marginHorizontal: 20,
    paddingBottom: 10,
    gap: 4,
  },
  icon: {
    width: 24,
    height: 24,
    tintColor: '#333',
  },
  label: {
    fontSize: 12,
    color: '#333',
  },
});

export default CustomTabBar;
