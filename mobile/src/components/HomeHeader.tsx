import {
  View,
  Text,
  ImageBackground,
  StyleSheet,
  Image,
  TouchableOpacity,
  Dimensions,
} from 'react-native';
import React from 'react';
import { Donation, HomeBanner, HomeLogo } from '../assets/images';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import { useNavigation } from '@react-navigation/native';
import Carousel from 'react-native-reanimated-carousel';
import BannerCarousel from './BannerCarousel';
import DrawerOpenBtn from './DrawerOpenBtn';
import { globalStyles } from '../assets/styles/globalStyles';
import {
  Easing,
  ReduceMotion,
  useReducedMotion,
  useSharedValue,
  withTiming,
} from 'react-native-reanimated';

const HomeHeader: React.FC = ({ banners }) => {
  const insets = useSafeAreaInsets();
  const navigation = useNavigation();
  const width = Dimensions.get('window').width;
  const reduceMotion = useReducedMotion();

  const scrollAnimationDuration = useSharedValue(
    withTiming(2000, {
      duration: 2000,
      easing: Easing.out(Easing.exp),
      reduceMotion: ReduceMotion.Never,
    }),
  );

  return (
    <View style={styles.container}>
      <ImageBackground
        source={HomeBanner}
        style={[styles.imageBg, { paddingTop: insets.top }]}
        imageStyle={styles.rounderBorders}>
        <View style={globalStyles.padHorizontal}>
          <View style={styles.navRow}>
            <Image source={HomeLogo} style={styles.homeLogo} />
            {/* <View style={styles.navRowRightBox}>
              <TouchableOpacity
                onPress={() => {
                  navigation.navigate('HelpUsGrow');
                }}
                style={styles.donateBtn}>
                <Image source={Donation} style={styles.donateIcon} />
                <Text style={styles.whiteText}>Donate</Text>
              </TouchableOpacity>
            </View> */}
            <DrawerOpenBtn />
          </View>
        </View>
      </ImageBackground>
      <View style={styles.carouselWrapper}>
        <Carousel
          loop
          width={width}
          height={width / 2}
          autoPlay={true}
          data={banners}
          scrollAnimationDuration={2000}
          withAnimation={{
            type: 'timing',
            config: {
              duration: 2500,
              easing: Easing.out(Easing.exp),
              reduceMotion: ReduceMotion.Never,
            },
          }}
          renderItem={BannerCarousel}
        />
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    height: 355,
    width: '100%',
  },
  imageBg: {
    width: '100%',
    height: 300,
    overflow: 'hidden',
  },
  headerContainer: {
    paddingHorizontal: 15,
  },
  rounderBorders: {
    borderBottomLeftRadius: 25,
    borderBottomRightRadius: 25,
  },
  navRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    gap: 20,
  },
  homeLogo: {
    width: '50%',
    height: 55,
    objectFit: 'contain',
  },
  navRowRightBox: {
    flex: 1,
    flexDirection: 'row',
    gap: 10,
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  donateBtn: {
    backgroundColor: '#D09F49',
    borderRadius: 50,
    flexDirection: 'row',
    alignItems: 'center',
    gap: 6,
    paddingHorizontal: 10,
    paddingVertical: 7,
  },
  whiteText: {
    color: '#fff',
  },
  donateIcon: {
    height: 22,
    width: 25,
    objectFit: 'contain',
  },
  carouselWrapper: {
    flex: 1,
    position: 'absolute',
    bottom: 20,
  },
});

export default HomeHeader;
