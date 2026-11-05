import { StyleSheet, StatusBar, Dimensions } from 'react-native';
import React, { useEffect } from 'react';
import Animated, {
  Easing,
  useSharedValue,
  useAnimatedStyle,
  withTiming,
  ReduceMotion,
} from 'react-native-reanimated';
import LinearGradient from 'react-native-linear-gradient';

const { width } = Dimensions.get('window');

interface SplashScreenProps {
  onAnimationEnd: () => void;
}

const SplashScreen: React.FC<SplashScreenProps> = ({ onAnimationEnd }) => {
  const swirlValue = useSharedValue(0);
  const logoScaleValue = useSharedValue(0);

  useEffect(() => {
    // Ensuring that animations always play, regardless of reduced motion settings
    swirlValue.value = withTiming(1, {
      duration: 2500,
      easing: Easing.out(Easing.exp),
      reduceMotion: ReduceMotion.Never, // Always play animation
    });
    logoScaleValue.value = withTiming(1, {
      duration: 1500,
      delay: 2000,
      easing: Easing.out(Easing.exp),
      reduceMotion: ReduceMotion.Never, // Always play animation
    });

    // End the splash screen animation after 3 seconds
    setTimeout(() => {
      onAnimationEnd();
    }, 3000);
  }, []);

  // Style for the swirling background image
  const swirlStyle = useAnimatedStyle(() => {
    const scale = swirlValue.value * 5;
    const rotate = swirlValue.value * 90;
    return {
      transform: [{ scale: Math.max(1, scale) }, { rotate: `${rotate}deg` }],
      opacity: swirlValue.value,
    };
  });

  // Style for the logo animation
  const logoStyle = useAnimatedStyle(() => {
    return {
      transform: [{ scale: logoScaleValue.value }],
      opacity: logoScaleValue.value,
    };
  });

  return (
    <LinearGradient
      colors={['#004A5E', '#003846', '#002731']}
      start={{ x: 0.5, y: 0.5 }}
      end={{ x: 0.5, y: 1 }}
      style={styles.container}>
      <StatusBar translucent backgroundColor="transparent" />
      <Animated.Image
        source={require('../assets/images/rays.png')}
        style={[styles.backgroundImage, swirlStyle]}
        resizeMode="cover"
      />
      <Animated.Image
        source={require('../assets/images/logo.png')}
        style={[styles.logo, logoStyle]}
        resizeMode="contain"
      />
    </LinearGradient>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: 'green',
  },
  backgroundImage: {
    position: 'absolute',
    width: width * 0.55,
    height: width * 0.55,
  },
  logo: {
    width: width * 0.5,
    height: width * 0.5,
  },
});

export default SplashScreen;
